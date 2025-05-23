<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceLogController extends Controller
{

    public function store(Request $request)
    {
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

    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page'); 
            $page = $request->input('page');         
    
            $devices = Device::paginate($perPage, ['*'], 'page', $page);
    
            \Log::info('Fetched paginated devices', [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $devices->total(),
                'count' => $devices->count()
            ]);
    
            return response()->json([
                'message' => 'Devices fetched successfully',
                'data' => $devices->items(),
                'meta' => [
                    'current_page' => $devices->currentPage(),
                    'last_page' => $devices->lastPage(),
                    'per_page' => $devices->perPage(),
                    'total' => $devices->total(),
                ],
                'links' => [
                    'next' => $devices->nextPageUrl(),
                    'prev' => $devices->previousPageUrl(),
                ],
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error fetching devices: ' . $e->getMessage());
    
            return response()->json([
                'message' => 'Error fetching devices',
                'error' => $e->getMessage()
            ], 500);
        }
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
