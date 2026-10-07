@extends('layouts.app')

@section('title', 'About Us - GAK Construction')

@section('content')

    {{-- Page Banner --}}
    <section class="page-banner" style="background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1920');">
        <div class="page-banner-overlay"></div>
        <div class="page-banner-content" data-aos="fade-up">
            <h1>About Us</h1>
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>About Us</span>
            </nav>
        </div>
    </section>

    {{-- About Content --}}
    <section class="section">
        <div class="container">
            <div class="about-preview-grid">
                <div class="about-preview-images" data-aos="fade-right">
                    <div class="about-img-main">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600" alt="GAK Construction">
                    </div>
                    <div class="about-img-secondary">
                        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=400" alt="Our Team">
                    </div>
                    <div class="about-experience-badge">
                        <span class="exp-number">15+</span>
                        <span class="exp-text">Years Experience</span>
                    </div>
                </div>

                <div class="about-preview-content" data-aos="fade-left">
                    <span class="section-subtitle"><i class="fas fa-hard-hat"></i> Our Story</span>
                    <h2 class="section-title">Building <span class="text-red">Excellence</span> Since 2009</h2>
                    <p class="section-description">
                        GAK Construction was founded in 2009 with a vision to deliver top-quality construction
                        services. What started as a small team has grown into one of the most trusted construction
                        companies in Sri Lanka.
                    </p>
                    <p class="section-description">
                        Our founder, G.A. Kamal, brought together a team of skilled professionals who share
                        a passion for building structures that stand the test of time. Every project we
                        undertake is a testament to our commitment to quality, safety, and customer satisfaction.
                    </p>

                    <div class="about-features">
                        <div class="about-feature">
                            <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                            <div>
                                <h4>Our Mission</h4>
                                <p>To deliver exceptional construction services that exceed client expectations while maintaining the highest standards of safety and quality.</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                            <div>
                                <h4>Our Vision</h4>
                                <p>To be the most trusted and innovative construction company, building a better future for communities and generations to come.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    <section class="section team-section" style="background: #f8f9fa;">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-subtitle"><i class="fas fa-users"></i> Our Team</span>
                <h2 class="section-title">Meet Our <span class="text-red">Experts</span></h2>
            </div>

            <div class="team-grid">
                @foreach($teamMembers as $index => $member)
                    <div class="team-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="team-image">
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" loading="lazy">
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3>{{ $member['name'] }}</h3>
                            <p>{{ $member['position'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection