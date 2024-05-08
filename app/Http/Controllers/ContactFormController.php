<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactFormController extends Controller
{
    public function submit(Request $request)
    {
        $messages = [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'message.required' => 'Message is required',
        ];
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ], $messages );

        try {
            Mail::to('ademeure29@gmail.com')->send(new ContactMail($validated));
        } catch (\Exception $e) {

            Log::info('Error sending email: ' . $e->getMessage());
            // Gérer les erreurs d'envoi d'e-mail ici
            return redirect()->back()->with('error', 'An error occurred while sending the email.');
        }

        // envoyer un email
        return redirect()->back()->with('message', 'Message sent successfully!');
    }
}
