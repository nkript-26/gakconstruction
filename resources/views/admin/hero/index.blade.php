@extends("layouts.admin")
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
                    <form action="{{ route("admin.hero.destroy", $banner->id) }}" method="POST" onsubmit="return confirm('Delete banner?')">
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