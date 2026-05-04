<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller {
    public function index() { return view('admin.users.index'); }
    public function datatable() {
        $users = Customer::query()->latest();
        return DataTables::of($users)
            ->addColumn('formatted_spent', fn($u)=>$u->formatted_total_spent)
            ->addColumn('date', fn($u)=>$u->created_at->format('Y-m-d'))
            ->addColumn('actions', fn($u)=>'<a href="'.route('admin.users.show',$u).'" class="tbl-btn tbl-btn-view">View</a>')
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function show(Customer $user) { return view('admin.users.show', compact('user')); }
}
