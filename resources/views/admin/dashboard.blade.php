@extends("layouts.admin")
@section("page_title", "Dashboard")

@section("content")
<style>
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
    .stat-card { padding: 25px; border-radius: 10px; color: #fff; text-align: center; }
    .stat-card h3 { font-size: 32px; margin-bottom: 5px; }
</style>

<div class="stats-grid">
    <div class="stat-card" style="background:#3498db;">
        <h3>{{ $banners_count }}</h3>
        <p>Hero Banners</p>
    </div>
    <div class="stat-card" style="background:#27ae60;">
        <h3>{{ $projects_count }}</h3>
        <p>Projects</p>
    </div>
    <div class="stat-card" style="background:#e67e22;">
        <h3>{{ $services_count }}</h3>
        <p>Services</p>
    </div>
    <div class="stat-card" style="background:#c0392b;">
        <h3>{{ $contacts_count }}</h3>
        <p>New Contacts</p>
    </div>
</div>

<div class="card" style="margin-top:30px;">
    <h3>Welcome to GAK Construction Admin Panel</h3>
    <p>Use the left sidebar menu to upload hero banners, add completed projects, manage services, and view client contact requests.</p>
</div>
@endsection