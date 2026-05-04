@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('content')
<div class="stat-cards">
  <div class="stat-card" style="--accent:#e63312"><div class="sc-icon"><i class="fa fa-coins"></i></div><div class="sc-num">{{ $stats['total_revenue'] }}</div><div class="sc-label">Total Revenue</div><div class="sc-change up">This month</div></div>
  <div class="stat-card" style="--accent:#1a7a1a"><div class="sc-icon"><i class="fa fa-cart-shopping"></i></div><div class="sc-num">{{ $stats['total_orders'] }}</div><div class="sc-label">Total Orders</div><div class="sc-change up">{{ $stats['pending_orders'] }} pending</div></div>
  <div class="stat-card" style="--accent:#0c5460"><div class="sc-icon"><i class="fa fa-box-open"></i></div><div class="sc-num">{{ $stats['total_products'] }}</div><div class="sc-label">Products</div><div class="sc-change up">In catalog</div></div>
  <div class="stat-card" style="--accent:#856404"><div class="sc-icon"><i class="fa fa-users"></i></div><div class="sc-num">{{ $stats['total_customers'] }}</div><div class="sc-label">Customers</div><div class="sc-change up">Registered</div></div>
</div>
<div class="admin-card">
  <div class="admin-card-head"><h3>Recent Orders</h3></div>
  <table id="recent-orders-table" class="display" style="width:100%">
    <thead><tr><th>Order ID</th><th>Customer</th><th>Items</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
  </table>
</div>
@push('scripts')
<script>
$('#recent-orders-table').DataTable({
  processing:true, serverSide:true,
  ajax:'{{ route("admin.dt.recent-orders") }}',
  columns:[{data:'order_number'},{data:'customer_name'},{data:'items_count'},{data:'formatted_total'},{data:'status_badge'},{data:'date'}],
  pageLength:10, order:[[5,'desc']]
});
</script>
@endpush
@endsection
