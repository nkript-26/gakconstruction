<?php
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
}