@extends('layouts.app')

@section('title', 'Contact Us - GAK Construction')

@section('content')

    {{-- Page Banner --}}
    <section class="page-banner" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1920');">
        <div class="page-banner-overlay"></div>
        <div class="page-banner-content" data-aos="fade-up">
            <h1>Contact Us</h1>
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Contact</span>
            </nav>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="section">
        <div class="container">
            <div class="contact-grid">
                {{-- Contact Info --}}
                <div class="contact-info" data-aos="fade-right">
                    <span class="section-subtitle"><i class="fas fa-headset"></i> Get In Touch</span>
                    <h2 class="section-title">Let's <span class="text-red">Talk</span></h2>
                    <p class="section-description">
                        Have a project in mind? We'd love to hear from you. Send us a message
                        and we'll get back to you as soon as possible.
                    </p>

                    <div class="contact-details">
                        <div class="contact-detail-item">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4>Our Office</h4>
                                <p>123 Construction Lane, Colombo 05, Sri Lanka</p>
                            </div>
                        </div>
                        <div class="contact-detail-item">
                            <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <h4>Call Us</h4>
                                <p><a href="tel:+94771234567">+94 77 123 4567</a></p>
                                <p><a href="tel:+94112345678">+94 11 234 5678</a></p>
                            </div>
                        </div>
                        <div class="contact-detail-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h4>Email Us</h4>
                                <p><a href="mailto:info@gakconstruction.com">info@gakconstruction.com</a></p>
                            </div>
                        </div>
                        <div class="contact-detail-item">
                            <div class="contact-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <h4>Working Hours</h4>
                                <p>Mon - Sat: 8:00 AM - 6:00 PM</p>
                                <p>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="contact-form-wrapper" data-aos="fade-left">
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <h3 class="form-title">Send Us a Message</h3>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your Full Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+94 77 XXX XXXX" required>
                            </div>
                            <div class="form-group">
                                <label for="subject"><i class="fas fa-tag"></i> Subject</label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Project Inquiry" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message"><i class="fas fa-comment-dots"></i> Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Tell us about your project..." required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Google Map --}}
    <section class="map-section">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253682.63289808798!2d79.68383362656246!3d6.922064500000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1700000000000"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </section>

@endsection