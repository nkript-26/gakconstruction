@extends('layouts.app')
@section('title', 'Projects - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>Completed Projects</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="projects-grid">
            @forelse($projects as $project)
                <div class="project-card">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->project_name }}">
                    <div class="project-info">
                        <h3>{{ $project->project_name }}</h3>
                        <p><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</p>
                        @if($project->description)
                            <p>{{ $project->description }}</p>
                        @endif
                        @if($project->completion_date)
                            <p><i class="fas fa-calendar"></i> {{ $project->completion_date->format('M Y') }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center">No projects added yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection