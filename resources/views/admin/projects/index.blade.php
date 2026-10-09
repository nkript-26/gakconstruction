@extends("layouts.admin")
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
                    <form action="{{ route("admin.projects.destroy", $project->id) }}" method="POST" onsubmit="return confirm('Delete project?')">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection