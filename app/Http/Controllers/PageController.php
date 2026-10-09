<?php
namespace App\Http\Controllers;
use App\Models\HeroBanner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Contact;
use App\Mail\ContactAdminMail;
use App\Mail\ContactClientMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller {
    public function home() {
        $banners = HeroBanner::where("is_active", true)->orderBy("order")->get();
        $services = Service::where("is_active", true)->orderBy("order")->take(6)->get();
        $projects = Project::latest()->take(6)->get();

        return view("pages.home", compact("banners", "services", "projects"));
    }

    public function about() {
        return view("pages.about");
    }

    public function services() {
        $services = Service::where("is_active", true)->orderBy("order")->get();
        return view("pages.services", compact("services"));
    }

    public function projects() {
        $projects = Project::latest()->get();
        return view("pages.projects", compact("projects"));
    }

    public function contact() {
        return view("pages.contact");
    }

    public function contactSubmit(Request $request) {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "mobile" => "required|string|max:20",
            "requirements" => "required|string|max:2000",
        ]);

        $contact = Contact::create($validated);

        try {
            $adminEmail = env("ADMIN_EMAIL", "admin@gakconstruction.com");
            Mail::to($adminEmail)->send(new ContactAdminMail($contact));
            Mail::to($contact->email)->send(new ContactClientMail($contact));
        } catch (\Exception $e) {
            \Log::error("Mail error: " . $e->getMessage());
        }

        return redirect()->route("contact")->with("success", "Thank you! Your message has been sent. We will contact you soon.");
    }
}