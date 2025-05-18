<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string'
            ]);

            Mail::to('sy.963.syria@gmail.com')
                ->send(new ContactMail(
                    $request->name,
                    $request->email,
                    $request->subject,
                    $request->message
                ));

            return response()->json([
                'message' => 'Message sent successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 