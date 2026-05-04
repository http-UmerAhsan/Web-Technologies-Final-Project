<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller {
    public function index() { return view('admin.orders.index'); }
    public function datatable() {
        $orders = Order::withCount('items')->latest();
        return DataTables::of($orders)
            ->addColumn('formatted_subtotal', fn($o)=>$o->formatted_subtotal)
            ->addColumn('formatted_total',    fn($o)=>$o->formatted_total)
            ->addColumn('status_badge',       fn($o)=>$o->status_badge)
            ->addColumn('date',               fn($o)=>$o->created_at->format('Y-m-d'))
            ->addColumn('actions', fn($o)=>'<a href="'.route('admin.orders.show',$o).'" class="tbl-btn tbl-btn-view">View</a>')
            ->rawColumns(['status_badge','actions'])
            ->make(true);
    }
    public function show(Order $order) { $order->load('items.product'); return view('admin.orders.show', compact('order')); }
    public function updateStatus(Request $request, Order $order) {
        $request->validate(['status'=>'required|in:Pending,Processing,Shipped,Delivered,Cancelled']);
        $order->update(['status'=>$request->status]);
        return back()->with('success','Order status updated to '.$request->status);
    }
    public function items() { return view('admin.orders.items'); }
    public function itemsDatatable() {
        $items = OrderItem::with(['order','product'])->latest();
        return DataTables::of($items)
            ->addColumn('order_number', fn($i)=>optional($i->order)->order_number ?? '—')
            ->addColumn('formatted_unit_price',  fn($i)=>$i->formatted_unit_price)
            ->addColumn('formatted_total_price', fn($i)=>$i->formatted_total_price)
            ->make(true);
    }
}
