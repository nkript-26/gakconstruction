<header class="main-header" id="mainHeader">
    <div class="header-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="GAK" class="logo-img" onerror="this.src='https://via.placeholder.com/150x50?text=GAK'">
            <div class="logo-text">
                <span class="logo-name">GAK</span>
                <span class="logo-tagline">CONSTRUCTION</span>
            </div>
        </a>

        <nav class="main-nav" id="navMenu">
            <ul class="nav-list">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> About</a></li>
                <li><a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}"><i class="fas fa-cogs"></i> Services</a></li>
                <li><a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}"><i class="fas fa-building"></i> Projects</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Contact</a></li>
            </ul>
            <a href="{{ route('contact') }}" class="nav-cta-btn"><i class="fas fa-phone"></i> Get Quote</a>
        </nav>

        <button class="hamburger" id="hamburger"><i class="fas fa-bars"></i></button>
    </div>
</header>