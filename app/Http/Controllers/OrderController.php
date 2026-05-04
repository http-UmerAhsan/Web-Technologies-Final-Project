<?php
namespace App\Http\Controllers;
use App\Models\{Order, OrderItem, Product, Customer};
use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Mail, DB, Log};

class OrderController extends Controller {
    public function checkout() {
        $cart = session('cart',[]);
        if (empty($cart)) return redirect()->route('products')->with('info','Your bag is empty. Add some shoes first!');
        $subtotal = array_sum(array_map(fn($i)=>$i['price']*$i['qty'], $cart));
        $shipping = $subtotal>=15000 ? 0 : 350;
        $tax      = $subtotal*0.17;
        $total    = $subtotal+$shipping+$tax;
        return view('shop.checkout', compact('cart','subtotal','shipping','tax','total'));
    }
    public function store(Request $request) {
        $cart = session('cart',[]);
        if (empty($cart)) return redirect()->route('products')->with('error','Your bag is empty.');
        $validated = $request->validate([
            'first_name'       => 'required|string|min:2|max:50',
            'last_name'        => 'required|string|min:2|max:50',
            'email'            => 'required|email|max:255',
            'phone'            => ['required','string','regex:/^0?3[0-9]{9}$/'],
            'address'          => 'required|string|min:5|max:500',
            'city'             => 'required|string|min:2|max:100',
            'province'         => 'required|string',
            'postal_code'      => 'nullable|string|max:10',
            'payment_method'   => 'required|in:card,easypaisa,cod',
            'card_number'      => 'required_if:payment_method,card|nullable|string|min:16|max:19',
            'card_expiry'      => ['required_if:payment_method,card','nullable','string','regex:/^\d{2}\/\d{2}$/'],
            'card_cvv'         => 'required_if:payment_method,card|nullable|string|min:3|max:4',
            'card_holder'      => 'required_if:payment_method,card|nullable|string|min:3|max:100',
            'easypaisa_number' => ['required_if:payment_method,easypaisa','nullable','string','regex:/^0?3[0-9]{9}$/'],
        ],[
            'first_name.required'=>'First name is required.',
            'first_name.min'=>'First name must be at least 2 characters.',
            'last_name.required'=>'Last name is required.',
            'last_name.min'=>'Last name must be at least 2 characters.',
            'email.required'=>'Email address is required.',
            'email.email'=>'Enter a valid email address.',
            'phone.required'=>'Phone number is required.',
            'phone.regex'=>'Enter a valid Pakistani mobile number (e.g. 03001234567).',
            'address.required'=>'Delivery address is required.',
            'address.min'=>'Please enter your complete address.',
            'city.required'=>'City is required.',
            'province.required'=>'Please select your province.',
            'payment_method.required'=>'Please select a payment method.',
            'card_number.required_if'=>'Card number is required.',
            'card_number.min'=>'Enter a valid 16-digit card number.',
            'card_expiry.required_if'=>'Card expiry date is required.',
            'card_expiry.regex'=>'Enter expiry in MM/YY format.',
            'card_cvv.required_if'=>'CVV is required.',
            'card_cvv.min'=>'CVV must be at least 3 digits.',
            'card_holder.required_if'=>'Cardholder name is required.',
            'easypaisa_number.required_if'=>'Easypaisa number is required.',
            'easypaisa_number.regex'=>'Enter a valid Easypaisa number.',
        ]);
        $subtotal = array_sum(array_map(fn($i)=>$i['price']*$i['qty'], $cart));
        $shipping = $subtotal>=15000 ? 0 : 350;
        $tax      = $subtotal*0.17;
        $total    = $subtotal+$shipping+$tax;
        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name'=>$validated['first_name'].' '.$validated['last_name'],
                'customer_email'=>$validated['email'],
                'customer_phone'=>$validated['phone'],
                'address'=>$validated['address'],
                'city'=>$validated['city'],
                'province'=>$validated['province'],
                'postal_code'=>$validated['postal_code'] ?? null,
                'payment_method'=>$validated['payment_method'],
                'subtotal'=>$subtotal,'shipping'=>$shipping,'tax'=>$tax,'total'=>$total,
                'status'=>'Processing',
            ]);
            foreach ($cart as $item) {
                OrderItem::create(['order_id'=>$order->id,'product_id'=>$item['id'],'product_name'=>$item['name'],'size'=>$item['size'],'color'=>'—','quantity'=>$item['qty'],'unit_price'=>$item['price'],'total_price'=>$item['price']*$item['qty']]);
                Product::where('id',$item['id'])->decrement('stock',$item['qty']);
            }
            $customer = Customer::firstOrNew(['email'=>$validated['email']]);
            $customer->name         = $validated['first_name'].' '.$validated['last_name'];
            $customer->phone        = $validated['phone'];
            $customer->city         = $validated['city'];
            $customer->province     = $validated['province'];
            $customer->total_orders = ($customer->total_orders ?? 0)+1;
            $customer->total_spent  = ($customer->total_spent ?? 0)+$total;
            $customer->save();
            DB::commit();
            try { Mail::to($validated['email'])->send(new OrderConfirmationMail($order)); } catch(\Exception $e){ Log::warning('Email failed: '.$e->getMessage()); }
            session()->forget('cart');
            return redirect()->route('orders.success',$order)->with('success','Order placed successfully!');
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('Order failed: '.$e->getMessage());
            return back()->withInput()->with('error','Something went wrong. Please try again.');
        }
    }
    public function success(Order $order) { $order->load('items'); return view('shop.order-success', compact('order')); }
}
