<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        // Return all admins using Resource to transform the data
        return AdminResource::collection(Admin::all());
    }

    public function store(AdminRequest $request)
    {
        // Validate and create a new Admin
        $admin = Admin::create($request->validated());

        // Return the response using AdminResource
        return new AdminResource($admin);
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);

        return new AdminResource($admin);
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update($request->validated());

        return new AdminResource($admin);
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        $admin = Admin::where('name', $request->name)->first();

        if (!$admin || !$admin->verifyPassword($request->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return new AdminResource($admin);
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        $admin = Admin::findOrFail($id);

        if (!$admin->verifyPassword($request->current_password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 401);
        }

        $admin->password = $request->new_password;
        $admin->save();

        return response()->json([
            'message' => 'Password changed successfully'
        ]);
    }

    public function sendEmail(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $admin = Admin::findOrFail($id);

        try {
            Mail::to($admin->email)->send(new AdminMail(
                $request->subject,
                $request->message,
                $admin->name
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
}
