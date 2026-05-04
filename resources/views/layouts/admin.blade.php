<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Admin') — Nike Pakistan</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700;900&family=Barlow+Condensed:wght@300;400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')
</head>
<body>
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="admin-brand">
      <svg viewBox="0 0 24 9" width="28"><path d="M24 0L3.413 6.842 0 6.853 21.7 0z" fill="white"/></svg>
      <span>NIKE <em>ADMIN</em></span>
    </div>
    <nav class="admin-nav">
      <div class="nav-group-label">OVERVIEW</div>
      <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard')?'active':'' }}"><i class="fa fa-gauge-high"></i><span>Dashboard</span></a>
      <div class="nav-group-label">CATALOG</div>
      <a href="{{ route('admin.products.index') }}" class="admin-nav-item {{ request()->routeIs('admin.products*')?'active':'' }}"><i class="fa fa-box-open"></i><span>Products</span></a>
      <div class="nav-group-label">SALES</div>
      <a href="{{ route('admin.orders.index') }}" class="admin-nav-item {{ request()->routeIs('admin.orders.index')?'active':'' }}"><i class="fa fa-cart-shopping"></i><span>Orders</span></a>
      <a href="{{ route('admin.order-items.index') }}" class="admin-nav-item {{ request()->routeIs('admin.order-items*')?'active':'' }}"><i class="fa fa-list-check"></i><span>Order Items</span></a>
      <div class="nav-group-label">CUSTOMERS</div>
      <a href="{{ route('admin.users.index') }}" class="admin-nav-item {{ request()->routeIs('admin.users*')?'active':'' }}"><i class="fa fa-users"></i><span>Users</span></a>
      <div class="nav-group-label">STORE</div>
      <a href="{{ route('home') }}" class="admin-nav-item"><i class="fa fa-store"></i><span>View Store</span></a>
      <form method="POST" action="{{ route('admin.logout') }}">@csrf
        <button type="submit" class="admin-nav-item logout-item" style="width:100%;background:none;border:none;text-align:left;cursor:pointer;color:rgba(255,100,80,.6);font-family:var(--font-cond);font-size:14px;font-weight:600;letter-spacing:1px;text-transform:uppercase;display:flex;align-items:center;gap:14px;padding:12px 24px">
          <i class="fa fa-right-from-bracket"></i><span>Logout</span>
        </button>
      </form>
    </nav>
    <div class="admin-sidebar-footer">
      <div class="admin-avatar-mini">UA</div>
      <div><div class="av-name">{{ session('admin_username','Admin') }}</div><div class="av-role">Administrator</div></div>
    </div>
  </aside>
  <div class="admin-main">
    <div class="admin-topbar">
      <h2>@yield('page-title','Dashboard')</h2>
      <div class="admin-topbar-right">
        <form method="POST" action="{{ route('admin.logout') }}">@csrf
          <button type="submit" class="admin-logout-btn"><i class="fa fa-right-from-bracket"></i> Logout</button>
        </form>
        <div class="topbar-avatar">UA</div>
      </div>
    </div>
    <div class="admin-content">
      @if(session('success'))<div class="alert-success"><i class="fa fa-circle-check"></i> {{ session('success') }}</div>@endif
      @if(session('error'))<div class="alert-error"><i class="fa fa-triangle-exclamation"></i> {{ session('error') }}</div>@endif
      @yield('content')
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@stack('scripts')
<script>$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});</script>
</body>
</html>
