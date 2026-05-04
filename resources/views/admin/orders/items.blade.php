@extends('layouts.admin')
@section('title','Order Items')
@section('page-title','Order Items')
@section('content')
<div class="admin-card">
  <table id="order-items-table" class="display" style="width:100%">
    <thead><tr><th>Item ID</th><th>Order ID</th><th>Product</th><th>Size</th><th>Color</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>
  </table>
</div>
@push('scripts')
<script>
$('#order-items-table').DataTable({
  processing:true,serverSide:true,
  ajax:'{{ route("admin.dt.order-items") }}',
  columns:[{data:'id'},{data:'order_number'},{data:'product_name'},{data:'size'},{data:'color'},{data:'quantity'},{data:'formatted_unit_price'},{data:'formatted_total_price'}],
  pageLength:15
});
</script>
@endpush
@endsection
