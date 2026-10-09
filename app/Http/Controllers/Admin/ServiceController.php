<?php
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
}