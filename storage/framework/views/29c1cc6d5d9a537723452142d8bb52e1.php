<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title','NIKE Pakistan — Just Do It'); ?></title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700;900&family=Barlow+Condensed:wght@300;400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
<?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<nav id="main-nav">
  <a href="<?php echo e(route('home')); ?>" class="nav-logo">
    <svg class="swoosh" viewBox="0 0 24 9"><path d="M24 0L3.413 6.842 0 6.853 21.7 0z"/></svg><span>NIKE</span>
  </a>
  <ul class="nav-links">
    <li><a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home')?'active':''); ?>">Home</a></li>
    <li><a href="<?php echo e(route('products')); ?>" class="<?php echo e(request()->routeIs('products*')?'active':''); ?>">Products</a></li>
    <li><a href="<?php echo e(route('contact')); ?>" class="<?php echo e(request()->routeIs('contact')?'active':''); ?>">Contact</a></li>
    <li><a href="<?php echo e(route('admin.login')); ?>" class="admin-link"><i class="fa fa-shield-halved"></i> Admin</a></li>
  </ul>
  <div class="nav-right">
    <div class="nav-icon"><i class="fa fa-magnifying-glass"></i></div>
    <a href="<?php echo e(route('cart.index')); ?>" class="nav-icon cart-icon">
      <i class="fa fa-bag-shopping"></i>
      <span class="cart-badge" id="cart-badge"><?php echo e(array_sum(array_column(session('cart',[]),'qty'))); ?></span>
    </a>
  </div>
</nav>

<?php if(session('success')): ?><div class="flash-msg flash-success"><i class="fa fa-circle-check"></i> <?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="flash-msg flash-error"><i class="fa fa-triangle-exclamation"></i> <?php echo e(session('error')); ?></div><?php endif; ?>
<?php if(session('info')): ?><div class="flash-msg flash-info"><i class="fa fa-circle-info"></i> <?php echo e(session('info')); ?></div><?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-brand-col">
      <svg viewBox="0 0 48 18" style="width:48px;margin-bottom:16px"><path d="M48 0L6.826 13.684 0 13.706 43.4 0z" fill="white"/></svg>
      <p class="footer-tagline">Bringing inspiration and innovation to every athlete in Pakistan.</p>
      <div class="footer-social">
        <a href="#" class="social-ic"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-ic"><i class="fab fa-twitter"></i></a>
        <a href="#" class="social-ic"><i class="fab fa-facebook"></i></a>
        <a href="https://github.com/http-UmerAhsan" target="_blank" class="social-ic"><i class="fab fa-github"></i></a>
      </div>
    </div>
    <div class="footer-col"><h4>Shop</h4><a href="<?php echo e(route('products')); ?>">All Shoes</a><a href="<?php echo e(route('products',['category'=>'Running'])); ?>">Running</a><a href="<?php echo e(route('products',['category'=>'Basketball'])); ?>">Basketball</a><a href="<?php echo e(route('products',['category'=>'Lifestyle'])); ?>">Lifestyle</a></div>
    <div class="footer-col"><h4>Help</h4><a href="#">Order Status</a><a href="#">Shipping & Delivery</a><a href="#">Returns</a><a href="#">Size Guide</a></div>
    <div class="footer-col"><h4>Company</h4><a href="#">About Nike</a><a href="#">Careers</a><a href="<?php echo e(route('contact')); ?>">Contact Us</a><a href="https://github.com/http-UmerAhsan" target="_blank">GitHub</a></div>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?php echo e(date('Y')); ?> Nike, Inc. All Rights Reserved &middot; Pakistan</p>
    <div class="footer-legal"><a href="#">Privacy Policy</a><a href="#">Terms of Use</a></div>
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
<script>
setTimeout(()=>{ document.querySelectorAll('.flash-msg').forEach(el=>{ el.style.opacity='0'; setTimeout(()=>el.remove(),400); }); },4000);
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
</script>
</body>
</html>
<?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>