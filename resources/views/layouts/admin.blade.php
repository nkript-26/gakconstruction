<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - GAK Construction</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", sans-serif; }
        body { background: #f0f2f5; display: flex; }
        .sidebar { width: 260px; height: 100vh; background: #1a1a2e; color: #fff; position: fixed; padding-top: 20px; }
        .sidebar-brand { text-align: center; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .sidebar-brand h2 { color: #c0392b; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu a { display: flex; align-items: center; gap: 12px; padding: 14px 25px; color: #bbb; text-decoration: none; transition: 0.3s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(192,57,43,0.2); color: #fff; border-left: 4px solid #c0392b; }
        .main-content { margin-left: 260px; padding: 30px; width: calc(100% - 260px); }
        .topbar { background: #fff; padding: 15px 30px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .btn-logout { background: #c0392b; color: #fff; border: none; padding: 8px 18px; border-radius: 5px; cursor: pointer; font-weight: 600; }
        .card { background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 25px; }
        .card h3 { margin-bottom: 20px; color: #1a1a2e; border-bottom: 2px solid #c0392b; padding-bottom: 8px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 600; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px 14px; border: 1px solid #ddd; border-radius: 6px; }
        .btn-primary { background: #c0392b; color: #fff; padding: 10px 22px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; }
        .btn-primary:hover { background: #96281b; }
        .btn-delete { background: #e74c3c; color: #fff; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; text-decoration: none; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table th { background: #1a1a2e; color: #fff; padding: 12px; text-align: left; }
        .table td { padding: 12px; border-bottom: 1px solid #eee; }
        .alert { padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; }
        .grid-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .item-card { background: #f8f9fa; border-radius: 8px; overflow: hidden; border: 1px solid #ddd; }
        .item-card img { width: 100%; height: 160px; object-fit: cover; }
        .item-body { padding: 15px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-hard-hat"></i> GAK</h2>
            <p>Admin Panel</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route("admin.dashboard") }}" class="{{ request()->routeIs("admin.dashboard") ? "active" : "" }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="{{ route("admin.hero.index") }}" class="{{ request()->routeIs("admin.hero.*") ? "active" : "" }}"><i class="fas fa-image"></i> Hero Banners</a></li>
            <li><a href="{{ route("admin.projects.index") }}" class="{{ request()->routeIs("admin.projects.*") ? "active" : "" }}"><i class="fas fa-building"></i> Projects</a></li>
            <li><a href="{{ route("admin.services.index") }}" class="{{ request()->routeIs("admin.services.*") ? "active" : "" }}"><i class="fas fa-cogs"></i> Services</a></li>
            <li><a href="{{ route("admin.contacts.index") }}" class="{{ request()->routeIs("admin.contacts.*") ? "active" : "" }}"><i class="fas fa-envelope"></i> Contacts</a></li>
            <li><a href="{{ route("home") }}" target="_blank"><i class="fas fa-globe"></i> View Site</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h2>@yield("page_title", "Dashboard")</h2>
            <form action="{{ route("admin.logout") }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>

        @if(session("success"))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session("success") }}</div>
        @endif

        @yield("content")
    </div>
</body>
</html>