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
        $perPage = $request->input('per_page', 5); // Default to 5 if not specified
        $page = $request->input('page', 1); // Default to page 1 if not specified
        
        return MediaResource::collection(Media::with(['star', 'service'])->paginate($perPage, ['*'], 'page', $page));
    }

    public function store(MediaRequest $request)
    {
        try {
            $validated = $request->validated();
    
            // ربط المفتاحين مع الأعمدة المناسبة في الجدول
            $validated['stars_idstars'] = $validated['star'] ?? null;
            $validated['services_idservices'] = $validated['service'] ?? null;
    
            // رفع الملف وتخزينه في public/media
            if ($request->hasFile('med_content')) {
                $file = $request->file('med_content');
                $filename = time() . '_' . $file->getClientOriginalName();
    
                $destinationPath = public_path('media');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0775, true);
                }
    
                $file->move($destinationPath, $filename);
    
                // حفظ الرابط المباشر للعرض على الويب
                $validated['med_content'] = asset('media/' . $filename);
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
                'med_content' => 'sometimes|file',  // تأكد أن نوع الحقل ملف عند رفع صورة/فيديو
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
    
                // حفظ رابط الوصول المباشر للملف
                $validated['med_content'] = asset('media/' . $filename);
            } else {
                // إذا لم يتم رفع ملف جديد، لا تغير الحقل
                unset($validated['med_content']);
            }
    
            // إزالة أي حقول غير موجودة في الجدول
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
            $perPage = $request->input('per_page', 5); // Default to 5 if not specified
            $page = $request->input('page', 1); // Default to page 1 if not specified

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
