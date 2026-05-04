@extends('layouts.admin')
@section('title','Products')
@section('page-title','Products')
@section('content')
<div class="admin-tab-toolbar">
  <h3>All Products</h3>
  <a href="{{ route('admin.products.create') }}" class="btn-admin-action"><i class="fa fa-plus"></i> Add Product</a>
</div>
<div class="admin-card">
  <table id="products-table" class="display" style="width:100%">
    <thead><tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
  </table>
</div>
@push('scripts')
<script>
$('#products-table').DataTable({
  processing:true,serverSide:true,
  ajax:'{{ route("admin.dt.products") }}',
  columns:[{data:'id'},{data:'image_html',orderable:false},{data:'name'},{data:'category'},{data:'formatted_price'},{data:'stock_html'},{data:'status_badge',orderable:false},{data:'actions',orderable:false}],
  pageLength:10
});
</script>
@endpush
@endsection
