<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Way;
use App\Http\Resources\WayResource;
use App\Http\Requests\WayRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WayController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page'); 
        $page = $request->input('page'); 
        
        return WayResource::collection(Way::paginate($perPage, ['*'], 'page', $page));
    }

    public function store(WayRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Debug the validated data
            \Log::info('Validated data:', $validated);
            
            
            // Create the way with validated data
            $way = Way::create($validated);
            
            return new WayResource($way);
        } catch (\Exception $e) {
            \Log::error('Error creating way: ' . $e->getMessage());
            \Log::error('Request data:', $request->all());
            return response()->json([
                'message' => 'Error creating way',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $way = Way::findOrFail($id);
        return new WayResource($way);
    }

    public function update(WayRequest $request, $id)
    {
        $way = Way::findOrFail($id);
        $validated = $request->validated();
        $way->update($validated);
        return new WayResource($way);
    }

    public function destroy($id)
    {
        $way = Way::findOrFail($id);
        $way->users()->delete();
        $way->delete();
        return response()->json(['message' => 'Way and all related records deleted successfully']);
    }

    public function filterByPlaceCityCategoryAndLanguage(Request $request, $placeId, $cityId, $categoryId, $languageId)
    {
        try {
            $perPage = $request->input('per_page'); 
            $page = $request->input('page'); 

            $ways = Way::where('places_idplaces', $placeId)
                      ->where('cities_idcities', $cityId)
                      ->where('categories_idcategories', $categoryId)
                      ->where('languages_idlanguages', $languageId)
                      ->with(['place', 'city', 'category', 'language'])
                      ->paginate($perPage, ['*'], 'page', $page);
            
            return WayResource::collection($ways);
        } catch (\Exception $e) {
            Log::error('Error filtering ways', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error filtering ways',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
