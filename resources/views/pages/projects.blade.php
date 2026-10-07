@extends('layouts.app')

@section('title', 'Our Projects - GAK Construction')

@section('content')

    {{-- Page Banner --}}
    <section class="page-banner" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920');">
        <div class="page-banner-overlay"></div>
        <div class="page-banner-content" data-aos="fade-up">
            <h1>Our Projects</h1>
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Projects</span>
            </nav>
        </div>
    </section>

    {{-- Projects --}}
    <section class="section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-subtitle"><i class="fas fa-building"></i> Portfolio</span>
                <h2 class="section-title">Our <span class="text-red">Completed</span> Projects</h2>
            </div>

            {{-- Filter Buttons --}}
            <div class="project-filters" data-aos="fade-up">
                @foreach($categories as $category)
                    <button class="filter-btn {{ $category === 'All' ? 'active' : '' }}" data-filter="{{ strtolower($category) }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <div class="projects-grid projects-page-grid">
                @foreach($projects as $index => $project)
                    <div class="project-card" data-category="{{ strtolower($project['category']) }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="project-image">
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" loading="lazy">
                            <div class="project-overlay">
                                <span class="project-category">{{ $project['category'] }}</span>
                                <h3 class="project-title">{{ $project['title'] }}</h3>
                                <p class="project-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $project['location'] }}
                                </p>
                                <p class="project-year"><i class="fas fa-calendar"></i> {{ $project['year'] }}</p>
                                <p style="color: #ccc; font-size: 0.9rem; margin-top: 5px;">{{ $project['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@section('extra-js')
<script>
    // Project Filter
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');
            document.querySelectorAll('.project-card').forEach(card => {
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection