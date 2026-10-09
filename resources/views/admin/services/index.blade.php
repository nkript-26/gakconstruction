@extends("layouts.admin")
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
                    <form action="{{ route("admin.services.destroy", $service->id) }}" method="POST" onsubmit="return confirm('Delete service?')">
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