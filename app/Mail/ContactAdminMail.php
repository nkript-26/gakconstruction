<?php
namespace App\Mail;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable {
    use Queueable, SerializesModels;
    public $contact;
    public function __construct(Contact $contact) { $this->contact = $contact; }
    public function build() {
        return $this->subject("🔔 New Contact Request from " . $this->contact->name)
                    ->view("emails.contact-admin");
    }
}