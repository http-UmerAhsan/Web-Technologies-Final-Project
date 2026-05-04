<?php $__env->startSection('title','Products'); ?>
<?php $__env->startSection('page-title','Products'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-tab-toolbar">
  <h3>All Products</h3>
  <a href="<?php echo e(route('admin.products.create')); ?>" class="btn-admin-action"><i class="fa fa-plus"></i> Add Product</a>
</div>
<div class="admin-card">
  <table id="products-table" class="display" style="width:100%">
    <thead><tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
  </table>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
$('#products-table').DataTable({
  processing:true,serverSide:true,
  ajax:'<?php echo e(route("admin.dt.products")); ?>',
  columns:[{data:'id'},{data:'image_html',orderable:false},{data:'name'},{data:'category'},{data:'formatted_price'},{data:'stock_html'},{data:'status_badge',orderable:false},{data:'actions',orderable:false}],
  pageLength:10
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/admin/products/index.blade.php ENDPATH**/ ?>