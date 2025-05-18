<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceLogController extends Controller
{

    public function store(Request $request)
    {
        // 1. تحقق من صحة البيانات المرسلة
        $data = $request->validate([
            'device_name'  => 'nullable|string|max:255',
            'platform'     => 'nullable|in:iOS,Android',
            'device_token' => 'nullable|string|max:512',
            'app_version'  => 'nullable|string|max:50',
        ]);

        $data['ip_address'] = $request->ip();

                $log = Device::create($data);

        return response()->json([
            'message' => 'Device info logged',
            'log_id'  => $log->id,
        ], 201);
    }

    public function index()
    {
        $logs = Device::all();
        return response()->json($logs);
    }

    public function show($id)
    {
        $log = Device::find($id);
        return response()->json($log);
    }

    public function destroy($id)
    {
        $log = Device::find($id);
        $log->delete();
        return response()->json(['message' => 'Device log deleted']);
    }
    public function destroyAll()
    {
        Device::query()->delete(); 
    
        return response()->json(['message' => 'All device logs deleted']);
    }
}
