@extends('layouts.app')
@section('title', 'Services - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>Our Services</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="services-grid">
            @forelse($services as $service)
                <div class="service-card">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="service-img">
                    <h3>{{ $service->title }}</h3>
                    <p>{!! nl2br(e($service->description)) !!}</p>
                </div>
            @empty
                <p class="text-center">No services added yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection