<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller {
    public function index() { return view('admin.products.index'); }
    public function datatable() {
        $products = Product::query();
        return DataTables::of($products)
            ->addColumn('image_html', fn($p)=>'<img src="'.$p->primary_image.'" style="width:52px;height:52px;object-fit:cover;border-radius:2px" alt="">')
            ->addColumn('formatted_price', fn($p)=>$p->formatted_price)
            ->addColumn('stock_html', fn($p)=>$p->stock>20?$p->stock:'<span style="color:#e63312;font-weight:700">'.$p->stock.' ⚠</span>')
            ->addColumn('status_badge', fn($p)=>$p->stock>0?'<span class="status-badge status-delivered">In Stock</span>':'<span class="status-badge status-cancelled">Out of Stock</span>')
            ->addColumn('actions', function($p){
                $edit = route('admin.products.edit',$p);
                $del  = route('admin.products.destroy',$p);
                return '<a href="'.$edit.'" class="tbl-btn tbl-btn-edit">Edit</a>'
                    . '<form method="POST" action="'.$del.'" style="display:inline" onsubmit="return confirm(\'Delete '.$p->name.'?\')">'
                    . csrf_field() . method_field('DELETE')
                    . '<button class="tbl-btn tbl-btn-delete">Delete</button></form>';
            })
            ->rawColumns(['image_html','stock_html','status_badge','actions'])
            ->make(true);
    }
    public function create() { return view('admin.products.create'); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|string|max:255','subtitle'=>'required|string|max:255','category'=>'required|string','price'=>'required|numeric|min:1','old_price'=>'nullable|numeric','description'=>'required|string','stock'=>'required|integer|min:0','badge'=>'nullable|string|max:20','rating'=>'nullable|string|max:100']);
        $data['colors'] = array_values(array_filter(array_map('trim', explode(',', $request->input('colors','')))));
        $data['sizes']  = array_values(array_filter(array_map('trim', explode(',', $request->input('sizes','')))));
        $data['images'] = array_values(array_filter(array_map('trim', explode("\n", $request->input('images','')))));
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Product created successfully!');
    }
    public function edit(Product $product) { return view('admin.products.edit', compact('product')); }
    public function update(Request $request, Product $product) {
        $data = $request->validate(['name'=>'required|string|max:255','subtitle'=>'required|string|max:255','category'=>'required|string','price'=>'required|numeric|min:1','old_price'=>'nullable|numeric','description'=>'required|string','stock'=>'required|integer|min:0','badge'=>'nullable|string|max:20']);
        $data['colors'] = array_values(array_filter(array_map('trim', explode(',', $request->input('colors','')))));
        $data['sizes']  = array_values(array_filter(array_map('trim', explode(',', $request->input('sizes','')))));
        $data['images'] = array_values(array_filter(array_map('trim', explode("\n", $request->input('images','')))));
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Product updated!');
    }
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted.');
    }
    public function show(Product $product) { return redirect()->route('admin.products.edit',$product); }
}
