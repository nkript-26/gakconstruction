<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GAK Construction - Building Your Dreams With Quality and Trust. Professional construction services.">
    <meta name="keywords" content="GAK Construction, building, construction, renovation, architecture">
    <title>@yield('title', 'GAK Construction - Building Your Dreams')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    @yield('extra-css')
</head>
<body>

    {{-- Include Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Include Footer --}}
    @include('partials.footer')

    {{-- Back to Top Button --}}
    <button id="backToTop" class="back-to-top" title="Go to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- AOS Animation JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Mobile Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const navOverlay = document.getElementById('navOverlay');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            navOverlay.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });

        // Close menu when clicking overlay
        navOverlay.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            navOverlay.classList.remove('active');
            document.body.classList.remove('no-scroll');
        });

        // Close menu when clicking a nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                navOverlay.classList.remove('active');
                document.body.classList.remove('no-scroll');
            });
        });

        // Header scroll effect
        const header = document.getElementById('mainHeader');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Back to Top Button
        const backToTopBtn = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = counter.getAttribute('data-target');
                const numericTarget = parseInt(target);
                const duration = 2000;
                const increment = numericTarget / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < numericTarget) {
                        counter.textContent = Math.floor(current) + '+';
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                updateCounter();
            });
        }

        // Intersection Observer for counter animation
        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            observer.observe(statsSection);
        }
    </script>

    @yield('extra-js')
</body>
</html>