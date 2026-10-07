{{-- ==================== FOOTER ==================== --}}
<footer class="main-footer">
    {{-- Footer Top --}}
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">
                {{-- Company Info --}}
                <div class="footer-col" data-aos="fade-up">
                    <div class="footer-logo">
                        <img src="{{ asset('images/GAK1.png') }}" alt="GAK Construction" class="footer-logo-img">
                        <div>
                            <span class="footer-brand">GAK</span>
                            <span class="footer-brand-sub">CONSTRUCTION</span>
                        </div>
                    </div>
                    <p class="footer-about">
                        GAK Construction is a leading construction company dedicated to building
                        quality structures. With 15+ years of experience, we deliver excellence
                        in every project.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="footer-col" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="{{ route('projects') }}"><i class="fas fa-chevron-right"></i> Projects</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>

                {{-- Our Services --}}
                <div class="footer-col" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="footer-title">Our Services</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Building Construction</a></li>
                        <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Home Renovation</a></li>
                        <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Road Construction</a></li>
                        <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Architecture Design</a></li>
                        <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Interior Design</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div class="footer-col" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="footer-title">Contact Us</h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Construction Lane,<br>Colombo 05, Sri Lanka</span>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <span>
                                <a href="tel:+94771234567">+94 77 123 4567</a><br>
                                <a href="tel:+94112345678">+94 11 234 5678</a>
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>
                                <a href="mailto:info@gakconstruction.com">info@gakconstruction.com</a>
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>Mon - Sat: 8:00 AM - 6:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p>&copy; {{ date('Y') }} GAK Construction. All Rights Reserved.</p>
                <p>Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> for Excellence</p>
            </div>
        </div>
    </div>
</footer>