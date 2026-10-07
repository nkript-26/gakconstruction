{{-- ==================== HERO SECTION ==================== --}}
<section class="hero-section" id="hero">
    {{-- Hero Background Slider --}}
    <div class="hero-slider">
        <div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1920');">
        </div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1920');">
        </div>
        <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1920');">
        </div>
    </div>

    {{-- Hero Overlay --}}
    <div class="hero-overlay"></div>

    {{-- Floating Particles --}}
    <div class="hero-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    {{-- Hero Content --}}
    <div class="hero-content">
        <div class="hero-badge" data-aos="fade-down">
            <i class="fas fa-hard-hat"></i>
            <span>Trusted Construction Partner Since 2009</span>
        </div>

        <h1 class="hero-title" data-aos="fade-up" data-aos-delay="200">
            Building Your <span class="text-gradient">Dreams</span>
            <br>With Quality & Trust
        </h1>

        <p class="hero-description" data-aos="fade-up" data-aos-delay="400">
            GAK Construction delivers excellence in every project. From residential homes to
            commercial complexes, we bring your vision to life with precision, quality materials,
            and expert craftsmanship.
        </p>

        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="600">
            <a href="{{ route('services') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-tools"></i>
                Our Services
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">
                <i class="fas fa-phone-alt"></i>
                Free Consultation
            </a>
        </div>

        {{-- Hero Stats Bar --}}
        <div class="hero-stats" data-aos="fade-up" data-aos-delay="800">
            <div class="hero-stat">
                <span class="hero-stat-number">500+</span>
                <span class="hero-stat-label">Projects</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-number">15+</span>
                <span class="hero-stat-label">Years</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-number">200+</span>
                <span class="hero-stat-label">Clients</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-number">100%</span>
                <span class="hero-stat-label">Satisfaction</span>
            </div>
        </div>
    </div>

    {{-- Scroll Down Indicator --}}
    <div class="scroll-indicator">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
        <span>Scroll Down</span>
    </div>
</section>

{{-- Hero Slider Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        function nextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        setInterval(nextSlide, 5000);
    });
</script>