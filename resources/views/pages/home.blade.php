@extends('layouts.app')

@section('title', 'GAK Construction - Building Your Dreams With Quality & Trust')

@section('content')

    {{-- Hero Section --}}
    @include('partials.hero')

    {{-- ==================== ABOUT PREVIEW SECTION ==================== --}}
    <section class="section about-preview-section">
        <div class="container">
            <div class="about-preview-grid">
                <div class="about-preview-images" data-aos="fade-right">
                    <div class="about-img-main">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600" alt="GAK Construction Work">
                    </div>
                    <div class="about-img-secondary">
                        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=400" alt="Construction Site">
                    </div>
                    <div class="about-experience-badge">
                        <span class="exp-number">15+</span>
                        <span class="exp-text">Years of Experience</span>
                    </div>
                </div>

                <div class="about-preview-content" data-aos="fade-left">
                    <span class="section-subtitle">
                        <i class="fas fa-hard-hat"></i> About GAK Construction
                    </span>
                    <h2 class="section-title">We Build <span class="text-red">Quality</span> Structures That Last</h2>
                    <p class="section-description">
                        GAK Construction has been a trusted name in the construction industry for over 15 years.
                        We are committed to delivering exceptional quality in every project, whether it's a small
                        home renovation or a large commercial complex.
                    </p>

                    <div class="about-features">
                        <div class="about-feature">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h4>Licensed & Insured</h4>
                                <p>Fully licensed construction company with comprehensive insurance coverage.</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h4>Expert Team</h4>
                                <p>Skilled engineers, architects, and craftsmen with years of experience.</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h4>On-Time Delivery</h4>
                                <p>We respect deadlines and ensure timely completion of every project.</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Learn More About Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== SERVICES SECTION ==================== --}}
    <section class="section services-section" id="services">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-subtitle">
                    <i class="fas fa-cogs"></i> What We Offer
                </span>
                <h2 class="section-title">Our <span class="text-red">Services</span></h2>
                <p class="section-description">
                    We provide comprehensive construction services to meet all your building needs
                </p>
            </div>

            <div class="services-grid">
                @foreach($services as $index => $service)
                    <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="service-icon">
                            <span>{{ $service['icon'] }}</span>
                        </div>
                        <h3 class="service-title">{{ $service['title'] }}</h3>
                        <p class="service-description">{{ $service['description'] }}</p>
                        <a href="{{ route('services') }}" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="section-cta" data-aos="fade-up">
                <a href="{{ route('services') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-tools"></i> View All Services
                </a>
            </div>
        </div>
    </section>

    {{-- ==================== STATS SECTION ==================== --}}
    <section class="stats-section">
        <div class="stats-overlay"></div>
        <div class="container">
            <div class="stats-grid">
                @foreach($stats as $index => $stat)
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                        <div class="stat-icon">
                            @if($index == 0)
                                <i class="fas fa-project-diagram"></i>
                            @elseif($index == 1)
                                <i class="fas fa-calendar-alt"></i>
                            @elseif($index == 2)
                                <i class="fas fa-smile"></i>
                            @else
                                <i class="fas fa-users"></i>
                            @endif
                        </div>
                        <span class="stat-number" data-target="{{ $stat['number'] }}">0</span>
                        <span class="stat-label">{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== PROJECTS SECTION ==================== --}}
    <section class="section projects-section" id="projects">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-subtitle">
                    <i class="fas fa-building"></i> Our Portfolio
                </span>
                <h2 class="section-title">Recent <span class="text-red">Projects</span></h2>
                <p class="section-description">
                    Explore our latest completed projects and see the quality we deliver
                </p>
            </div>

            <div class="projects-grid">
                @foreach($projects as $index => $project)
                    <div class="project-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="project-image">
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" loading="lazy">
                            <div class="project-overlay">
                                <span class="project-category">{{ $project['category'] }}</span>
                                <h3 class="project-title">{{ $project['title'] }}</h3>
                                <p class="project-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $project['location'] }}
                                </p>
                                <a href="{{ route('projects') }}" class="project-link">
                                    View Details <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="section-cta" data-aos="fade-up">
                <a href="{{ route('projects') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-th-large"></i> View All Projects
                </a>
            </div>
        </div>
    </section>

    {{-- ==================== WHY CHOOSE US SECTION ==================== --}}
    <section class="section why-choose-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-subtitle">
                    <i class="fas fa-star"></i> Why GAK Construction
                </span>
                <h2 class="section-title">Why <span class="text-red">Choose</span> Us</h2>
            </div>

            <div class="why-grid">
                <div class="why-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="why-icon"><i class="fas fa-medal"></i></div>
                    <h3>Quality Assurance</h3>
                    <p>We use only the finest materials and follow strict quality control processes in every project.</p>
                </div>
                <div class="why-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-icon"><i class="fas fa-clock"></i></div>
                    <h3>On-Time Delivery</h3>
                    <p>We respect your time and ensure every project is completed within the agreed timeline.</p>
                </div>
                <div class="why-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="why-icon"><i class="fas fa-hand-holding-usd"></i></div>
                    <h3>Fair Pricing</h3>
                    <p>Competitive and transparent pricing with no hidden costs. Value for every rupee spent.</p>
                </div>
                <div class="why-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="why-icon"><i class="fas fa-headset"></i></div>
                    <h3>24/7 Support</h3>
                    <p>Our dedicated support team is always available to address your concerns and queries.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== TESTIMONIALS SECTION ==================== --}}
    <section class="section testimonials-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-subtitle">
                    <i class="fas fa-quote-left"></i> Client Feedback
                </span>
                <h2 class="section-title">What Our <span class="text-red">Clients</span> Say</h2>
            </div>

            <div class="testimonials-grid">
                @foreach($testimonials as $index => $testimonial)
                    <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                        <div class="testimonial-stars">
                            @for($i = 0; $i < $testimonial['rating']; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for($i = $testimonial['rating']; $i < 5; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
                        <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="author-name">{{ $testimonial['name'] }}</h4>
                                <span class="author-position">{{ $testimonial['position'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CTA SECTION ==================== --}}
    <section class="cta-section">
        <div class="cta-overlay"></div>
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2 class="cta-title">Ready to Start Your Project?</h2>
                <p class="cta-description">
                    Contact us today for a free consultation and quote. Let's build something amazing together!
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('contact') }}" class="btn btn-white btn-lg">
                        <i class="fas fa-envelope"></i> Contact Us
                    </a>
                    <a href="tel:+94771234567" class="btn btn-outline-white btn-lg">
                        <i class="fas fa-phone-alt"></i> +94 77 123 4567
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection