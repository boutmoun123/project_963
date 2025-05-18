<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Mail\AdminMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = User::create($validated);
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function sendEmailToAdmin(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'email' => 'required|email'
        ]);

        try {
            Mail::to(config('mail.from.address', 'sy.963.syria@gmail.com'))->send(new AdminMail(
                $request->subject,
                $request->message,
                'Admin'
            ));

            return response()->json([
                'message' => 'Email sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send email',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function contactAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            Mail::to(config('mail.from.address', 'sy.963.syria@gmail.com'))->send(new AdminMail(
                $request->subject,
                "From: {$request->name} ({$request->email})\n\n{$request->message}",
                'Admin'
            ));

            return response()->json([
                'message' => 'Message sent successfully to admin'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
