@extends('layouts.admin')
@section('title','Customers')
@section('page-title','Customers')
@section('content')
<div class="admin-card">
  <table id="users-table" class="display" style="width:100%">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>City</th><th>Province</th><th>Orders</th><th>Total Spent</th><th>Joined</th><th>Actions</th></tr></thead>
  </table>
</div>
@push('scripts')
<script>
$('#users-table').DataTable({
  processing:true,serverSide:true,
  ajax:'{{ route("admin.dt.users") }}',
  columns:[{data:'id'},{data:'name'},{data:'email'},{data:'city'},{data:'province'},{data:'total_orders'},{data:'formatted_spent'},{data:'date'},{data:'actions',orderable:false}],
  pageLength:15
});
</script>
@endpush
@endsection
