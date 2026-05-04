@extends('layouts.app')
@section('title','Order Placed — Nike Pakistan')
@section('content')
<div style="padding-top:68px;min-height:100vh;background:#fafafa;display:flex;align-items:center;justify-content:center;padding:100px 20px">
<div style="background:#fff;max-width:520px;width:100%;padding:56px 48px;text-align:center;box-shadow:0 8px 32px rgba(0,0,0,0.08)">
  <div style="font-size:72px;color:#22c55e;margin-bottom:24px"><i class="fa fa-circle-check"></i></div>
  <h1 style="font-family:var(--font-head);font-size:48px;color:#0a0a0a;margin-bottom:12px">Order Placed!</h1>
  <p style="font-size:15px;color:#666;line-height:1.6;margin-bottom:28px">Thank you for your order! A confirmation email has been sent to <strong>{{ $order->customer_email }}</strong>.</p>
  <div style="background:#fafafa;border:1px solid #e8e8e8;padding:24px;margin-bottom:28px;text-align:left">
    <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;padding:8px 0;border-bottom:1px solid #f0f0f0"><span>Order Number</span><strong style="color:#0a0a0a">{{ $order->order_number }}</strong></div>
    <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;padding:8px 0;border-bottom:1px solid #f0f0f0"><span>Customer</span><strong style="color:#0a0a0a">{{ $order->customer_name }}</strong></div>
    <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;padding:8px 0;border-bottom:1px solid #f0f0f0"><span>City</span><strong style="color:#0a0a0a">{{ $order->city }}, {{ $order->province }}</strong></div>
    <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;padding:8px 0;border-bottom:1px solid #f0f0f0"><span>Payment</span><strong style="color:#0a0a0a">{{ ucfirst($order->payment_method) }}</strong></div>
    <div style="display:flex;justify-content:space-between;font-size:14px;color:#666;padding:8px 0;border-bottom:1px solid #f0f0f0"><span>Items</span><strong style="color:#0a0a0a">{{ $order->items->count() }} item(s)</strong></div>
    <div style="display:flex;justify-content:space-between;font-family:var(--font-head);font-size:22px;padding:12px 0 0;color:#0a0a0a"><span>Total Paid</span><span style="color:var(--red)">{{ $order->formatted_total }}</span></div>
  </div>
  <a href="{{ route('home') }}" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;background:#0a0a0a;color:#fff;font-family:var(--font-head);font-size:20px;letter-spacing:2px;padding:16px;text-decoration:none;transition:background .2s">Continue Shopping <i class="fa fa-arrow-right"></i></a>
</div>
</div>
@endsection
