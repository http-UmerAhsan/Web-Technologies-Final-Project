@extends('layouts.app')
@section('title','All Shoes — Nike Pakistan')
@section('content')
<div class="products-page-wrap" style="padding-top:68px">
  <div class="products-hero">
    <div class="products-hero-text">
      <div class="section-eyebrow" style="color:var(--red)">All Styles &middot; Pakistan</div>
      <h1>SHOES</h1>
    </div>
    <div class="products-hero-meta">{{ $products->count() }} Results</div>
  </div>
  <div class="products-layout">
    <aside class="filters-sidebar">
      <form method="GET" action="{{ route('products') }}">
        <div class="filter-block">
          <div class="filter-title">Category</div>
          @foreach($categories as $cat)
          <label class="filter-check">
            <input type="checkbox" name="category[]" value="{{ $cat }}" {{ request('category')==$cat?'checked':'' }}> <span>{{ $cat }}</span>
          </label>
          @endforeach
        </div>
        <div class="filter-block">
          <div class="filter-title">Price (PKR)</div>
          <div class="price-range-wrap">
            <input type="number" name="min_price" class="price-input" placeholder="Min" value="{{ request('min_price') }}">
            <span>—</span>
            <input type="number" name="max_price" class="price-input" placeholder="Max" value="{{ request('max_price') }}">
          </div>
        </div>
        <button type="submit" class="btn-apply-filters">Apply Filters</button>
        <a href="{{ route('products') }}" class="btn-clear-filters" style="display:block;text-align:center;margin-top:8px;padding:12px;border:1px solid #e5e5e5;font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#666;text-decoration:none">Clear All</a>
      </form>
    </aside>
    <div class="products-main">
      <div class="products-toolbar">
        <div></div>
        <form method="GET" action="{{ route('products') }}">
          @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
          <select name="sort" class="sort-dropdown" onchange="this.form.submit()">
            <option value="featured" {{ request('sort')=='featured'?'selected':'' }}>Sort: Featured</option>
            <option value="price-low" {{ request('sort')=='price-low'?'selected':'' }}>Price: Low to High</option>
            <option value="price-high" {{ request('sort')=='price-high'?'selected':'' }}>Price: High to Low</option>
            <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Newest First</option>
          </select>
        </form>
      </div>
      @if($products->isEmpty())
      <div style="text-align:center;padding:80px 0;color:#aaa">
        <i class="fa fa-box-open" style="font-size:48px;margin-bottom:16px;display:block"></i>
        <p style="font-family:var(--font-head);font-size:28px">No products found</p>
        <a href="{{ route('products') }}" style="color:var(--red)">Clear filters</a>
      </div>
      @else
      <div class="products-grid">
        @foreach($products as $product)
        <div class="product-card">
          @if($product->badge)<div class="pc-badge {{ $product->badge==='NEW'?'new':'' }}">{{ $product->badge }}</div>@endif
          <a href="{{ route('products.show',$product) }}" class="pc-img">
            <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=70'">
          </a>
          <div class="pc-body">
            <div class="pc-cat">{{ $product->category }}</div>
            <div class="pc-name">{{ $product->name }}</div>
            <div class="pc-subtitle">{{ $product->subtitle }}</div>
            <div class="pc-price-row">
              <span class="pc-price">{{ $product->formatted_price }}</span>
              @if($product->old_price)<span class="pc-old-price">{{ $product->formatted_old_price }}</span>@endif
            </div>
            <div class="pc-colors">@foreach($product->colors??[] as $c)<div class="pc-color" style="background:{{$c}};border:2px solid {{$c==='#fff'?'#ddd':'transparent'}}"></div>@endforeach</div>
            <a href="{{ route('products.show',$product) }}" class="btn-pc-add" style="display:block;text-align:center;text-decoration:none">View & Add to Bag</a>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
