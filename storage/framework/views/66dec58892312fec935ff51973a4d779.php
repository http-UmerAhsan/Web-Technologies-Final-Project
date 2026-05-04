<?php $__env->startSection('title','Your Bag — Nike Pakistan'); ?>
<?php $__env->startSection('content'); ?>
<div style="padding-top:68px;min-height:100vh;background:#fafafa">
<div style="max-width:1100px;margin:0 auto;padding:56px 40px">
  <h1 style="font-family:var(--font-head);font-size:56px;margin-bottom:40px">YOUR BAG</h1>
  <?php if(empty($cart)): ?>
  <div style="text-align:center;padding:80px 0">
    <i class="fa fa-bag-shopping" style="font-size:64px;color:#ddd;margin-bottom:24px;display:block"></i>
    <p style="font-family:var(--font-head);font-size:32px;margin-bottom:16px">Your bag is empty</p>
    <a href="<?php echo e(route('products')); ?>" class="btn-hero-primary" style="display:inline-flex">Shop Now <i class="fa fa-arrow-right"></i></a>
  </div>
  <?php else: ?>
  <div style="display:grid;grid-template-columns:1fr 380px;gap:48px;align-items:start">
    <div>
      <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div style="display:flex;gap:20px;padding:24px 0;border-bottom:1px solid #e8e8e8;align-items:flex-start">
        <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>" style="width:120px;height:120px;object-fit:cover;background:#f4f4f4" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=60'">
        <div style="flex:1">
          <div style="font-family:var(--font-head);font-size:22px;margin-bottom:4px"><?php echo e($item['name']); ?></div>
          <div style="font-size:13px;color:#888;margin-bottom:12px">Size: <?php echo e($item['size']); ?></div>
          <div style="display:flex;align-items:center;gap:12px">
            <button onclick="updateQty('<?php echo e($key); ?>',<?php echo e($item['qty']-1); ?>)" style="width:32px;height:32px;border:1px solid #ddd;background:#fff;font-size:18px;cursor:pointer">−</button>
            <span style="font-family:var(--font-head);font-size:20px"><?php echo e($item['qty']); ?></span>
            <button onclick="updateQty('<?php echo e($key); ?>',<?php echo e($item['qty']+1); ?>)" style="width:32px;height:32px;border:1px solid #ddd;background:#fff;font-size:18px;cursor:pointer">+</button>
          </div>
        </div>
        <div style="text-align:right">
          <div style="font-family:var(--font-head);font-size:24px;margin-bottom:8px">Rs. <?php echo e(number_format($item['price']*$item['qty'],0)); ?></div>
          <button onclick="removeItem('<?php echo e($key); ?>')" style="background:none;border:none;color:#aaa;font-size:13px;cursor:pointer;font-family:var(--font-cond);font-weight:600;letter-spacing:1px;text-transform:uppercase">Remove</button>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div style="background:#fff;border:1px solid #e8e8e8;padding:32px;position:sticky;top:88px">
      <h3 style="font-family:var(--font-head);font-size:26px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid #e8e8e8">ORDER SUMMARY</h3>
      <?php $tax=$total*0.17; $shipping=$total>=15000?0:350; ?>
      <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;margin-bottom:10px"><span>Subtotal</span><span>Rs. <?php echo e(number_format($total,0)); ?></span></div>
      <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;margin-bottom:10px"><span>Shipping</span><span><?php echo e($shipping==0?'FREE':'Rs. '.$shipping); ?></span></div>
      <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;margin-bottom:16px"><span>GST (17%)</span><span>Rs. <?php echo e(number_format($tax,0)); ?></span></div>
      <div style="display:flex;justify-content:space-between;font-family:var(--font-head);font-size:28px;padding-top:16px;border-top:2px solid #0a0a0a;margin-bottom:24px"><span>TOTAL</span><span>Rs. <?php echo e(number_format($total+$tax+$shipping,0)); ?></span></div>
      <a href="<?php echo e(route('checkout')); ?>" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;background:var(--red);color:#fff;font-family:var(--font-head);font-size:22px;letter-spacing:2px;padding:18px;text-decoration:none;transition:background .2s">Checkout <i class="fa fa-arrow-right"></i></a>
      <a href="<?php echo e(route('products')); ?>" style="display:block;text-align:center;margin-top:12px;font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#666;text-decoration:none">Continue Shopping</a>
    </div>
  </div>
  <?php endif; ?>
</div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
function updateQty(key,qty){
  if(qty<1){removeItem(key);return;}
  fetch('/cart/update/'+key,{method:'PATCH',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({qty:qty})}).then(()=>location.reload());
}
function removeItem(key){
  fetch('/cart/remove/'+key,{method:'DELETE',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content}}).then(()=>location.reload());
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/shop/cart.blade.php ENDPATH**/ ?>