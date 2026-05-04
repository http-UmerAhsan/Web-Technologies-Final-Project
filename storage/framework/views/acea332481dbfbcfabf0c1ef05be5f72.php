<?php $__env->startSection('title','Order Items'); ?>
<?php $__env->startSection('page-title','Order Items'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-card">
  <table id="order-items-table" class="display" style="width:100%">
    <thead><tr><th>Item ID</th><th>Order ID</th><th>Product</th><th>Size</th><th>Color</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>
  </table>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
$('#order-items-table').DataTable({
  processing:true,serverSide:true,
  ajax:'<?php echo e(route("admin.dt.order-items")); ?>',
  columns:[{data:'id'},{data:'order_number'},{data:'product_name'},{data:'size'},{data:'color'},{data:'quantity'},{data:'formatted_unit_price'},{data:'formatted_total_price'}],
  pageLength:15
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/admin/orders/items.blade.php ENDPATH**/ ?>