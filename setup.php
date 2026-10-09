<?php

echo "🛠️ Setting up Native Laravel Website & Admin Panel for GAK Construction...\n";

$files = [];

// 1. MIGRATIONS
$files['database/migrations/2024_01_01_000001_create_hero_banners_table.php'] = '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("hero_banners", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("subtitle")->nullable();
            $table->string("image");
            $table->boolean("is_active")->default(true);
            $table->integer("order")->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("hero_banners"); }
};';

$files['database/migrations/2024_01_01_000002_create_projects_table.php'] = '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("projects", function (Blueprint $table) {
            $table->id();
            $table->string("project_name");
            $table->string("location");
            $table->text("description")->nullable();
            $table->string("image");
            $table->date("completion_date")->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("projects"); }
};';

$files['database/migrations/2024_01_01_000003_create_services_table.php'] = '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("services", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->string("image");
            $table->integer("order")->default(0);
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("services"); }
};';

$files['database/migrations/2024_01_01_000004_create_contacts_table.php'] = '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("contacts", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("mobile");
            $table->text("requirements");
            $table->enum("status", ["new", "read", "replied"])->default("new");
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("contacts"); }
};';

// 2. MODELS
$files['app/Models/HeroBanner.php'] = '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model {
    protected $fillable = ["title", "subtitle", "image", "is_active", "order"];
    protected $casts = ["is_active" => "boolean"];
}';

$files['app/Models/Project.php'] = '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ["project_name", "location", "description", "image", "completion_date"];
    protected $casts = ["completion_date" => "date"];
}';

$files['app/Models/Service.php'] = '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = ["title", "description", "image", "order", "is_active"];
    protected $casts = ["is_active" => "boolean"];
}';

$files['app/Models/Contact.php'] = '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    protected $fillable = ["name", "email", "mobile", "requirements", "status"];
}';

// 3. SEEDER (Default Admin User)
$files['database/seeders/DatabaseSeeder.php'] = '<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::updateOrCreate(
            ["email" => "admin@gakconstruction.com"],
            [
                "name" => "Admin User",
                "password" => Hash::make("admin123"),
            ]
        );
    }
}';

// 4. ADMIN CONTROLLERS
$files['app/Http/Controllers/Admin/AuthController.php'] = '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showLogin() {
        if (Auth::check()) return redirect()->route("admin.dashboard");
        return view("admin.login");
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route("admin.dashboard"));
        }

        return back()->withErrors(["email" => "Invalid credentials."]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("admin.login");
    }
}';

$files['app/Http/Controllers/Admin/DashboardController.php'] = '<?php
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
}';

$files['app/Http/Controllers/Admin/HeroBannerController.php'] = '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller {
    public function index() {
        $banners = HeroBanner::orderBy("order")->get();
        return view("admin.hero.index", compact("banners"));
    }

    public function store(Request $request) {
        $request->validate([
            "title" => "required|string|max:255",
            "image" => "required|image|mimes:jpg,jpeg,png,webp|max:5120",
        ]);

        $path = $request->file("image")->store("hero-banners", "public");

        HeroBanner::create([
            "title" => $request->title,
            "subtitle" => $request->subtitle,
            "image" => $path,
            "order" => $request->order ?? 0,
            "is_active" => $request->has("is_active"),
        ]);

        return back()->with("success", "Banner added successfully!");
    }

    public function destroy($id) {
        $banner = HeroBanner::findOrFail($id);
        Storage::disk("public")->delete($banner->image);
        $banner->delete();
        return back()->with("success", "Banner deleted!");
    }
}';

$files['app/Http/Controllers/Admin/ProjectController.php'] = '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {
    public function index() {
        $projects = Project::latest()->get();
        return view("admin.projects.index", compact("projects"));
    }

    public function store(Request $request) {
        $request->validate([
            "project_name" => "required|string|max:255",
            "location" => "required|string|max:255",
            "image" => "required|image|mimes:jpg,jpeg,png,webp|max:5120",
        ]);

        $path = $request->file("image")->store("projects", "public");

        Project::create([
            "project_name" => $request->project_name,
            "location" => $request->location,
            "description" => $request->description,
            "completion_date" => $request->completion_date,
            "image" => $path,
        ]);

        return back()->with("success", "Project added successfully!");
    }

    public function destroy($id) {
        $project = Project::findOrFail($id);
        Storage::disk("public")->delete($project->image);
        $project->delete();
        return back()->with("success", "Project deleted!");
    }
}';

$files['app/Http/Controllers/Admin/ServiceController.php'] = '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller {
    public function index() {
        $services = Service::orderBy("order")->get();
        return view("admin.services.index", compact("services"));
    }

    public function store(Request $request) {
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "image" => "required|image|mimes:jpg,jpeg,png,webp|max:5120",
        ]);

        $path = $request->file("image")->store("services", "public");

        Service::create([
            "title" => $request->title,
            "description" => $request->description,
            "order" => $request->order ?? 0,
            "image" => $path,
        ]);

        return back()->with("success", "Service added successfully!");
    }

    public function destroy($id) {
        $service = Service::findOrFail($id);
        Storage::disk("public")->delete($service->image);
        $service->delete();
        return back()->with("success", "Service deleted!");
    }
}';

$files['app/Http/Controllers/Admin/ContactController.php'] = '<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller {
    public function index() {
        $contacts = Contact::latest()->get();
        return view("admin.contacts.index", compact("contacts"));
    }

    public function markRead($id) {
        $contact = Contact::findOrFail($id);
        $contact->update(["status" => "read"]);
        return back()->with("success", "Contact marked as read.");
    }

    public function destroy($id) {
        Contact::findOrFail($id)->delete();
        return back()->with("success", "Contact request deleted!");
    }
}';

// 5. PUBLIC CONTROLLER
$files['app/Http/Controllers/PageController.php'] = '<?php
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
}';

// 6. MAILERS
$files['app/Mail/ContactAdminMail.php'] = '<?php
namespace App\Mail;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable {
    use Queueable, SerializesModels;
    public $contact;
    public function __construct(Contact $contact) { $this->contact = $contact; }
    public function build() {
        return $this->subject("🔔 New Contact Request from " . $this->contact->name)
                    ->view("emails.contact-admin");
    }
}';

$files['app/Mail/ContactClientMail.php'] = '<?php
namespace App\Mail;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactClientMail extends Mailable {
    use Queueable, SerializesModels;
    public $contact;
    public function __construct(Contact $contact) { $this->contact = $contact; }
    public function build() {
        return $this->subject("Thank You for Contacting GAK Construction")
                    ->view("emails.contact-client");
    }
}';

// 7. ROUTES
$files['routes/web.php'] = '<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController;

// Public Routes
Route::get("/", [PageController::class, "home"])->name("home");
Route::get("/about", [PageController::class, "about"])->name("about");
Route::get("/services", [PageController::class, "services"])->name("services");
Route::get("/projects", [PageController::class, "projects"])->name("projects");
Route::get("/contact", [PageController::class, "contact"])->name("contact");
Route::post("/contact", [PageController::class, "contactSubmit"])->name("contact.submit");

// Admin Routes
Route::prefix("admin")->name("admin.")->group(function () {
    Route::get("/login", [AuthController::class, "showLogin"])->name("login");
    Route::post("/login", [AuthController::class, "login"])->name("login.submit");
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");

    Route::middleware("auth")->group(function () {
        Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");

        // Hero Banners
        Route::get("/hero", [HeroBannerController::class, "index"])->name("hero.index");
        Route::post("/hero", [HeroBannerController::class, "store"])->name("hero.store");
        Route::delete("/hero/{id}", [HeroBannerController::class, "destroy"])->name("hero.destroy");

        // Projects
        Route::get("/projects", [ProjectController::class, "index"])->name("projects.index");
        Route::post("/projects", [ProjectController::class, "store"])->name("projects.store");
        Route::delete("/projects/{id}", [ProjectController::class, "destroy"])->name("projects.destroy");

        // Services
        Route::get("/services", [ServiceController::class, "index"])->name("services.index");
        Route::post("/services", [ServiceController::class, "store"])->name("services.store");
        Route::delete("/services/{id}", [ServiceController::class, "destroy"])->name("services.destroy");

        // Contacts
        Route::get("/contacts", [ContactController::class, "index"])->name("contacts.index");
        Route::patch("/contacts/{id}/read", [ContactController::class, "markRead"])->name("contacts.read");
        Route::delete("/contacts/{id}", [ContactController::class, "destroy"])->name("contacts.destroy");
    });
});';

// 8. ADMIN BLADE VIEWS
$files['resources/views/layouts/admin.blade.php'] = '<!DOCTYPE html>
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
</html>';

$files['resources/views/admin/login.blade.php'] = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - GAK Construction</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a1a2e, #c0392b); height: 100vh; display: flex; align-items: center; justify-content: center; font-family: "Poppins", sans-serif; }
        .login-box { background: #fff; padding: 40px; border-radius: 12px; width: 380px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); text-align: center; }
        .login-box h2 { color: #c0392b; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        .btn-submit { width: 100%; padding: 12px; background: #c0392b; color: #fff; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .btn-submit:hover { background: #a93226; }
        .error { color: red; font-size: 13px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>GAK Admin Login</h2>
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route("admin.login.submit") }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required value="admin@gakconstruction.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="admin123">
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>
</body>
</html>';

$files['resources/views/admin/dashboard.blade.php'] = '@extends("layouts.admin")
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
@endsection';

$files['resources/views/admin/hero/index.blade.php'] = '@extends("layouts.admin")
@section("page_title", "Hero Banners")

@section("content")
<div class="card">
    <h3>Add New Hero Banner</h3>
    <form action="{{ route("admin.hero.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" required placeholder="e.g., Building Your Dreams">
        </div>
        <div class="form-group">
            <label>Subtitle</label>
            <textarea name="subtitle" rows="2" placeholder="Banner short description..."></textarea>
        </div>
        <div class="form-group">
            <label>Banner Image *</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn-primary"><i class="fas fa-plus"></i> Upload Banner</button>
    </form>
</div>

<div class="card">
    <h3>All Hero Banners</h3>
    <div class="grid-cards">
        @foreach($banners as $banner)
            <div class="item-card">
                <img src="{{ asset("storage/" . $banner->image) }}" alt="">
                <div class="item-body">
                    <h4>{{ $banner->title }}</h4>
                    <p>{{ $banner->subtitle }}</p>
                    <br>
                    <form action="{{ route("admin.hero.destroy", $banner->id) }}" method="POST" onsubmit="return confirm(\'Delete banner?\')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection';

$files['resources/views/admin/projects/index.blade.php'] = '@extends("layouts.admin")
@section("page_title", "Projects")

@section("content")
<div class="card">
    <h3>Add Completed Project</h3>
    <form action="{{ route("admin.projects.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Project Name *</label>
            <input type="text" name="project_name" required placeholder="e.g., Commercial Tower">
        </div>
        <div class="form-group">
            <label>Location *</label>
            <input type="text" name="location" required placeholder="e.g., Colombo, Sri Lanka">
        </div>
        <div class="form-group">
            <label>Completion Date</label>
            <input type="date" name="completion_date">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Project Image *</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn-primary"><i class="fas fa-plus"></i> Add Project</button>
    </form>
</div>

<div class="card">
    <h3>All Projects</h3>
    <div class="grid-cards">
        @foreach($projects as $project)
            <div class="item-card">
                <img src="{{ asset("storage/" . $project->image) }}" alt="">
                <div class="item-body">
                    <h4>{{ $project->project_name }}</h4>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</p>
                    <br>
                    <form action="{{ route("admin.projects.destroy", $project->id) }}" method="POST" onsubmit="return confirm(\'Delete project?\')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection';

$files['resources/views/admin/services/index.blade.php'] = '@extends("layouts.admin")
@section("page_title", "Services")

@section("content")
<div class="card">
    <h3>Add Service</h3>
    <form action="{{ route("admin.services.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" required placeholder="e.g., Building Construction">
        </div>
        <div class="form-group">
            <label>Description *</label>
            <textarea name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Service Image *</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn-primary"><i class="fas fa-plus"></i> Add Service</button>
    </form>
</div>

<div class="card">
    <h3>All Services</h3>
    <div class="grid-cards">
        @foreach($services as $service)
            <div class="item-card">
                <img src="{{ asset("storage/" . $service->image) }}" alt="">
                <div class="item-body">
                    <h4>{{ $service->title }}</h4>
                    <p>{{ Str::limit($service->description, 80) }}</p>
                    <br>
                    <form action="{{ route("admin.services.destroy", $service->id) }}" method="POST" onsubmit="return confirm(\'Delete service?\')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection';

$files['resources/views/admin/contacts/index.blade.php'] = '@extends("layouts.admin")
@section("page_title", "Contact Requests")

@section("content")
<div class="card">
    <h3>Contact Inquiries</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Requirements</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->created_at->format("d M Y") }}</td>
                    <td><strong>{{ $contact->name }}</strong></td>
                    <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                    <td><a href="tel:{{ $contact->mobile }}">{{ $contact->mobile }}</a></td>
                    <td>{{ $contact->requirements }}</td>
                    <td>
                        <span style="padding:3px 10px; border-radius:10px; color:#fff; font-size:12px; background:{{ $contact->status == "new" ? "#e74c3c" : "#27ae60" }}">
                            {{ ucfirst($contact->status) }}
                        </span>
                    </td>
                    <td>
                        @if($contact->status == "new")
                            <form action="{{ route("admin.contacts.read", $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method("PATCH")
                                <button type="submit" style="background:#3498db; color:#fff; border:none; padding:4px 8px; border-radius:4px; cursor:pointer;"><i class="fas fa-check"></i></button>
                            </form>
                        @endif
                        <form action="{{ route("admin.contacts.destroy", $contact->id) }}" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete inquiry?\')">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn-delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection';

// Write all files
foreach ($files as $path => $content) {
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents($path, $content);
    echo "  [✓] Generated: {$path}\n";
}

echo "\n✨ Native Laravel Website & Admin Panel setup complete!\n";