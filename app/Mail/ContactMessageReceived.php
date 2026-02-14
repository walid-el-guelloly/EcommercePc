<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $messageModel;

    public function __construct(ContactMessage $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    public function build()
    {
        return $this
            ->subject('Nouveau message de contact - PC Shop')
            ->replyTo($this->messageModel->email, $this->messageModel->name)
            ->markdown('emails.contact.received', [
                'msg' => $this->messageModel,
            ]);
    }
}