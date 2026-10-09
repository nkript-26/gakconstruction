<?php
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
// Redirect default 'login' route to Filament's login page
Route::get('/login', function () {
    return redirect()->to('/admin/login');
})->name('login');
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
});
