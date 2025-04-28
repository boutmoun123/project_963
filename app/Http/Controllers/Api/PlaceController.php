<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Http\Resources\PlaceResource;
use App\Http\Requests\PlaceRequest;

class PlaceController extends Controller
{
    public function index()
    {
        return PlaceResource::collection(Place::all());
    }

    public function store(PlaceRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Create place with explicit field assignment
            $place = new Place();
            $place->place_name = $validated['place_name'];
            $place->place_type = $validated['place_type'];
            $place->languages_idlanguages = $validated['languages_idlanguages'];
            $place->admin_idadmin = $validated['admin_idadmin'];
            $place->media_idmedia = $validated['media_idmedia'];
            $place->links_idlinks = $validated['links_idlinks'];
            $place->categories_idcategories = $validated['categories_idcategories'];
            $place->cities_idcities = $validated['cities_idcities'];
            $place->save();

            return new PlaceResource($place);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating place',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);
        return new PlaceResource($place);
    }

    public function update(PlaceRequest $request, $id)
    {
        $place = Place::findOrFail($id);
        $place->update($request->validated());
        return new PlaceResource($place);
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
        return response()->json(['message' => 'Place deleted successfully']);
    }
}

