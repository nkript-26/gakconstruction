@extends('layouts.app')
@section('title', 'GAK Construction - Home')

@section('content')
@include('partials.hero')

<section class="section bg-light">
    <div class="container text-center">
        <h4 class="text-red">What We Offer</h4>
        <h2>Our Services</h2>
        <div class="services-grid mt-4">
            @forelse($services as $service)
                <div class="service-card">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="service-img">
                    <h3>{{ $service->title }}</h3>
                    <p>{{ Str::limit($service->description, 100) }}</p>
                </div>
            @empty
                <p>No services added yet.</p>
            @endforelse
        </div>
        <br>
        <a href="{{ route('services') }}" class="btn btn-primary">View All Services</a>
    </div>
</section>

<section class="section">
    <div class="container text-center">
        <h4 class="text-red">Our Portfolio</h4>
        <h2>Recent Projects</h2>
        <div class="projects-grid mt-4">
            @forelse($projects as $project)
                <div class="project-card">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->project_name }}">
                    <div class="project-info">
                        <h3>{{ $project->project_name }}</h3>
                        <p><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</p>
                    </div>
                </div>
            @empty
                <p>No projects added yet.</p>
            @endforelse
        </div>
        <br>
        <a href="{{ route('projects') }}" class="btn btn-primary">View All Projects</a>
    </div>
</section>
@endsection