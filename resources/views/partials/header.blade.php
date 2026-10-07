{{-- ==================== HEADER / NAVIGATION ==================== --}}
<header class="main-header" id="mainHeader">
    <div class="header-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/GAK1.png') }}" alt="GAK Construction Logo" class="logo-img">
            <div class="logo-text">
                <span class="logo-name">GAK</span>
                <span class="logo-tagline">CONSTRUCTION</span>
            </div>
        </a>

        {{-- Navigation Menu --}}
        <nav class="main-nav" id="navMenu">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                        <i class="fas fa-info-circle"></i>
                        <span>About</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">
                        <i class="fas fa-cogs"></i>
                        <span>Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        <span>Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i>
                        <span>Contact</span>
                    </a>
                </li>
            </ul>

            {{-- CTA Button in Nav --}}
            <a href="{{ route('contact') }}" class="nav-cta-btn">
                <i class="fas fa-phone"></i> Get Quote
            </a>
        </nav>

        {{-- Top Contact Info --}}
        <div class="header-contact">
            <a href="tel:+94771234567" class="header-phone">
                <i class="fas fa-phone-alt"></i>
                <span>+94 77 123 4567</span>
            </a>
        </div>

        {{-- Hamburger Menu (Mobile) --}}
        <button class="hamburger" id="hamburger" aria-label="Toggle Menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
    </div>
</header>

{{-- Mobile Overlay --}}
<div class="nav-overlay" id="navOverlay"></div>