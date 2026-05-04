@extends('layouts.app')
@section('title','Contact Us — Nike Pakistan')
@section('content')
<div style="padding-top:68px">
<div class="contact-page">
  <div class="contact-hero-section">
    <div class="contact-hero-text">
      <div class="section-eyebrow" style="color:var(--red);margin-bottom:16px">Support &middot; Pakistan</div>
      <h1 class="contact-hero-title">LET'S<br>TALK.</h1>
      <p class="contact-hero-sub">Got a question, feedback, or just want to say hi? We're here for it.</p>
    </div>
    <div class="contact-hero-img">
      <img src="https://images.unsplash.com/photo-1511556532299-8f662fc26c06?w=700&q=80&auto=format&fit=crop" alt="Contact Nike">
    </div>
  </div>
  <div class="contact-body">
    <div class="contact-info-panel">
      <div class="contact-card">
        <div class="contact-card-icon"><i class="fa fa-envelope"></i></div>
        <div class="contact-card-body">
          <div class="contact-card-title">Email</div>
          <a href="mailto:umerahsan696@gmail.com" class="contact-card-val">umerahsan696@gmail.com</a>
          <div class="contact-card-note">Response within 24 hours</div>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-card-icon"><i class="fab fa-github"></i></div>
        <div class="contact-card-body">
          <div class="contact-card-title">GitHub</div>
          <a href="https://github.com/http-UmerAhsan" target="_blank" class="contact-card-val">github.com/http-UmerAhsan</a>
          <div class="contact-card-note">View source code &amp; projects</div>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-card-icon"><i class="fa fa-clock"></i></div>
        <div class="contact-card-body">
          <div class="contact-card-title">Support Hours</div>
          <div class="contact-card-val" style="color:var(--black)">Mon – Sat, 10am – 7pm</div>
          <div class="contact-card-note">Pakistan Standard Time (PKT)</div>
        </div>
      </div>
      <div class="contact-social-row">
        <div class="contact-social-label">Follow us</div>
        <div class="contact-socials">
          <a href="#" class="social-ic dark"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-ic dark"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-ic dark"><i class="fab fa-facebook"></i></a>
          <a href="https://github.com/http-UmerAhsan" target="_blank" class="social-ic dark"><i class="fab fa-github"></i></a>
        </div>
      </div>
    </div>
    <div class="contact-form-panel">
      <h2 class="contact-form-title">Send a Message</h2>
      <p class="contact-form-sub">Fill out the form and we'll get back to you shortly.</p>
      @if(session('success'))
      <div style="background:#d4edda;border:1px solid #b8ddb8;padding:16px;margin-bottom:24px;font-size:14px;color:#1a5a1a;display:flex;align-items:center;gap:10px"><i class="fa fa-circle-check"></i> {{ session('success') }}</div>
      @endif
      <form method="POST" action="{{ route('contact.send') }}" novalidate>
        @csrf
        <div class="form-grid-2">
          <div class="form-field"><label>First Name <span class="req">*</span></label><input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Ahmad" class="{{ $errors->has('first_name')?'is-error':'' }}"><div class="field-error">{{ $errors->first('first_name') }}</div></div>
          <div class="form-field"><label>Last Name <span class="req">*</span></label><input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Khan" class="{{ $errors->has('last_name')?'is-error':'' }}"><div class="field-error">{{ $errors->first('last_name') }}</div></div>
        </div>
        <div class="form-field"><label>Email <span class="req">*</span></label><input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" class="{{ $errors->has('email')?'is-error':'' }}"><div class="field-error">{{ $errors->first('email') }}</div></div>
        <div class="form-field"><label>Subject</label>
          <select name="subject">
            @foreach(['Order Inquiry','Product Question','Returns & Exchanges','Technical Support','Partnership','Other'] as $s)
            <option value="{{ $s }}" {{ old('subject')==$s?'selected':'' }}>{{ $s }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-field"><label>Message <span class="req">*</span></label><textarea name="message" placeholder="Tell us how we can help..." class="{{ $errors->has('message')?'is-error':'' }}">{{ old('message') }}</textarea><div class="field-error">{{ $errors->first('message') }}</div></div>
        <button type="submit" class="btn-send-message">Send Message <i class="fa fa-paper-plane"></i></button>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
