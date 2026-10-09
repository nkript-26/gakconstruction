<?php
namespace App\Mail;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactClientMail extends Mailable {
    use Queueable, SerializesModels;
    public $contact;
    public function __construct(Contact $contact) { $this->contact = $contact; }
    public function build() {
        return $this->subject("Thank You for Contacting GAK Construction")
                    ->view("emails.contact-client");
    }
}