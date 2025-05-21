<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page'); 
        $page = $request->input('page'); 
        
        return CategoryResource::collection(Category::paginate($perPage, ['*'], 'page', $page));
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'cat_name' => 'required|string|max:255',
                'cat_type' => 'required|integer|max:255',
                'cat_photo' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
                'description' => 'nullable|string',
                'languages_idlanguages' => 'required|integer|exists:languages,idlanguages'
            ]);
    
            // Handle file upload to public/categories
            if ($request->hasFile('cat_photo')) {
                $file = $request->file('cat_photo');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    
                // Create the folder if it doesn't exist
                $destinationPath = public_path('categories');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                // Move the file to public/categories
                $file->move($destinationPath, $filename);
    
                // Save the public URL of the file
                $validated['cat_photo'] = url('categories/' . $filename);
            }

            // Set default description if not provided
            if (!isset($validated['description'])) {
                $validated['description'] = 'A sacred place of worship and spiritual significance, where people gather for religious ceremonies, prayers, and spiritual activities. These areas often feature distinctive architectural elements and cultural heritage that reflect the religious traditions they represent.';
            }
    
            $category = Category::create($validated);
            return new CategoryResource($category);
    
        } catch (\Exception $e) {
            Log::error('Error creating category', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'message' => 'Error creating category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
    
            // Validate the request
            $validated = $request->validate([
                'cat_name' => 'sometimes|string|max:255',
                'cat_type' => 'sometimes|integer|max:255',
                'cat_photo' => 'sometimes|file|mimes:jpeg,png,jpg,gif,mp4,webm|max:1048576',
                'description' => 'required|string',
                'languages_idlanguages' => 'sometimes|integer|exists:languages,idlanguages'
            ]);
    
            // Handle file upload if provided
            if ($request->hasFile('cat_photo')) {
                // Delete old photo if it exists and it's a local file
                if ($category->cat_photo) {
                    $oldFilename = basename($category->cat_photo);
                    $oldFilePath = public_path('categories/' . $oldFilename);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
    
                // Upload new file
                $file = $request->file('cat_photo');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('categories');
    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
    
                $file->move($destinationPath, $filename);
    
                // Store public URL
                $validated['cat_photo'] = url('categories/' . $filename);
            }
    
            $category->update($validated);
            return new CategoryResource($category);
    
        } catch (\Exception $e) {
            Log::error('Error updating category', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'message' => 'Error updating category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            
            // Delete the photo file if exists and is not the default image
            $category = Category::findOrFail($id);

            if ($category->cat_photo && !str_contains($category->cat_photo, 'default.png')) {
                $oldFilename = basename($category->cat_photo); 
                $oldFilePath = public_path('categories/' . $oldFilename); 
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            
            $category->users()->delete();
            $category->ways()->delete();
            $category->services()->delete();
            $category->links()->delete();
            $category->media()->delete();
            $category->places()->delete();
            $category->cities()->delete();
            
            $category->delete();
            return response()->json(['message' => 'Category and all related records deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting category', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error deleting category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function filterByLanguage(Request $request, $languageId)
    {
        $perPage = $request->input('per_page');
        $page = $request->input('page'); 

        $categories = Category::where('languages_idlanguages', $languageId)
                            ->paginate($perPage, ['*'], 'page', $page);
        return CategoryResource::collection($categories);
    }
}
