@extends("layouts.admin")
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
                        <form action="{{ route("admin.contacts.destroy", $contact->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete inquiry?')">
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
@endsection