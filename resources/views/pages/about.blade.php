@extends('layouts.app')
@section('title', 'About - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>About Us</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="text-center" style="max-width:800px;margin:0 auto;">
            <h4 class="text-red">Our Story</h4>
            <h2>Building Excellence Since 2009</h2>
            <br>
            <p>GAK Construction was founded with a vision to deliver top-quality construction services. We are committed to delivering exceptional quality in every project.</p>
        </div>
        <div class="mission-vision mt-4">
            <div class="mv-card">
                <h3><i class="fas fa-bullseye text-red"></i> Our Mission</h3>
                <p>To deliver exceptional construction services that exceed client expectations.</p>
            </div>
            <div class="mv-card">
                <h3><i class="fas fa-eye text-red"></i> Our Vision</h3>
                <p>To be the most trusted construction company, building a better future.</p>
            </div>
        </div>
    </div>
</section>
@endsection