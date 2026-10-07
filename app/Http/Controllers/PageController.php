<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Home Page
     */
    public function home()
    {
        // Data to pass to the home page
        $services = [
            [
                'icon' => '🏗️',
                'title' => 'Building Construction',
                'description' => 'We build residential, commercial, and industrial buildings with the highest quality standards and modern techniques.',
            ],
            [
                'icon' => '🏠',
                'title' => 'Home Renovation',
                'description' => 'Transform your existing space with our expert renovation services. From kitchen remodeling to complete home makeovers.',
            ],
            [
                'icon' => '🛣️',
                'title' => 'Road Construction',
                'description' => 'Professional road and infrastructure construction services for government and private sector projects.',
            ],
            [
                'icon' => '📐',
                'title' => 'Architecture Design',
                'description' => 'Creative and functional architectural designs that bring your vision to life with precision and elegance.',
            ],
            [
                'icon' => '🔧',
                'title' => 'Plumbing & Electrical',
                'description' => 'Complete plumbing and electrical installation and maintenance services for all types of buildings.',
            ],
            [
                'icon' => '🏢',
                'title' => 'Interior Design',
                'description' => 'Professional interior design services to create beautiful, functional spaces that reflect your style.',
            ],
        ];

        $projects = [
            [
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600',
                'title' => 'Modern Office Complex',
                'category' => 'Commercial',
                'location' => 'Colombo, Sri Lanka',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600',
                'title' => 'Luxury Apartments',
                'category' => 'Residential',
                'location' => 'Kandy, Sri Lanka',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600',
                'title' => 'Highway Bridge Project',
                'category' => 'Infrastructure',
                'location' => 'Galle, Sri Lanka',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=600',
                'title' => 'Shopping Mall',
                'category' => 'Commercial',
                'location' => 'Negombo, Sri Lanka',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600',
                'title' => 'Villa Project',
                'category' => 'Residential',
                'location' => 'Matara, Sri Lanka',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1590725140246-20acdee442be?w=600',
                'title' => 'Factory Building',
                'category' => 'Industrial',
                'location' => 'Kurunegala, Sri Lanka',
            ],
        ];

        $stats = [
            ['number' => '500+', 'label' => 'Projects Completed'],
            ['number' => '15+', 'label' => 'Years Experience'],
            ['number' => '200+', 'label' => 'Happy Clients'],
            ['number' => '50+', 'label' => 'Team Members'],
        ];

        $testimonials = [
            [
                'name' => 'Rajesh Kumar',
                'position' => 'Business Owner',
                'text' => 'GAK Construction built our office complex on time and within budget. Their attention to detail and professionalism is unmatched.',
                'rating' => 5,
            ],
            [
                'name' => 'Priya Sharma',
                'position' => 'Homeowner',
                'text' => 'We are extremely happy with our new home. The team was very cooperative and the quality of construction is excellent.',
                'rating' => 5,
            ],
            [
                'name' => 'Mohamed Ali',
                'position' => 'Property Developer',
                'text' => 'I have worked with many construction companies, but GAK stands out for their reliability and quality workmanship.',
                'rating' => 4,
            ],
        ];

        return view('pages.home', compact('services', 'projects', 'stats', 'testimonials'));
    }

    /**
     * About Page
     */
    public function about()
    {
        $teamMembers = [
            [
                'name' => 'G.A. Kamal',
                'position' => 'Founder & CEO',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400',
            ],
            [
                'name' => 'Nimal Perera',
                'position' => 'Chief Engineer',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400',
            ],
            [
                'name' => 'Saman Fernando',
                'position' => 'Project Manager',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
            ],
            [
                'name' => 'Kumari Silva',
                'position' => 'Architect',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400',
            ],
        ];

        return view('pages.about', compact('teamMembers'));
    }

    /**
     * Services Page
     */
    public function services()
    {
        $services = [
            [
                'icon' => '🏗️',
                'title' => 'Building Construction',
                'description' => 'Complete building construction services from foundation to finishing. We handle residential, commercial, and industrial projects with precision and quality.',
                'features' => ['Foundation Work', 'Structural Design', 'Quality Materials', 'Timely Delivery'],
            ],
            [
                'icon' => '🏠',
                'title' => 'Home Renovation',
                'description' => 'Transform your home with our renovation expertise. We modernize kitchens, bathrooms, bedrooms and entire homes.',
                'features' => ['Kitchen Remodeling', 'Bathroom Renovation', 'Room Additions', 'Flooring & Tiling'],
            ],
            [
                'icon' => '🛣️',
                'title' => 'Road & Infrastructure',
                'description' => 'Professional road construction and infrastructure development for government and private projects.',
                'features' => ['Road Construction', 'Bridge Building', 'Drainage Systems', 'Land Development'],
            ],
            [
                'icon' => '📐',
                'title' => 'Architecture & Design',
                'description' => 'Creative architectural designs that balance aesthetics with functionality. We bring your vision to reality.',
                'features' => ['3D Modeling', 'Blueprint Design', 'Interior Planning', 'Landscape Design'],
            ],
            [
                'icon' => '🔧',
                'title' => 'Plumbing & Electrical',
                'description' => 'Complete MEP services including plumbing, electrical wiring, and HVAC installation for all building types.',
                'features' => ['Pipe Fitting', 'Wiring & Panels', 'HVAC Systems', 'Maintenance'],
            ],
            [
                'icon' => '🏢',
                'title' => 'Interior Design',
                'description' => 'Beautiful interior spaces designed to reflect your personality and maximize comfort and functionality.',
                'features' => ['Space Planning', 'Furniture Design', 'Color Consulting', 'Lighting Design'],
            ],
        ];

        return view('pages.services', compact('services'));
    }

    /**
     * Projects Page
     */
    public function projects()
    {
        $projects = [
            [
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600',
                'title' => 'Modern Office Complex',
                'category' => 'Commercial',
                'location' => 'Colombo',
                'year' => '2024',
                'description' => 'A state-of-the-art 20-story office building with modern amenities.',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600',
                'title' => 'Luxury Apartment Tower',
                'category' => 'Residential',
                'location' => 'Kandy',
                'year' => '2023',
                'description' => 'Premium residential apartments with world-class facilities.',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600',
                'title' => 'Highway Bridge',
                'category' => 'Infrastructure',
                'location' => 'Galle',
                'year' => '2023',
                'description' => 'Major highway bridge project connecting southern expressway.',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=600',
                'title' => 'City Mall',
                'category' => 'Commercial',
                'location' => 'Negombo',
                'year' => '2022',
                'description' => 'Multi-story shopping complex with entertainment zone.',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600',
                'title' => 'Beach Villa',
                'category' => 'Residential',
                'location' => 'Matara',
                'year' => '2022',
                'description' => 'Luxury beach-front villa with modern architecture.',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1590725140246-20acdee442be?w=600',
                'title' => 'Industrial Factory',
                'category' => 'Industrial',
                'location' => 'Kurunegala',
                'year' => '2021',
                'description' => 'Large-scale factory with advanced structural engineering.',
            ],
        ];

        $categories = ['All', 'Commercial', 'Residential', 'Infrastructure', 'Industrial'];

        return view('pages.projects', compact('projects', 'categories'));
    }

    /**
     * Contact Page
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Contact Form Submission
     */
    public function contactSubmit(Request $request)
    {
        // Validate the form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Here you can save to database or send email
        // For now, redirect with success message
        return redirect()->route('contact')->with('success', 'Thank you for contacting GAK Construction! We will get back to you soon.');
    }
}