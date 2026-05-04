<?php $__env->startSection('title','NIKE Pakistan — Just Do It'); ?>
<?php $__env->startSection('content'); ?>
<section class="hero">
  <div class="hero-bg">
    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1400&q=80&auto=format&fit=crop" alt="Nike" class="hero-bg-img">
    <div class="hero-bg-overlay"></div>
  </div>
  <div class="hero-content">
    <div class="hero-eyebrow">New Arrivals &middot; Summer 2025</div>
    <h1 class="hero-title">JUST<br><span class="hero-title-accent">DO</span><br>IT.</h1>
    <p class="hero-sub">Engineered for champions.<br>Born for the streets of Pakistan.</p>
    <div class="hero-ctas">
      <a href="<?php echo e(route('products')); ?>" class="btn-hero-primary">Shop Now <i class="fa fa-arrow-right"></i></a>
      <a href="<?php echo e(route('products')); ?>" class="btn-hero-ghost">Explore All</a>
    </div>
  </div>
  <?php if($featured->first()): ?>
  <div class="hero-product-feature">
    <div class="hero-product-label">FEATURED DROP</div>
    <div class="hero-product-name"><?php echo e($featured->first()->name); ?></div>
    <div class="hero-product-price"><?php echo e($featured->first()->formatted_price); ?></div>
    <form method="POST" action="<?php echo e(route('cart.add')); ?>"><?php echo csrf_field(); ?>
      <input type="hidden" name="product_id" value="<?php echo e($featured->first()->id); ?>">
      <input type="hidden" name="size" value="<?php echo e($featured->first()->sizes[0] ?? '9'); ?>">
      <input type="hidden" name="qty" value="1">
      <button type="submit" class="btn-hero-add">+ Add to Bag</button>
    </form>
  </div>
  <?php endif; ?>
</section>

<div class="marquee-bar"><div class="marquee-track">
  <span>Air Max 270</span><span class="dot">●</span><span>Air Force 1</span><span class="dot">●</span><span>React Infinity</span><span class="dot">●</span><span>Just Do It</span><span class="dot">●</span><span>Pegasus 40</span><span class="dot">●</span><span>ZoomX</span><span class="dot">●</span><span>Jordan 1</span><span class="dot">●</span><span>Blazer Mid</span><span class="dot">●</span>
  <span>Air Max 270</span><span class="dot">●</span><span>Air Force 1</span><span class="dot">●</span><span>React Infinity</span><span class="dot">●</span><span>Just Do It</span><span class="dot">●</span><span>Pegasus 40</span><span class="dot">●</span><span>ZoomX</span><span class="dot">●</span><span>Jordan 1</span><span class="dot">●</span><span>Blazer Mid</span><span class="dot">●</span>
</div></div>

<section class="section featured-section">
  <div class="section-head">
    <div><div class="section-eyebrow">Curated For You</div><h2 class="section-title">TRENDING NOW</h2></div>
    <a href="<?php echo e(route('products')); ?>" class="section-link">View All <i class="fa fa-arrow-right"></i></a>
  </div>
  <div class="products-grid">
    <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="product-card">
      <?php if($product->badge): ?><div class="pc-badge <?php echo e($product->badge==='NEW'?'new':''); ?>"><?php echo e($product->badge); ?></div><?php endif; ?>
      <a href="<?php echo e(route('products.show',$product)); ?>" class="pc-img">
        <img src="<?php echo e($product->primary_image); ?>" alt="<?php echo e($product->name); ?>" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=70'">
      </a>
      <div class="pc-body">
        <div class="pc-cat"><?php echo e($product->category); ?></div>
        <div class="pc-name"><?php echo e($product->name); ?></div>
        <div class="pc-subtitle"><?php echo e($product->subtitle); ?></div>
        <div class="pc-price-row">
          <span class="pc-price"><?php echo e($product->formatted_price); ?></span>
          <?php if($product->old_price): ?><span class="pc-old-price"><?php echo e($product->formatted_old_price); ?></span><?php endif; ?>
        </div>
        <div class="pc-colors"><?php $__currentLoopData = $product->colors??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div class="pc-color" style="background:<?php echo e($c); ?>;border:2px solid <?php echo e($c==='#fff'?'#ddd':'transparent'); ?>"></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
        <form method="POST" action="<?php echo e(route('cart.add')); ?>"><?php echo csrf_field(); ?>
          <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
          <input type="hidden" name="size" value="<?php echo e($product->sizes[0] ?? '9'); ?>">
          <input type="hidden" name="qty" value="1">
          <button type="submit" class="btn-pc-add">Add to Bag</button>
        </form>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>

<section class="section categories-section">
  <div class="section-head centered"><div class="section-eyebrow">Shop By Category</div><h2 class="section-title">FIND YOUR FIT</h2></div>
  <div class="categories-grid">
    <a href="<?php echo e(route('products',['category'=>'Running'])); ?>" class="cat-card cat-large" style="--cat-img:url('https://images.unsplash.com/photo-1556906781-9a412961a28d?w=900&q=80&auto=format&fit=crop')">
      <div class="cat-glow"></div><div class="cat-content"><div class="cat-tag">PERFORMANCE</div><div class="cat-name">RUNNING</div><div class="cat-cta">Shop Now <i class="fa fa-arrow-right"></i></div></div>
    </a>
    <a href="<?php echo e(route('products',['category'=>'Basketball'])); ?>" class="cat-card" style="--cat-img:url('https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=600&q=80&auto=format&fit=crop')">
      <div class="cat-glow"></div><div class="cat-content"><div class="cat-tag">COURT</div><div class="cat-name">BASKETBALL</div><div class="cat-cta">Shop Now <i class="fa fa-arrow-right"></i></div></div>
    </a>
    <a href="<?php echo e(route('products',['category'=>'Lifestyle'])); ?>" class="cat-card" style="--cat-img:url('https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=600&q=80&auto=format&fit=crop')">
      <div class="cat-glow"></div><div class="cat-content"><div class="cat-tag">STREET</div><div class="cat-name">LIFESTYLE</div><div class="cat-cta">Shop Now <i class="fa fa-arrow-right"></i></div></div>
    </a>
    <a href="<?php echo e(route('products',['category'=>'Training'])); ?>" class="cat-card" style="--cat-img:url('https://images.unsplash.com/photo-1539185441755-769473a23570?w=600&q=80&auto=format&fit=crop')">
      <div class="cat-glow"></div><div class="cat-content"><div class="cat-tag">GYM</div><div class="cat-name">TRAINING</div><div class="cat-cta">Shop Now <i class="fa fa-arrow-right"></i></div></div>
    </a>
  </div>
</section>
<section class="brand-strip">
  <div class="brand-strip-inner">
    <div class="brand-stat"><span class="bs-num">200+</span><span class="bs-label">Styles</span></div>
    <div class="brand-divider"></div>
    <div class="brand-stat"><span class="bs-num">50K+</span><span class="bs-label">Happy Athletes</span></div>
    <div class="brand-divider"></div>
    <div class="brand-stat"><span class="bs-num">Free</span><span class="bs-label">Delivery Over Rs.15,000</span></div>
    <div class="brand-divider"></div>
    <div class="brand-stat"><span class="bs-num">60</span><span class="bs-label">Day Returns</span></div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/shop/home.blade.php ENDPATH**/ ?>