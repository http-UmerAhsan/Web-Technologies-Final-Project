<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller {
    private function getCart(): array { return session('cart',[]); }
    private function saveCart(array $cart): void { session(['cart'=>$cart]); }
    public function index() {
        $cart  = $this->getCart();
        $total = array_sum(array_map(fn($i)=>$i['price']*$i['qty'], $cart));
        return view('shop.cart', compact('cart','total'));
    }
    public function add(Request $request) {
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'size'=>'required|string',
            'qty'=>'required|integer|min:1|max:10',
        ],[
            'product_id.required'=>'Product is required.',
            'product_id.exists'=>'Product not found.',
            'size.required'=>'Please select a size.',
            'qty.min'=>'Quantity must be at least 1.',
            'qty.max'=>'Maximum 10 per product.',
        ]);
        $product = Product::findOrFail($request->product_id);
        $cart    = $this->getCart();
        $key     = $product->id.'_'.$request->size;
        if (isset($cart[$key])) $cart[$key]['qty'] = min($cart[$key]['qty']+$request->qty,10);
        else $cart[$key] = ['id'=>$product->id,'name'=>$product->name,'price'=>$product->price,'size'=>$request->size,'qty'=>$request->qty,'image'=>$product->primary_image];
        $this->saveCart($cart);
        if ($request->expectsJson()) return response()->json(['success'=>true,'message'=>$product->name.' added to bag!','count'=>array_sum(array_column($cart,'qty'))]);
        return back()->with('success',$product->name.' added to your bag!');
    }
    public function update(Request $request, string $rowId) {
        $request->validate(['qty'=>'required|integer|min:1|max:10']);
        $cart = $this->getCart();
        if (isset($cart[$rowId])) { $cart[$rowId]['qty']=$request->qty; $this->saveCart($cart); }
        return response()->json(['success'=>true,'count'=>array_sum(array_column($cart,'qty'))]);
    }
    public function remove(string $rowId) {
        $cart = $this->getCart();
        unset($cart[$rowId]);
        $this->saveCart($cart);
        return response()->json(['success'=>true,'count'=>array_sum(array_column($cart,'qty'))]);
    }
    public function count() {
        $cart = $this->getCart();
        return response()->json(['count'=>array_sum(array_column($cart,'qty'))]);
    }
}
