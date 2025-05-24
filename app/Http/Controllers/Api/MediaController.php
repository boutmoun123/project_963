<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Http\Resources\MediaResource;
use App\Http\Requests\MediaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page'); 
        $page = $request->input('page'); 
        
        return MediaResource::collection(Media::with(['star', 'service'])->paginate($perPage, ['*'], 'page', $page));
    }

    public function store(MediaRequest $request)
    {
        try {
            $validated = $request->validated();
    
            // ربط المفاتيح
            $validated['stars_idstars'] = $validated['star'] ?? null;
            $validated['services_idservices'] = $validated['service'] ?? null;
    
            if ($request->hasFile('med_content')) {
                $file = $request->file('med_content');
                $originalName = $file->getClientOriginalName();
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = time() . '_' . $originalName;
    
                $destinationPath = public_path('media');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0775, true);
                }
    
                $file->move($destinationPath, $filename);
                $filePath = 'api/media/' . $filename;
    
                // خزّن الرابط دائماً، حتى لو كان txt
                $validated['med_content'] = url($filePath);
            }
    
            $media = Media::create($validated);
    
            return new MediaResource($media->load(['star', 'service']));
        } catch (\Exception $e) {
            Log::error('Error creating media', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'message' => 'Error creating media',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
    public function show($id)
    {
        $media = Media::with(['star', 'service'])->findOrFail($id);
        return new MediaResource($media);
    }

    public function update(Request $request, $id)
    {
        try {
            $media = Media::findOrFail($id);
    
            // Validate the request
            $validated = $request->validate([
                'med_name' => 'sometimes|string|max:255',
                'med_type' => 'sometimes|integer|max:255',
                'med_content' => 'sometimes|file',
                'places_idplaces' => 'sometimes|integer|exists:places,idplaces',
                'cities_idcities' => 'sometimes|integer|exists:cities,idcities',
                'categories_idcategories' => 'sometimes|integer|exists:categories,idcategories',
                'languages_idlanguages' => 'sometimes|integer|exists:languages,idlanguages'
            ]);
    
            // Handle file upload if provided
            if ($request->hasFile('med_content')) {
                // حذف الملف القديم إذا موجود
                if ($media->med_content) {
                    $oldFilename = basename($media->med_content);
                    $oldPath = public_path('media/' . $oldFilename);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
    
                $file = $request->file('med_content');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . Str::random(10) . '.' . $extension;
    
                $destinationPath = public_path('media');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0775, true);
                }
    
                $file->move($destinationPath, $filename);
    
                // Use the new media route
                $validated['med_content'] = url('api/media/' . $filename);
            } else {
                unset($validated['med_content']);
            }
    
            unset($validated['star'], $validated['service']);
    
            $media->update($validated);
    
            return new MediaResource($media);
    
        } catch (\Exception $e) {
            \Log::error('Error updating media', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'message' => 'Error updating media',
                'error' => $e->getMessage()
            ], 500);
        }
    }
   
    public function destroy($id)
    {
        try {
            $media = Media::findOrFail($id);
    
            if ($media->med_content) {
                $filename = basename($media->med_content);
                $filePath = public_path('media/' . $filename);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $media->delete();
            return response()->json(['message' => 'Media deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting media',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function filterByPlaceCityCategoryAndLanguage(Request $request, $placeId, $cityId, $categoryId, $languageId)
    {
        try {
            $perPage = $request->input('per_page'); 
            $page = $request->input('page'); 

            $media = Media::where('places_idplaces', $placeId)
                         ->where('cities_idcities', $cityId)
                         ->where('categories_idcategories', $categoryId)
                         ->where('languages_idlanguages', $languageId)
                         ->with(['place', 'city', 'category', 'language'])
                         ->paginate($perPage, ['*'], 'page', $page);
            
            return MediaResource::collection($media);
        } catch (\Exception $e) {
            Log::error('Error filtering media', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Error filtering media',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
