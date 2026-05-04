@extends('layouts.admin')
@section('title','Orders')
@section('page-title','Orders')
@section('content')
<div class="admin-card">
  <table id="orders-table" class="display" style="width:100%">
    <thead><tr><th>Order ID</th><th>Customer</th><th>Email</th><th>Items</th><th>Subtotal</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
  </table>
</div>
@push('scripts')
<script>
$('#orders-table').DataTable({
  processing:true,serverSide:true,
  ajax:'{{ route("admin.dt.orders") }}',
  columns:[{data:'order_number'},{data:'customer_name'},{data:'customer_email'},{data:'items_count'},{data:'formatted_subtotal'},{data:'formatted_total'},{data:'status_badge',orderable:false},{data:'date'},{data:'actions',orderable:false}],
  pageLength:15,order:[[7,'desc']]
});
</script>
@endpush
@endsection
