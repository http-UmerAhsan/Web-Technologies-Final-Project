<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Order Confirmed</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f4f4;margin:0;padding:20px">
<div style="max-width:600px;margin:0 auto;background:#fff;border-radius:4px;overflow:hidden">
  <div style="background:#0a0a0a;padding:32px 40px;text-align:center">
    <div style="font-family:Georgia,serif;font-size:32px;font-weight:900;color:#fff;letter-spacing:4px">NIKE</div>
    <div style="color:rgba(255,255,255,.5);font-size:13px;margin-top:8px;letter-spacing:2px;text-transform:uppercase">Pakistan</div>
  </div>
  <div style="padding:40px">
    <h1 style="font-size:28px;color:#0a0a0a;margin:0 0 8px">Order Confirmed!</h1>
    <p style="font-size:15px;color:#666;margin:0 0 24px">Hi <?php echo e($order->customer_name); ?>, your order has been placed successfully.</p>
    <div style="background:#fafafa;border:1px solid #e8e8e8;padding:24px;margin-bottom:24px">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;font-size:14px">
        <div><span style="color:#888;display:block">Order Number</span><strong><?php echo e($order->order_number); ?></strong></div>
        <div><span style="color:#888;display:block">Status</span><strong><?php echo e($order->status); ?></strong></div>
        <div><span style="color:#888;display:block">Payment</span><strong><?php echo e(ucfirst($order->payment_method)); ?></strong></div>
        <div><span style="color:#888;display:block">Total</span><strong style="color:#e63312"><?php echo e($order->formatted_total); ?></strong></div>
      </div>
    </div>
    <p style="font-size:14px;color:#666;line-height:1.6">Your order will be delivered to <strong><?php echo e($order->city); ?>, <?php echo e($order->province); ?></strong> within 3–5 business days.</p>
    <p style="font-size:14px;color:#666;margin-top:24px">Questions? Email us at <a href="mailto:umerahsan696@gmail.com" style="color:#e63312">umerahsan696@gmail.com</a></p>
  </div>
  <div style="background:#f4f4f4;padding:20px 40px;text-align:center;font-size:12px;color:#aaa">&copy; <?php echo e(date('Y')); ?> Nike Pakistan. All rights reserved.</div>
</div>
</body></html>
<?php /**PATH D:\BS CS\BS COSC SEM 6\nike-laravel\nike-laravel\resources\views/emails/order-confirmation.blade.php ENDPATH**/ ?>