<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'total_revenue'   => 'Rs. '.number_format(Order::where('status','!=','Cancelled')->sum('total'),0),
            'total_orders'    => Order::count(),
            'total_products'  => Product::count(),
            'total_customers' => Customer::count(),
            'pending_orders'  => Order::where('status','Pending')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
    public function recentOrdersDatatable() {
        $orders = Order::select(['id','order_number','customer_name','total','status','created_at'])->latest()->limit(20);
        return DataTables::of($orders)
            ->addColumn('items_count', fn($o)=>$o->items()->count().' item(s)')
            ->addColumn('formatted_total', fn($o)=>$o->formatted_total)
            ->addColumn('status_badge', fn($o)=>$o->status_badge)
            ->addColumn('date', fn($o)=>$o->created_at->format('Y-m-d'))
            ->rawColumns(['status_badge'])
            ->make(true);
    }
}
