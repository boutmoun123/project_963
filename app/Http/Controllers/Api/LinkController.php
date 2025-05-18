<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Http\Resources\LinkResource;
use App\Http\Requests\LinkRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 5); // Default to 5 if not specified
            $page = $request->input('page', 1); // Default to page 1 if not specified

            $links = Link::paginate($perPage, ['*'], 'page', $page);
            \Log::info('All links:', $links->toArray());
            return LinkResource::collection($links);
        } catch (\Exception $e) {
            \Log::error('Error fetching links: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error fetching links',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(LinkRequest $request)
    {
        try {
            \Log::info('Raw request data:', $request->all());
            $validated = $request->validated();
            \Log::info('Validated data:', $validated);
            
            // Debug the validated data
            if (!isset($validated['link_type'])) {
                \Log::error('link_type is missing from validated data');
                return response()->json([
                    'message' => 'link_type is missing from validated data',
                    'validated_data' => $validated
                ], 422);
            }
            $link = Link::create($validated);
            \Log::info('Created link:', $link->toArray());
            
            // Debug the created model
            if (!isset($link->link_type)) {
                \Log::error('link_type is missing from created model');
                return response()->json([
                    'message' => 'link_type is missing from created model',
                    'model_data' => $link->toArray()
                ], 422);
            }
            
            // Remove loading of star and service
            // $resource = new LinkResource($link->load(['star', 'service']));
            // $response = $resource->toArray($request);
            
            $resource = new LinkResource($link);
            $response = $resource->toArray($request);
            
            // Debug the resource
            if (!isset($response['link_type'])) {
                \Log::error('link_type is missing from resource');
                return response()->json([
                    'message' => 'link_type is missing from resource',
                    'resource_data' => $response
                ], 422);
            }
            
            return $resource;
        } catch (\Exception $e) {
            \Log::error('Error creating link: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'message' => 'Error creating link',
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ], 500);
        }
    }

    public function show($id)
    {
        $link = Link::findOrFail($id);
        return new LinkResource($link);
    }

    public function update(LinkRequest $request, $id)
    {
        $link = Link::findOrFail($id);
        $validated = $request->validated();
        // Remove star and service from update
        // $validated['stars_idstars'] = $validated['star'] ?? null;
        // $validated['services_idservices'] = $validated['service'] ?? null;
        // unset($validated['star'], $validated['service']);
        $link->update($validated);
        return new LinkResource($link);
    }

    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();
        return response()->json(['message' => 'Link deleted successfully']);
    }

    public function filterByPlaceCityCategoryAndLanguage(Request $request, $placeId, $cityId, $categoryId, $languageId)
    {
        try {
            $perPage = $request->input('per_page', 5); // Default to 5 if not specified
            $page = $request->input('page', 1); // Default to page 1 if not specified

            $links = Link::where('places_idplaces', $placeId)
                        ->where('cities_idcities', $cityId)
                        ->where('categories_idcategories', $categoryId)
                        ->where('languages_idlanguages', $languageId)
                        ->with(['place', 'city', 'category', 'language'])
                        ->paginate($perPage, ['*'], 'page', $page);
            
            return LinkResource::collection($links);
        } catch (\Exception $e) {
            Log::error('Error filtering links', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error filtering links',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
