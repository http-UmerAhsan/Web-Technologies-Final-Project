<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Admin Login — Nike Pakistan</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&family=Barlow+Condensed:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body>
<div class="login-page">
  <div class="login-left">
    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=900&q=80&auto=format&fit=crop" alt="Nike" class="login-bg-img">
    <div class="login-left-overlay"></div>
    <div class="login-left-content">
      <svg viewBox="0 0 48 18" width="64"><path d="M48 0L6.826 13.684 0 13.706 43.4 0z" fill="white"/></svg>
      <div class="login-brand-title">ADMIN PANEL</div>
      <div class="login-brand-sub">Nike Pakistan — Management System</div>
    </div>
  </div>
  <div class="login-right">
    <div class="login-form-wrap">
      <div style="margin-bottom:40px"><svg viewBox="0 0 48 18" width="48"><path d="M48 0L6.826 13.684 0 13.706 43.4 0z" fill="black"/></svg></div>
      <h2 class="login-title">Welcome Back</h2>
      <p class="login-subtitle">Sign in to access the admin dashboard</p>
      <?php if($errors->has('general')): ?>
      <div class="login-error"><i class="fa fa-triangle-exclamation"></i><span><?php echo e($errors->first('general')); ?></span></div>
      <?php endif; ?>
      <?php if(session('success')): ?>
      <div class="login-error" style="background:#f0fdf4;border-color:#86efac;border-left-color:#16a34a;color:#15803d"><i class="fa fa-circle-check"></i><span><?php echo e(session('success')); ?></span></div>
      <?php endif; ?>
      <form method="POST" action="<?php echo e(route('admin.login.post')); ?>" novalidate>
        <?php echo csrf_field(); ?>
        <div class="form-field">
          <label>Username <span class="req">*</span></label>
          <div class="input-wrap">
            <i class="fa fa-user input-icon"></i>
            <input type="text" name="username" value="<?php echo e(old('username')); ?>" placeholder="Enter your username" class="<?php echo e($errors->has('username')?'is-error':''); ?>" autocomplete="username">
          </div>
          <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="field-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-field">
          <label>Password <span class="req">*</span></label>
          <div class="input-wrap">
            <i class="fa fa-lock input-icon"></i>
            <input type="password" name="password" id="pw-input" placeholder="Enter your password" class="<?php echo e($errors->has('password')?'is-error':''); ?>" autocomplete="current-password">
            <button type="button" class="toggle-pw" onclick="togglePw()"><i class="fa fa-eye" id="pw-eye"></i></button>
          </div>
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="field-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit" class="btn-login"><span>Sign In</span><i class="fa fa-arrow-right"></i></button>
      </form>
      <a href="<?php echo e(route('home')); ?>" class="btn-back-store"><i class="fa fa-arrow-left"></i> Back to Store</a>
      <div class="login-hint"><i class="fa fa-circle-info"></i> Demo: <strong>UmerAhsan</strong> / <strong>admin99</strong></div>
    </div>
  </div>
</div>
<script>
function togglePw(){const i=document.getElementById('pw-input'),e=document.getElementById('pw-eye');i.type=i.type==='password'?'text':'password';e.className=i.type==='password'?'fa fa-eye':'fa fa-eye-slash';}
</script>
</body>
</html>
<?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>