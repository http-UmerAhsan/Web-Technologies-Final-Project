@extends('layouts.admin')
@section('title','Order '.$order->order_number)
@section('page-title','Order Details')
@section('content')
<div style="display:grid;grid-template-columns:1fr 360px;gap:28px;align-items:start">
  <div>
    <div class="admin-card" style="margin-bottom:0">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
        <div>
          <h3 style="font-family:var(--font-head);font-size:28px">{{ $order->order_number }}</h3>
          <div style="font-size:13px;color:#888;margin-top:4px">Placed {{ $order->created_at->format('d M Y, h:i A') }}</div>
        </div>
        {!! $order->status_badge !!}
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:32px">
        <div style="background:#fafafa;padding:20px;border:1px solid #e8e8e8">
          <div style="font-family:var(--font-cond);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#aaa;margin-bottom:10px">Customer</div>
          <div style="font-weight:600;margin-bottom:4px">{{ $order->customer_name }}</div>
          <div style="font-size:14px;color:#666">{{ $order->customer_email }}</div>
          <div style="font-size:14px;color:#666">{{ $order->customer_phone }}</div>
        </div>
        <div style="background:#fafafa;padding:20px;border:1px solid #e8e8e8">
          <div style="font-family:var(--font-cond);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#aaa;margin-bottom:10px">Delivery</div>
          <div style="font-size:14px;color:#666;line-height:1.6">{{ $order->address }}<br>{{ $order->city }}, {{ $order->province }}@if($order->postal_code) {{ $order->postal_code }}@endif</div>
        </div>
      </div>
      <h4 style="font-family:var(--font-head);font-size:20px;margin-bottom:16px">Order Items</h4>
      @foreach($order->items as $item)
      <div style="display:flex;gap:16px;padding:16px 0;border-bottom:1px solid #f0f0f0">
        @if($item->product)<img src="{{ $item->product->primary_image }}" style="width:64px;height:64px;object-fit:cover;background:#f4f4f4" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=120&q=60'" alt="">@endif
        <div style="flex:1"><div style="font-weight:600;margin-bottom:2px">{{ $item->product_name }}</div><div style="font-size:13px;color:#888">Size: {{ $item->size }} | Qty: {{ $item->quantity }}</div></div>
        <div style="font-family:var(--font-head);font-size:20px">{{ $item->formatted_total_price }}</div>
      </div>
      @endforeach
      <div style="margin-top:20px;padding-top:20px;border-top:1px solid #e8e8e8">
        <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;margin-bottom:8px"><span>Subtotal</span><span>{{ $order->formatted_subtotal }}</span></div>
        <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;margin-bottom:8px"><span>Shipping</span><span>{{ $order->shipping==0?'FREE':'Rs. '.number_format($order->shipping,0) }}</span></div>
        <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;margin-bottom:12px"><span>GST (17%)</span><span>Rs. {{ number_format($order->tax,0) }}</span></div>
        <div style="display:flex;justify-content:space-between;font-family:var(--font-head);font-size:26px;border-top:2px solid #0a0a0a;padding-top:12px"><span>TOTAL</span><span>{{ $order->formatted_total }}</span></div>
      </div>
    </div>
  </div>
  <div>
    <div class="admin-card">
      <h4 style="font-family:var(--font-head);font-size:20px;margin-bottom:20px">Update Status</h4>
      <form method="POST" action="{{ route('admin.orders.status',$order) }}">
        @csrf @method('PATCH')
        <div class="form-field" style="margin-bottom:16px"><label>Status</label>
          <select name="status">
            @foreach(\App\Models\Order::STATUSES as $s)
            <option value="{{ $s }}" {{ $order->status===$s?'selected':'' }}>{{ $s }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn-admin-action" style="width:100%">Update Status</button>
      </form>
      <div style="margin-top:20px;padding-top:20px;border-top:1px solid #e8e8e8">
        <div style="font-family:var(--font-cond);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#aaa;margin-bottom:10px">Payment</div>
        <div style="font-weight:600">{{ ucfirst($order->payment_method) }}</div>
      </div>
    </div>
    <a href="{{ route('admin.orders.index') }}" style="display:flex;align-items:center;gap:8px;justify-content:center;margin-top:16px;font-family:var(--font-cond);font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#666;text-decoration:none"><i class="fa fa-arrow-left"></i> Back to Orders</a>
  </div>
</div>
@endsection
