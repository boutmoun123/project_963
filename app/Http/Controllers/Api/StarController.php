<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Star;
use App\Http\Resources\StarResource;
use App\Http\Requests\StarRequest;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
class StarController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page'); 
        $page = $request->input('page'); 
        
        return StarResource::collection(Star::paginate($perPage, ['*'], 'page', $page));
    }

    public function store(StarRequest $request)
    {
        $service = Service::find($request->services_idservices);
        if (!$service) {
            return response()->json(['message' => 'Service not found.'], 404);
        }
        if ($service->ser_type != 1) {
            return response()->json(['message' => 'You can only create a star for a service with ser_type = 1.'], 403);
        }
        $star = Star::create($request->validated());
        return new StarResource($star);
    }

    public function show($id)
    {
        $star = Star::findOrFail($id);
        return new StarResource($star);
    }

    public function update(StarRequest $request, $id)
    {
        $star = Star::findOrFail($id);
        $star->update($request->validated());
        return new StarResource($star);
    }
    public function destroy($id)
    {
        try {
                $star = Star::findOrFail($id);
                
            // Then delete places (as they depend on cities)
            $star->places()->delete();
            
            $star->delete();
            return response()->json(['message' => 'Star and all related records deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting star', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error deleting star',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function filterByCategoryAndLanguage(Request $request, $categoryId, $languageId, $serviceId, $cityId)
    {
        try {
            $perPage = $request->input('per_page'); 
            $page = $request->input('page'); 

            $stars = Star::where('categories_idcategories', $categoryId)
                         ->where('languages_idlanguages', $languageId)
                         ->where('services_idservices', $serviceId)
                         ->where('cities_idcities', $cityId)
                         ->with(['category', 'language', 'service', 'city'])
                         ->paginate($perPage, ['*'], 'page', $page);
            
            return StarResource::collection($stars);
        } catch (\Exception $e) {
            Log::error('Error filtering cities', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error filtering stars',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
