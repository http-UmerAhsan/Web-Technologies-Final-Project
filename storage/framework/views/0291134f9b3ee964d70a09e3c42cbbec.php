<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title','Admin'); ?> — Nike Pakistan</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700;900&family=Barlow+Condensed:wght@300;400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
<?php echo $__env->yieldPushContent('styles'); ?>
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
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-nav-item <?php echo e(request()->routeIs('admin.dashboard')?'active':''); ?>"><i class="fa fa-gauge-high"></i><span>Dashboard</span></a>
      <div class="nav-group-label">CATALOG</div>
      <a href="<?php echo e(route('admin.products.index')); ?>" class="admin-nav-item <?php echo e(request()->routeIs('admin.products*')?'active':''); ?>"><i class="fa fa-box-open"></i><span>Products</span></a>
      <div class="nav-group-label">SALES</div>
      <a href="<?php echo e(route('admin.orders.index')); ?>" class="admin-nav-item <?php echo e(request()->routeIs('admin.orders.index')?'active':''); ?>"><i class="fa fa-cart-shopping"></i><span>Orders</span></a>
      <a href="<?php echo e(route('admin.order-items.index')); ?>" class="admin-nav-item <?php echo e(request()->routeIs('admin.order-items*')?'active':''); ?>"><i class="fa fa-list-check"></i><span>Order Items</span></a>
      <div class="nav-group-label">CUSTOMERS</div>
      <a href="<?php echo e(route('admin.users.index')); ?>" class="admin-nav-item <?php echo e(request()->routeIs('admin.users*')?'active':''); ?>"><i class="fa fa-users"></i><span>Users</span></a>
      <div class="nav-group-label">STORE</div>
      <a href="<?php echo e(route('home')); ?>" class="admin-nav-item"><i class="fa fa-store"></i><span>View Store</span></a>
      <form method="POST" action="<?php echo e(route('admin.logout')); ?>"><?php echo csrf_field(); ?>
        <button type="submit" class="admin-nav-item logout-item" style="width:100%;background:none;border:none;text-align:left;cursor:pointer;color:rgba(255,100,80,.6);font-family:var(--font-cond);font-size:14px;font-weight:600;letter-spacing:1px;text-transform:uppercase;display:flex;align-items:center;gap:14px;padding:12px 24px">
          <i class="fa fa-right-from-bracket"></i><span>Logout</span>
        </button>
      </form>
    </nav>
    <div class="admin-sidebar-footer">
      <div class="admin-avatar-mini">UA</div>
      <div><div class="av-name"><?php echo e(session('admin_username','Admin')); ?></div><div class="av-role">Administrator</div></div>
    </div>
  </aside>
  <div class="admin-main">
    <div class="admin-topbar">
      <h2><?php echo $__env->yieldContent('page-title','Dashboard'); ?></h2>
      <div class="admin-topbar-right">
        <form method="POST" action="<?php echo e(route('admin.logout')); ?>"><?php echo csrf_field(); ?>
          <button type="submit" class="admin-logout-btn"><i class="fa fa-right-from-bracket"></i> Logout</button>
        </form>
        <div class="topbar-avatar">UA</div>
      </div>
    </div>
    <div class="admin-content">
      <?php if(session('success')): ?><div class="alert-success"><i class="fa fa-circle-check"></i> <?php echo e(session('success')); ?></div><?php endif; ?>
      <?php if(session('error')): ?><div class="alert-error"><i class="fa fa-triangle-exclamation"></i> <?php echo e(session('error')); ?></div><?php endif; ?>
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
<script>$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});</script>
</body>
</html>
<?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/layouts/admin.blade.php ENDPATH**/ ?>