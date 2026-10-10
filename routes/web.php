<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Public Routes
Route::get("/", [PageController::class, "home"])->name("home");
Route::get("/about", [PageController::class, "about"])->name("about");
Route::get("/services", [PageController::class, "services"])->name("services");
Route::get("/projects", [PageController::class, "projects"])->name("projects");
Route::get("/contact", [PageController::class, "contact"])->name("contact");
Route::post("/contact", [PageController::class, "contactSubmit"])->name("contact.submit");

// Redirect default login route to Filament
Route::get("/login", function () {
    return redirect()->to("/admin/login");
})->name("login");
