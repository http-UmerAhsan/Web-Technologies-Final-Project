@extends('layouts.admin')
@section('title','Add Product')
@section('page-title','Add Product')
@section('content')
<div class="admin-card" style="max-width:800px">
  <a href="{{ route('admin.products.index') }}" style="display:inline-flex;align-items:center;gap:6px;font-family:var(--font-cond);font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#666;margin-bottom:24px;text-decoration:none"><i class="fa fa-arrow-left"></i> Back to Products</a>
  @if($errors->any())<div style="background:#fef2f2;border-left:4px solid #e63312;padding:12px 16px;margin-bottom:20px;font-size:14px;color:#b91c1c"><ul style="margin:0;padding-left:16px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
  <form method="POST" action="{{ route('admin.products.store') }}">
    @csrf
    <div class="form-grid-2">
      <div class="form-field"><label>Name *</label><input type="text" name="name" value="{{ old('name') }}" required class="{{ $errors->has('name')?'is-error':'' }}"><div class="field-error">{{ $errors->first('name') }}</div></div>
      <div class="form-field"><label>Subtitle *</label><input type="text" name="subtitle" value="{{ old('subtitle') }}" required class="{{ $errors->has('subtitle')?'is-error':'' }}"></div>
    </div>
    <div class="form-grid-2">
      <div class="form-field"><label>Category *</label>
        <select name="category" required><option value="">Select</option>@foreach(['Running','Lifestyle','Basketball','Training'] as $c)<option value="{{ $c }}" {{ old('category')==$c?'selected':'' }}>{{ $c }}</option>@endforeach</select>
      </div>
      <div class="form-field"><label>Badge</label>
        <select name="badge"><option value="">None</option><option value="NEW" {{ old('badge')==='NEW'?'selected':'' }}>NEW</option><option value="SALE" {{ old('badge')==='SALE'?'selected':'' }}>SALE</option></select>
      </div>
    </div>
    <div class="form-grid-2">
      <div class="form-field"><label>Price (PKR) *</label><input type="number" name="price" value="{{ old('price') }}" required min="1" class="{{ $errors->has('price')?'is-error':'' }}"><div class="field-error">{{ $errors->first('price') }}</div></div>
      <div class="form-field"><label>Old Price (PKR)</label><input type="number" name="old_price" value="{{ old('old_price') }}" min="1"></div>
    </div>
    <div class="form-grid-2">
      <div class="form-field"><label>Stock *</label><input type="number" name="stock" value="{{ old('stock',0) }}" required min="0"></div>
      <div class="form-field"><label>Rating</label><input type="text" name="rating" value="{{ old('rating') }}" placeholder="4.8 (1,200 reviews)"></div>
    </div>
    <div class="form-field"><label>Description *</label><textarea name="description" rows="4" required class="{{ $errors->has('description')?'is-error':'' }}">{{ old('description') }}</textarea><div class="field-error">{{ $errors->first('description') }}</div></div>
    <div class="form-field"><label>Colors (comma-separated hex codes)</label><input type="text" name="colors" value="{{ old('colors') }}" placeholder="#111, #fff, #e63312"></div>
    <div class="form-field"><label>Sizes (comma-separated)</label><input type="text" name="sizes" value="{{ old('sizes') }}" placeholder="7, 7.5, 8, 8.5, 9, 10"></div>
    <div class="form-field"><label>Image URLs (one per line)</label><textarea name="images" rows="3" placeholder="https://images.unsplash.com/...">{{ old('images') }}</textarea></div>
    <button type="submit" class="btn-admin-action" style="margin-top:8px"><i class="fa fa-save"></i> Create Product</button>
  </form>
</div>
@endsection
