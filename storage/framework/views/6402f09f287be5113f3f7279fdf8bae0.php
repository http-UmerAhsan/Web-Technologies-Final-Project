<?php $__env->startSection('title','All Shoes — Nike Pakistan'); ?>
<?php $__env->startSection('content'); ?>
<div class="products-page-wrap" style="padding-top:68px">
  <div class="products-hero">
    <div class="products-hero-text">
      <div class="section-eyebrow" style="color:var(--red)">All Styles &middot; Pakistan</div>
      <h1>SHOES</h1>
    </div>
    <div class="products-hero-meta"><?php echo e($products->count()); ?> Results</div>
  </div>
  <div class="products-layout">
    <aside class="filters-sidebar">
      <form method="GET" action="<?php echo e(route('products')); ?>">
        <div class="filter-block">
          <div class="filter-title">Category</div>
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <label class="filter-check">
            <input type="checkbox" name="category[]" value="<?php echo e($cat); ?>" <?php echo e(request('category')==$cat?'checked':''); ?>> <span><?php echo e($cat); ?></span>
          </label>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="filter-block">
          <div class="filter-title">Price (PKR)</div>
          <div class="price-range-wrap">
            <input type="number" name="min_price" class="price-input" placeholder="Min" value="<?php echo e(request('min_price')); ?>">
            <span>—</span>
            <input type="number" name="max_price" class="price-input" placeholder="Max" value="<?php echo e(request('max_price')); ?>">
          </div>
        </div>
        <button type="submit" class="btn-apply-filters">Apply Filters</button>
        <a href="<?php echo e(route('products')); ?>" class="btn-clear-filters" style="display:block;text-align:center;margin-top:8px;padding:12px;border:1px solid #e5e5e5;font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#666;text-decoration:none">Clear All</a>
      </form>
    </aside>
    <div class="products-main">
      <div class="products-toolbar">
        <div></div>
        <form method="GET" action="<?php echo e(route('products')); ?>">
          <?php if(request('category')): ?><input type="hidden" name="category" value="<?php echo e(request('category')); ?>"><?php endif; ?>
          <select name="sort" class="sort-dropdown" onchange="this.form.submit()">
            <option value="featured" <?php echo e(request('sort')=='featured'?'selected':''); ?>>Sort: Featured</option>
            <option value="price-low" <?php echo e(request('sort')=='price-low'?'selected':''); ?>>Price: Low to High</option>
            <option value="price-high" <?php echo e(request('sort')=='price-high'?'selected':''); ?>>Price: High to Low</option>
            <option value="newest" <?php echo e(request('sort')=='newest'?'selected':''); ?>>Newest First</option>
          </select>
        </form>
      </div>
      <?php if($products->isEmpty()): ?>
      <div style="text-align:center;padding:80px 0;color:#aaa">
        <i class="fa fa-box-open" style="font-size:48px;margin-bottom:16px;display:block"></i>
        <p style="font-family:var(--font-head);font-size:28px">No products found</p>
        <a href="<?php echo e(route('products')); ?>" style="color:var(--red)">Clear filters</a>
      </div>
      <?php else: ?>
      <div class="products-grid">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            <a href="<?php echo e(route('products.show',$product)); ?>" class="btn-pc-add" style="display:block;text-align:center;text-decoration:none">View & Add to Bag</a>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/shop/products.blade.php ENDPATH**/ ?>