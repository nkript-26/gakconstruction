<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3>GAK Construction</h3>
            <p>Building quality structures with over 15 years of experience.</p>
        </div>
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('services') }}">Services</a></li>
                <li><a href="{{ route('projects') }}">Projects</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Contact</h3>
            <p><i class="fas fa-map-marker-alt"></i> Colombo, Sri Lanka</p>
            <p><i class="fas fa-phone"></i> +94 77 123 4567</p>
            <p><i class="fas fa-envelope"></i> info@gakconstruction.com</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} GAK Construction. All Rights Reserved.</p>
    </div>
</footer>