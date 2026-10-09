<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Contact;

class DashboardController extends Controller {
    public function index() {
        $banners_count = HeroBanner::count();
        $projects_count = Project::count();
        $services_count = Service::count();
        $contacts_count = Contact::where("status", "new")->count();

        return view("admin.dashboard", compact("banners_count", "projects_count", "services_count", "contacts_count"));
    }
}