@extends('layouts.admin')
@section('title','Customer: '.$user->name)
@section('page-title','Customer Profile')
@section('content')
<div class="admin-card" style="max-width:600px">
  <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:6px;font-family:var(--font-cond);font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#666;margin-bottom:24px;text-decoration:none"><i class="fa fa-arrow-left"></i> Back to Customers</a>
  <div style="display:flex;align-items:center;gap:20px;margin-bottom:32px;padding-bottom:24px;border-bottom:1px solid #e8e8e8">
    <div style="width:64px;height:64px;background:var(--red);border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-head);font-size:28px;color:#fff;flex-shrink:0">{{ substr($user->name,0,1) }}</div>
    <div><h3 style="font-family:var(--font-head);font-size:28px">{{ $user->name }}</h3><div style="font-size:14px;color:#888">{{ $user->email }}</div></div>
  </div>
  @foreach(['Phone'=>$user->phone,'City'=>$user->city,'Province'=>$user->province,'Total Orders'=>$user->total_orders,'Total Spent'=>$user->formatted_total_spent,'Member Since'=>$user->created_at->format('d M Y')] as $label=>$val)
  <div style="display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid #f0f0f0;font-size:14px"><span style="color:#888">{{ $label }}</span><strong>{{ $val ?? '—' }}</strong></div>
  @endforeach
</div>
@endsection
