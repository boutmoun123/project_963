<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Resources\ServiceResource;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page'); 
        $page = $request->input('page'); 
        
        return ServiceResource::collection(Service::paginate($perPage, ['*'], 'page', $page));
    }

    public function store(ServiceRequest $request)
    {
        try {
            // Validate the request
            $validated = $request->validated();
    
            \Log::info('Validated data:', $validated);
    
            // Ensure ser_type is present
            if (!isset($validated['ser_type'])) {
                throw new \Exception('ser_type is missing from validated data');
            }
    
            // Handle file upload for ser_photo
            if ($request->hasFile('ser_photo')) {
                $file = $request->file('ser_photo');
                $filename = time() . '_' . $file->getClientOriginalName();
    
                // Set destination directory
                $destinationPath = public_path('services');
    
                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0775, true);
                    \Log::info("Created directory: $destinationPath");
                }
    
                // Move file to public/services
                $file->move($destinationPath, $filename);
    
                \Log::info("File uploaded: $filename");
    
                // Generate accessible URL
                $validated['ser_photo'] = asset('services/' . $filename);
            }
    
            // Create new service record
            $service = Service::create([
                'ser_name' => $validated['ser_name'],
                'ser_type' => $validated['ser_type'],
                'ser_photo' => $validated['ser_photo'] ?? null,
                'description' => $validated['description'] ?? null,
                'languages_idlanguages' => $validated['languages_idlanguages'],
                'categories_idcategories' => $validated['categories_idcategories'],
                'cities_idcities' => $validated['cities_idcities'],
            ]);
    
            \Log::info('Created service:', $service->toArray());
    
            return new ServiceResource($service);
    
        } catch (\Exception $e) {
            \Log::error('Error creating service: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('Raw request data:', $request->all());
    
            return response()->json([
                'message' => 'Error creating service',
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ], 500);
        }
    }
    
    
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return new ServiceResource($service);
    }

public function update(ServiceRequest $request, $id)
{
    try {
        $service = Service::findOrFail($id);
        $validated = $request->validated();

        // Handle file upload for ser_photo
        if ($request->hasFile('ser_photo')) {

            if ($service->ser_photo) {

                $oldFilename = basename($service->ser_photo);
                $oldPath = public_path('services/' . $oldFilename);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('ser_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // حفظ الصورة في مجلد public/services
            $destinationPath = public_path('services');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            $file->move($destinationPath, $filename);

            $validated['ser_photo'] = asset('services/' . $filename);
        } else {

            unset($validated['ser_photo']);
        }

        $service->update($validated);

        return new ServiceResource($service);

    } catch (\Exception $e) {
        \Log::error('Error updating service', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'Error updating service',
            'error' => $e->getMessage()
        ], 500);
    }
}

    
public function destroy($id)
{
    try {
        $service = Service::findOrFail($id);

        if ($service->ser_photo && $service->ser_photo !== asset('services/default.png')) {
            $filename = basename($service->ser_photo);
            $filePath = public_path('services/' . $filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
            $service->users()->delete();
            // Then delete ways (as they depend on services)
            $service->ways()->delete();
            
            // Then delete links (as they depend on languages)
            $service->links()->delete();
            
            // Then delete media (as they depend on languages)
            $service->media()->delete();
            
            // Then delete places (as they depend on cities)
            $service->places()->delete();
            
            $service->delete();
            return response()->json(['message' => 'Service and all related records deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting city', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error deleting city',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function filterByCityCategoryAndLanguage(Request $request, $cityId, $categoryId, $languageId)
    {
        try {
            $perPage = $request->input('per_page'); 
            $page = $request->input('page'); 

            $services = Service::where('cities_idcities', $cityId)
                          ->where('categories_idcategories', $categoryId)
                          ->where('languages_idlanguages', $languageId)
                          ->with(['city', 'category', 'language'])
                          ->paginate($perPage, ['*'], 'page', $page);
            
            return ServiceResource::collection($services);
        } catch (\Exception $e) {
            Log::error('Error filtering services', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error filtering services',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

