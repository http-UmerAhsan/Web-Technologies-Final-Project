@extends('layouts.admin')
@section('title','Edit Product')
@section('page-title','Edit Product')
@section('content')
<div class="admin-card" style="max-width:800px">
  <a href="{{ route('admin.products.index') }}" style="display:inline-flex;align-items:center;gap:6px;font-family:var(--font-cond);font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#666;margin-bottom:24px;text-decoration:none"><i class="fa fa-arrow-left"></i> Back to Products</a>
  <form method="POST" action="{{ route('admin.products.update',$product) }}">
    @csrf @method('PUT')
    <div class="form-grid-2">
      <div class="form-field"><label>Name *</label><input type="text" name="name" value="{{ old('name',$product->name) }}" required></div>
      <div class="form-field"><label>Subtitle *</label><input type="text" name="subtitle" value="{{ old('subtitle',$product->subtitle) }}" required></div>
    </div>
    <div class="form-grid-2">
      <div class="form-field"><label>Category *</label>
        <select name="category" required>@foreach(['Running','Lifestyle','Basketball','Training'] as $c)<option value="{{ $c }}" {{ old('category',$product->category)==$c?'selected':'' }}>{{ $c }}</option>@endforeach</select>
      </div>
      <div class="form-field"><label>Badge</label>
        <select name="badge"><option value="">None</option><option value="NEW" {{ old('badge',$product->badge)==='NEW'?'selected':'' }}>NEW</option><option value="SALE" {{ old('badge',$product->badge)==='SALE'?'selected':'' }}>SALE</option></select>
      </div>
    </div>
    <div class="form-grid-2">
      <div class="form-field"><label>Price (PKR) *</label><input type="number" name="price" value="{{ old('price',$product->price) }}" required min="1"></div>
      <div class="form-field"><label>Old Price (PKR)</label><input type="number" name="old_price" value="{{ old('old_price',$product->old_price) }}" min="1"></div>
    </div>
    <div class="form-grid-2">
      <div class="form-field"><label>Stock *</label><input type="number" name="stock" value="{{ old('stock',$product->stock) }}" required min="0"></div>
      <div class="form-field"><label>Rating</label><input type="text" name="rating" value="{{ old('rating',$product->rating) }}"></div>
    </div>
    <div class="form-field"><label>Description *</label><textarea name="description" rows="4" required>{{ old('description',$product->description) }}</textarea></div>
    <div class="form-field"><label>Colors (comma-separated)</label><input type="text" name="colors" value="{{ old('colors',implode(', ',$product->colors??[])) }}" placeholder="#111, #fff, #e63312"></div>
    <div class="form-field"><label>Sizes (comma-separated)</label><input type="text" name="sizes" value="{{ old('sizes',implode(', ',$product->sizes??[])) }}" placeholder="7, 8, 9, 10"></div>
    <div class="form-field"><label>Image URLs (one per line)</label><textarea name="images" rows="3">{{ old('images',implode("\n",$product->images??[])) }}</textarea></div>
    <div style="display:flex;gap:12px;margin-top:8px">
      <button type="submit" class="btn-admin-action"><i class="fa fa-save"></i> Update Product</button>
      <form method="POST" action="{{ route('admin.products.destroy',$product) }}" onsubmit="return confirm('Delete this product?')">@csrf @method('DELETE')<button type="submit" class="tbl-btn tbl-btn-delete" style="padding:12px 24px;font-size:14px">Delete Product</button></form>
    </div>
  </form>
</div>
@endsection
