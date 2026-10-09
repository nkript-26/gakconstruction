<section class="hero-section">
    <div class="hero-slider">
        @forelse($banners as $index => $banner)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
                 style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <div class="hero-badge"><i class="fas fa-hard-hat"></i> GAK Construction</div>
                    <h1 class="hero-title">{{ $banner->title }}</h1>
                    <p class="hero-description">{{ $banner->subtitle }}</p>
                    <div class="hero-buttons">
                        <a href="{{ route('services') }}" class="btn btn-primary">Our Services</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline">Contact Us</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1920');">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <div class="hero-badge"><i class="fas fa-hard-hat"></i> GAK Construction</div>
                    <h1 class="hero-title">Building Your <span style="color:#e74c3c">Dreams</span></h1>
                    <p class="hero-description">Please add hero banners from the admin panel.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('services') }}" class="btn btn-primary">Services</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline">Contact</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 1) {
        let current = 0;
        setInterval(() => {
            slides[current].classList.remove('active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('active');
        }, 5000);
    }
});
</script>