@extends('layouts.app')

@section('title', 'Our Services - GAK Construction')

@section('content')

    {{-- Page Banner --}}
    <section class="page-banner" style="background-image: url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1920');">
        <div class="page-banner-overlay"></div>
        <div class="page-banner-content" data-aos="fade-up">
            <h1>Our Services</h1>
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Services</span>
            </nav>
        </div>
    </section>

    {{-- Services --}}
    <section class="section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-subtitle"><i class="fas fa-cogs"></i> What We Do</span>
                <h2 class="section-title">Professional <span class="text-red">Construction</span> Services</h2>
                <p class="section-description">Comprehensive construction solutions tailored to your needs</p>
            </div>

            <div class="services-detail-grid">
                @foreach($services as $index => $service)
                    <div class="service-detail-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="service-detail-icon">
                            <span>{{ $service['icon'] }}</span>
                        </div>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                        <ul class="service-features-list">
                            @foreach($service['features'] as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">
                            Get Quote <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-section">
        <div class="cta-overlay"></div>
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2 class="cta-title">Need a Custom Solution?</h2>
                <p class="cta-description">Contact us to discuss your specific construction requirements.</p>
                <a href="{{ route('contact') }}" class="btn btn-white btn-lg">
                    <i class="fas fa-envelope"></i> Get in Touch
                </a>
            </div>
        </div>
    </section>

@endsection