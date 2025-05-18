<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminLoginRequest;
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
        return AdminResource::collection(Admin::all());
    }

    public function store(AdminRequest $request)
    {
        try {
            $validated = $request->validated();
            $admin = Admin::create($validated);
            return new AdminResource($admin);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating admin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return new AdminResource($admin);
    }

    public function update(Request $request, $id)
    {
        try {
            $admin = Admin::findOrFail($id);
            
            // Check if trying to update boutmoun
            if ($admin->name === 'boutmoun') {
                return response()->json([
                    'message' => 'Cannot update the main admin account'
                ], 403);
            }
            
            // Validate the request
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'password' => 'sometimes|string|min:8'
            ]);

            // Update the admin
            $admin->update($validated);
            return new AdminResource($admin);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating admin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            
            // Check if the admin is boutmoun
            if ($admin->name === 'boutmoun') {
                return response()->json([
                    'message' => 'Cannot delete the main admin account'
                ], 403);
            }
            
            $admin->delete();
            return response()->json(['message' => 'Admin deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting admin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(AdminLoginRequest $request)
    {
        try {
            \Log::info('Login attempt:', [
                'name' => $request->name,
                'password_length' => strlen($request->password)
            ]);

            $admin = Admin::where('name', $request->name)->first();

            if (!$admin) {
                \Log::warning('Admin not found:', ['name' => $request->name]);
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            \Log::info('Admin found:', [
                'id' => $admin->idadmin,
                'name' => $admin->name
            ]);

            if (!Hash::check($request->password, $admin->password)) {
                \Log::warning('Invalid password for admin:', ['name' => $request->name]);
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Generate token
            $token = $admin->createToken('admin-token')->plainTextToken;
            \Log::info('Login successful:', [
                'admin_id' => $admin->idadmin,
                'token_generated' => true
            ]);

            return response()->json([
                'admin' => new AdminResource($admin),
                'token' => $token
            ]);
        } catch (\Exception $e) {
            \Log::error('Login error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
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
