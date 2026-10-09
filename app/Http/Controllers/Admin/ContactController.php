<?php
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
}