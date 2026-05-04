<?php $__env->startSection('title', $product->name.' — Nike Pakistan'); ?>
<?php $__env->startSection('content'); ?>
<div style="padding-top:68px">
<div class="single-wrap">
  <div class="product-gallery">
    <div class="gallery-main">
      <div class="gallery-main-inner">
        <img src="<?php echo e($product->primary_image); ?>" alt="<?php echo e($product->name); ?>" id="main-img" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80'">
      </div>
    </div>
    <div class="gallery-thumbs">
      <?php $__currentLoopData = $product->images??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="g-thumb <?php echo e($i===0?'active':''); ?>" onclick="document.getElementById('main-img').src='<?php echo e($img); ?>';document.querySelectorAll('.g-thumb').forEach(t=>t.classList.remove('active'));this.classList.add('active')">
        <img src="<?php echo e($img); ?>" alt="" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=60'">
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <div class="product-info-panel">
    <a href="<?php echo e(route('products')); ?>" class="back-link"><i class="fa fa-arrow-left"></i> Back to Shoes</a>
    <div class="product-breadcrumb"><?php echo e($product->category); ?></div>
    <h1 class="product-detail-title"><?php echo e($product->name); ?></h1>
    <div class="product-subtitle"><?php echo e($product->subtitle); ?></div>
    <div class="product-rating-row">
      <span class="stars">★★★★★</span>
      <span class="rating-text"><?php echo e($product->rating); ?></span>
    </div>
    <div class="product-price-block">
      <span class="detail-price"><?php echo e($product->formatted_price); ?></span>
      <?php if($product->old_price): ?>
      <span class="detail-old-price"><?php echo e($product->formatted_old_price); ?></span>
      <span class="detail-save-badge">SAVE <?php echo e($product->discount_percent); ?>%</span>
      <?php endif; ?>
    </div>

    <?php if(session('success')): ?><div style="background:#d4edda;border:1px solid #b8ddb8;padding:12px 16px;margin-bottom:16px;font-size:14px;color:#1a5a1a"><i class="fa fa-circle-check"></i> <?php echo e(session('success')); ?></div><?php endif; ?>
    <?php if($errors->any()): ?><div style="background:#fef2f2;border:1px solid #fca5a5;border-left:4px solid #e63312;padding:12px 16px;margin-bottom:16px;font-size:14px;color:#b91c1c"><i class="fa fa-triangle-exclamation"></i> <?php echo e($errors->first()); ?></div><?php endif; ?>

    <form method="POST" action="<?php echo e(route('cart.add')); ?>" id="add-to-cart-form">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
      <div class="detail-section-label">Color</div>
      <div class="detail-colors">
        <?php $__currentLoopData = $product->colors??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="color-swatch <?php echo e($i===0?'active':''); ?>" style="background:<?php echo e($c); ?>;<?php echo e($c==='#fff'?'border:2px solid #ccc!important;':''); ?>" onclick="document.querySelectorAll('.color-swatch').forEach(s=>s.classList.remove('active'));this.classList.add('active')"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="detail-section-label">Select Size (UK)</div>
      <div id="size-error-msg" class="size-error-msg" style="display:none"><i class="fa fa-triangle-exclamation"></i> Please select a size to continue</div>
      <div class="detail-sizes" id="sizes-container">
        <?php $__currentLoopData = $product->sizes??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label class="sz-option-label">
          <input type="radio" name="size" value="<?php echo e($size); ?>" style="display:none" required>
          <div class="sz-option" onclick="document.querySelectorAll('.sz-option').forEach(s=>s.classList.remove('active'));this.classList.add('active');this.previousElementSibling.checked=true;document.getElementById('size-error-msg').style.display='none'"><?php echo e($size); ?></div>
        </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="detail-section-label">Quantity</div>
      <div class="qty-control">
        <button type="button" class="qty-btn" onclick="let q=document.getElementById('qty-inp');q.value=Math.max(1,parseInt(q.value)-1)">−</button>
        <input type="number" name="qty" id="qty-inp" value="1" min="1" max="10" class="qty-val" style="width:52px;text-align:center;border:none;font-family:var(--font-head);font-size:24px">
        <button type="button" class="qty-btn" onclick="let q=document.getElementById('qty-inp');q.value=Math.min(10,parseInt(q.value)+1)">+</button>
      </div>
      <div class="product-actions">
        <button type="submit" class="btn-add-to-bag"><i class="fa fa-bag-shopping"></i> Add to Bag</button>
      </div>
    </form>

    <div class="product-perks">
      <div class="perk"><i class="fa fa-truck"></i> Free delivery on orders over Rs. 15,000</div>
      <div class="perk"><i class="fa fa-rotate-left"></i> Free 60-day returns</div>
      <div class="perk"><i class="fa fa-shield-halved"></i> Authentic Nike product</div>
    </div>
    <div class="product-accordions">
      <div class="accord-item">
        <button class="accord-btn" type="button" onclick="toggleAcc(this)"><span>Product Description</span><i class="fa fa-plus"></i></button>
        <div class="accord-body"><p><?php echo e($product->description); ?></p></div>
      </div>
      <div class="accord-item">
        <button class="accord-btn" type="button" onclick="toggleAcc(this)"><span>Size & Fit</span><i class="fa fa-plus"></i></button>
        <div class="accord-body"><p>Runs true to size. For the best fit, measure your foot length and compare with our size chart.</p></div>
      </div>
      <div class="accord-item">
        <button class="accord-btn" type="button" onclick="toggleAcc(this)"><span>Shipping & Returns</span><i class="fa fa-plus"></i></button>
        <div class="accord-body"><p>Free standard delivery (3–5 business days) on orders over Rs. 15,000. Express delivery Rs. 500. Returns within 60 days.</p></div>
      </div>
    </div>
  </div>
</div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
function toggleAcc(btn){
  var body=btn.nextElementSibling,icon=btn.querySelector('i'),open=body.classList.contains('open');
  document.querySelectorAll('.accord-body').forEach(b=>b.classList.remove('open'));
  document.querySelectorAll('.accord-btn i').forEach(i=>i.className='fa fa-plus');
  if(!open){body.classList.add('open');icon.className='fa fa-minus';}
}
document.getElementById('add-to-cart-form').addEventListener('submit',function(e){
  if(!document.querySelector('input[name="size"]:checked')){
    e.preventDefault();
    document.getElementById('size-error-msg').style.display='flex';
    document.getElementById('sizes-container').scrollIntoView({behavior:'smooth',block:'center'});
  }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/shop/show.blade.php ENDPATH**/ ?>