<?php
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
}