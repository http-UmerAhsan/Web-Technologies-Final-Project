@extends('layouts.app')
@section('title','Checkout — Nike Pakistan')
@section('content')
<div class="checkout-page">
<div class="checkout-container">
  <div class="checkout-left">
    <a href="{{ route('cart.index') }}" class="back-link"><i class="fa fa-arrow-left"></i> Back to Bag</a>
    <div class="checkout-logo-mini">
      <svg viewBox="0 0 48 18" width="40"><path d="M48 0L6.826 13.684 0 13.706 43.4 0z" fill="black"/></svg>
      <span>CHECKOUT</span>
    </div>
    @if($errors->any())
    <div style="background:#fef2f2;border:1px solid #fca5a5;border-left:4px solid #e63312;padding:16px;margin-bottom:24px;font-size:14px;color:#b91c1c">
      <i class="fa fa-triangle-exclamation"></i> <strong>Please fix the following errors:</strong>
      <ul style="margin-top:8px;margin-left:16px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif
    <form method="POST" action="{{ route('orders.store') }}" novalidate>
      @csrf
      <div class="checkout-section">
        <h3 class="checkout-section-title"><span class="step-num">1</span> Contact Information</h3>
        <div class="form-grid-2">
          <div class="form-field"><label>First Name <span class="req">*</span></label><input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Muhammad" class="{{ $errors->has('first_name')?'is-error':'' }}"><div class="field-error">{{ $errors->first('first_name') }}</div></div>
          <div class="form-field"><label>Last Name <span class="req">*</span></label><input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Ali" class="{{ $errors->has('last_name')?'is-error':'' }}"><div class="field-error">{{ $errors->first('last_name') }}</div></div>
        </div>
        <div class="form-field"><label>Email <span class="req">*</span></label><input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" class="{{ $errors->has('email')?'is-error':'' }}"><div class="field-error">{{ $errors->first('email') }}</div></div>
        <div class="form-field"><label>Phone <span class="req">*</span></label>
          <div class="input-wrap"><span class="input-prefix">+92</span><input type="tel" name="phone" value="{{ old('phone') }}" placeholder="300 1234567" class="{{ $errors->has('phone')?'is-error':'' }}"></div>
          <div class="field-error">{{ $errors->first('phone') }}</div></div>
      </div>
      <div class="checkout-section">
        <h3 class="checkout-section-title"><span class="step-num">2</span> Shipping Address</h3>
        <div class="form-field"><label>Full Address <span class="req">*</span></label><input type="text" name="address" value="{{ old('address') }}" placeholder="House #, Street, Area" class="{{ $errors->has('address')?'is-error':'' }}"><div class="field-error">{{ $errors->first('address') }}</div></div>
        <div class="form-grid-2">
          <div class="form-field"><label>City <span class="req">*</span></label><input type="text" name="city" value="{{ old('city') }}" placeholder="Karachi" class="{{ $errors->has('city')?'is-error':'' }}"><div class="field-error">{{ $errors->first('city') }}</div></div>
          <div class="form-field"><label>Postal Code</label><input type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="75500" maxlength="5"></div>
        </div>
        <div class="form-field"><label>Province <span class="req">*</span></label>
          <select name="province" class="{{ $errors->has('province')?'is-error':'' }}">
            <option value="">— Select Province —</option>
            @foreach(['Sindh','Punjab','Khyber Pakhtunkhwa','Balochistan','Islamabad (ICT)','Gilgit-Baltistan','Azad Kashmir'] as $p)
            <option value="{{ $p }}" {{ old('province')==$p?'selected':'' }}>{{ $p }}</option>
            @endforeach
          </select>
          <div class="field-error">{{ $errors->first('province') }}</div></div>
      </div>
      <div class="checkout-section">
        <h3 class="checkout-section-title"><span class="step-num">3</span> Payment Method</h3>
        <div class="payment-tabs">
          <button type="button" class="pay-tab {{ old('payment_method','card')==='card'?'active':'' }}" onclick="setPayment(this,'card')"><i class="fa fa-credit-card"></i> Card</button>
          <button type="button" class="pay-tab {{ old('payment_method')==='easypaisa'?'active':'' }}" onclick="setPayment(this,'easypaisa')"><i class="fa fa-mobile-screen"></i> Easypaisa</button>
          <button type="button" class="pay-tab {{ old('payment_method')==='cod'?'active':'' }}" onclick="setPayment(this,'cod')"><i class="fa fa-money-bill"></i> Cash on Delivery</button>
        </div>
        <input type="hidden" name="payment_method" id="payment_method" value="{{ old('payment_method','card') }}">
        <div id="card-fields" style="{{ old('payment_method','card')!=='card'?'display:none':'' }}">
          <div class="form-field"><label>Card Number <span class="req">*</span></label><input type="text" name="card_number" value="{{ old('card_number') }}" placeholder="1234 5678 9012 3456" maxlength="19" oninput="formatCard(this)" class="{{ $errors->has('card_number')?'is-error':'' }}"><div class="field-error">{{ $errors->first('card_number') }}</div></div>
          <div class="form-grid-2">
            <div class="form-field"><label>Expiry <span class="req">*</span></label><input type="text" name="card_expiry" value="{{ old('card_expiry') }}" placeholder="MM/YY" maxlength="5" oninput="formatExpiry(this)" class="{{ $errors->has('card_expiry')?'is-error':'' }}"><div class="field-error">{{ $errors->first('card_expiry') }}</div></div>
            <div class="form-field"><label>CVV <span class="req">*</span></label><input type="password" name="card_cvv" placeholder="•••" maxlength="4" class="{{ $errors->has('card_cvv')?'is-error':'' }}"><div class="field-error">{{ $errors->first('card_cvv') }}</div></div>
          </div>
          <div class="form-field"><label>Cardholder Name <span class="req">*</span></label><input type="text" name="card_holder" value="{{ old('card_holder') }}" placeholder="Muhammad Ali" class="{{ $errors->has('card_holder')?'is-error':'' }}"><div class="field-error">{{ $errors->first('card_holder') }}</div></div>
        </div>
        <div id="easypaisa-fields" style="{{ old('payment_method')!=='easypaisa'?'display:none':'' }}">
          <div class="form-field"><label>Easypaisa Number <span class="req">*</span></label>
            <div class="input-wrap"><span class="input-prefix">+92</span><input type="tel" name="easypaisa_number" value="{{ old('easypaisa_number') }}" placeholder="300 1234567" class="{{ $errors->has('easypaisa_number')?'is-error':'' }}"></div>
            <div class="field-error">{{ $errors->first('easypaisa_number') }}</div></div>
        </div>
        <div id="cod-fields" style="{{ old('payment_method')!=='cod'?'display:none':'' }}">
          <div class="cod-info"><i class="fa fa-circle-info"></i> Pay cash when your order arrives. Available across Pakistan.</div>
        </div>
      </div>
      <button type="submit" class="btn-place-order"><i class="fa fa-lock"></i> Place Order</button>
    </form>
  </div>
  <div class="checkout-right">
    <div class="order-summary-box">
      <h3 class="os-title">Order Summary</h3>
      @foreach($cart as $item)
      <div class="os-item">
        <div class="os-item-img"><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=60'"></div>
        <div style="flex:1;min-width:0"><div class="os-item-name">{{ $item['name'] }}</div><div class="os-item-meta">Size: {{ $item['size'] }} | Qty: {{ $item['qty'] }}</div></div>
        <div class="os-item-price">Rs. {{ number_format($item['price']*$item['qty'],0) }}</div>
      </div>
      @endforeach
      <div class="os-totals">
        <div class="os-line"><span>Subtotal</span><span>Rs. {{ number_format($subtotal,0) }}</span></div>
        <div class="os-line"><span>Shipping</span><span>{{ $shipping==0?'FREE':'Rs. '.$shipping }}</span></div>
        <div class="os-line"><span>GST (17%)</span><span>Rs. {{ number_format($tax,0) }}</span></div>
        <div class="os-line os-total-line"><span>TOTAL</span><span>Rs. {{ number_format($total,0) }}</span></div>
      </div>
      <div class="secure-note"><i class="fa fa-shield-halved"></i> 256-bit SSL Encrypted &middot; Safe Checkout</div>
    </div>
  </div>
</div>
</div>
@push('scripts')
<script>
function setPayment(btn,type){
  document.querySelectorAll('.pay-tab').forEach(t=>t.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('payment_method').value=type;
  document.getElementById('card-fields').style.display=type==='card'?'block':'none';
  document.getElementById('easypaisa-fields').style.display=type==='easypaisa'?'block':'none';
  document.getElementById('cod-fields').style.display=type==='cod'?'block':'none';
}
function formatCard(i){let v=i.value.replace(/\D/g,'').substring(0,16);v=v.replace(/(.{4})/g,'$1 ').trim();i.value=v;}
function formatExpiry(i){let v=i.value.replace(/\D/g,'').substring(0,4);if(v.length>=2)v=v.substring(0,2)+'/'+v.substring(2);i.value=v;}
</script>
@endpush
@endsection
