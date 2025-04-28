<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(Request $request)
    {
        // Log the incoming request data
        \Log::info('Category creation request data:', $request->all());
        
        try {
            $validated = $request->validate([
                'cat_name' => 'required|string|max:255',
                'cat_type' => 'required|integer|max:255',
                'admin_idadmin' => 'required|exists:admins,idadmin',
                'languages_idlanguages' => 'required|exists:languages,idlanguages',
                'media_idmedia' => 'required|exists:media,idmedia',
                'links_idlinks' => 'required|exists:links,idlinks',
            ]);

            \Log::info('Validated data:', $validated);

            // Create category with explicit field assignment
            $category = new Category();
            $category->cat_name = $validated['cat_name'];
            $category->cat_type = $validated['cat_type'];
            $category->admin_idadmin = $validated['admin_idadmin'];
            $category->languages_idlanguages = $validated['languages_idlanguages'];
            $category->media_idmedia = $validated['media_idmedia'];
            $category->links_idlinks = $validated['links_idlinks'];
            $category->save();

            return new CategoryResource($category);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error:', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error creating category:', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
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
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'cat_name' => 'sometimes|string|max:255',
            'cat_type' => 'sometimes|integer|max:255',
        ]);

        $category->update($validated);

        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
            'id' => $id,
        ], 200);
    }
}
