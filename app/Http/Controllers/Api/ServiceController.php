<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Resources\ServiceResource;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        return ServiceResource::collection(Service::with('category')->get());
    }

    public function store(ServiceRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Create service with explicit field assignment
            $service = new Service();
            $service->ser_name = $validated['ser_name'];
            $service->languages_idlanguages = $validated['languages_idlanguages'];
            $service->admin_idadmin = $validated['admin_idadmin'];
            $service->media_idmedia = $validated['media_idmedia'];
            $service->links_idlinks = $validated['links_idlinks'];
            $service->places_idplaces = $validated['places_idplaces'];
            $service->cities_idcities = $validated['cities_idcities'];
            $service->categories_idcategories = $validated['categories_idcategories'];
            $service->save();

            return new ServiceResource($service->load('category'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $service = Service::with('category')->findOrFail($id);
        return new ServiceResource($service);
    }

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());
        return new ServiceResource($service->load('category'));
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(['message' => 'Service deleted successfully']);
    }
}

