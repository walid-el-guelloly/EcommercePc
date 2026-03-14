<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageReceived;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
          $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|min:10',
    ]);

    
    $contactMessage = ContactMessage::create($data);

    
    Mail::to('walid8el8guelloly@gmail.com') 
        ->send(new ContactMessageReceived($contactMessage));

    return back()->with('success', 'Merci, votre message a bien été envoyé. Nous vous répondrons rapidement.');
    }
}