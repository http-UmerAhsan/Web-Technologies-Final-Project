<?php $__env->startSection('title','Orders'); ?>
<?php $__env->startSection('page-title','Orders'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-card">
  <table id="orders-table" class="display" style="width:100%">
    <thead><tr><th>Order ID</th><th>Customer</th><th>Email</th><th>Items</th><th>Subtotal</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
  </table>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
$('#orders-table').DataTable({
  processing:true,serverSide:true,
  ajax:'<?php echo e(route("admin.dt.orders")); ?>',
  columns:[{data:'order_number'},{data:'customer_name'},{data:'customer_email'},{data:'items_count'},{data:'formatted_subtotal'},{data:'formatted_total'},{data:'status_badge',orderable:false},{data:'date'},{data:'actions',orderable:false}],
  pageLength:15,order:[[7,'desc']]
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>