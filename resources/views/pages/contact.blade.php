@extends('layouts.app')
@section('title', 'Contact - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>Contact Us</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h4 class="text-red">Get In Touch</h4>
                <h2>Let's Build Together</h2>
                <p>Have a construction project in mind? Reach out to us!</p>

                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div><h4>Address</h4><p>123 Construction Lane, Colombo</p></div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div><h4>Phone</h4><p>+94 77 123 4567</p></div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div><h4>Email</h4><p>info@gakconstruction.com</p></div>
                </div>
            </div>

            <div class="contact-form-box">
                <h3>Send Us a Message</h3>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Mobile *</label>
                        <input type="tel" name="mobile" value="{{ old('mobile') }}" required placeholder="+94 77 123 4567">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-comment"></i> Your Requirements *</label>
                        <textarea name="requirements" rows="5" required placeholder="Tell us about your project...">{{ old('requirements') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection