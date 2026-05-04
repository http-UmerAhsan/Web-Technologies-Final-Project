<?php $__env->startSection('title','Customers'); ?>
<?php $__env->startSection('page-title','Customers'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-card">
  <table id="users-table" class="display" style="width:100%">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>City</th><th>Province</th><th>Orders</th><th>Total Spent</th><th>Joined</th><th>Actions</th></tr></thead>
  </table>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
$('#users-table').DataTable({
  processing:true,serverSide:true,
  ajax:'<?php echo e(route("admin.dt.users")); ?>',
  columns:[{data:'id'},{data:'name'},{data:'email'},{data:'city'},{data:'province'},{data:'total_orders'},{data:'formatted_spent'},{data:'date'},{data:'actions',orderable:false}],
  pageLength:15
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/admin/users/index.blade.php ENDPATH**/ ?>