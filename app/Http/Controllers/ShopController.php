<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller {
    public function home() {
        $featured = Product::inStock()->latest()->take(6)->get();
        return view('shop.home', compact('featured'));
    }
    public function products(Request $request) {
        $query = Product::query();
        if ($request->filled('category')) $query->where('category',$request->category);
        if ($request->filled('min_price')) $query->where('price','>=',$request->min_price);
        if ($request->filled('max_price')) $query->where('price','<=',$request->max_price);
        match($request->sort ?? '') {
            'price-low'  => $query->orderBy('price','asc'),
            'price-high' => $query->orderBy('price','desc'),
            'newest'     => $query->latest(),
            default      => $query->latest(),
        };
        $products   = $query->get();
        $categories = Product::distinct()->pluck('category');
        return view('shop.products', compact('products','categories'));
    }
    public function show(Product $product) {
        $related = Product::where('category',$product->category)->where('id','!=',$product->id)->take(4)->get();
        return view('shop.show', compact('product','related'));
    }
}
