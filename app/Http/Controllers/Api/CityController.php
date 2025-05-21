<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Http\Resources\CityResource;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CityController extends Controller
{
            
            public function index(Request $request)
            {
                $perPage = $request->input('per_page'); 
                $page = $request->input('page'); 
                
                return CityResource::collection(City::paginate($perPage, ['*'], 'page', $page));
            }

    public function store(CityRequest $request)
    {
        try {
            $validated = $request->validated();
    
            // Handle file upload directly to public
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . Str::random(10) . '.' . $extension;
    
                // Destination folder
                $destinationPath = public_path('cities');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                // Move the file
                $file->move($destinationPath, $filename);
    
                // Save public URL
                $validated['photo'] = url('cities/' . $filename);
            }
    
            $city = City::create($validated);
            return new CityResource($city);
    
        } catch (\Exception $e) {
            // Clean up uploaded file if DB insert fails
            if (isset($filename)) {
                $filePath = public_path('cities/' . $filename);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
    
            Log::error('Error creating city', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'message' => 'Error creating city',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        $city = City::findOrFail($id);
        return new CityResource($city);
    }

    public function update(Request $request, $id)
    {
        try {
            $city = City::findOrFail($id);
    
            // Validate the request
            $validated = $request->validate([
                'city_name' => 'sometimes|string|max:255',
                'city_type' => 'sometimes|integer|max:255',
                'description' => 'sometimes|string',
                'photo' => 'sometimes|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
                'categories_idcategories' => 'sometimes|integer|exists:categories,idcategories',
                'languages_idlanguages' => 'sometimes|integer|exists:languages,idlanguages'
            ]);
    
            // Handle file upload if provided
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($city->photo && !str_contains($city->photo, 'default.png')) {
                    $oldFilename = basename($city->photo); 
                    $oldFilePath = public_path('cities/' . $oldFilename);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); 
                    }
                }
    
                // Upload new photo
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('cities');
    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                $file->move($destinationPath, $filename);
    
                // Store the URL of the new photo
                $validated['photo'] = url('cities/' . $filename);
            }
    
            // Update the city record
            $city->update($validated);
    
            return new CityResource($city);
    
        } catch (\Exception $e) {
            Log::error('Error updating city', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error updating city',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy($id)
    {
        try {
            $city = City::findOrFail($id);
    
            // Delete the photo file if exists
            if ($city->photo && !str_contains($city->photo, 'default.png')) {
                $oldFilename = basename($city->photo); 
                $oldFilePath = public_path('cities/' . $oldFilename);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); 
                }
            }
            $city->users()->delete();
            // Then delete ways (as they depend on services)
            $city->ways()->delete();
            
            // Then delete services (as they depend on places)
            $city->services()->delete();
            
            // Then delete links (as they depend on languages)
            $city->links()->delete();
            
            // Then delete media (as they depend on languages)
            $city->media()->delete();
            
            // Then delete places (as they depend on cities)
            $city->places()->delete();
            
            $city->delete();
            return response()->json(['message' => 'City and all related records deleted successfully']);
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

    public function filterByCategoryAndLanguage(Request $request, $categoryId, $languageId)
    {
        try {
            $perPage = $request->input('per_page'); 
            $page = $request->input('page'); 
            
            $cities = City::where('categories_idcategories', $categoryId)
                         ->where('languages_idlanguages', $languageId)
                         ->with(['category', 'language'])
                         ->paginate($perPage, ['*'], 'page', $page);
            
            return CityResource::collection($cities);
        } catch (\Exception $e) {
            Log::error('Error filtering cities', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error filtering cities',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
