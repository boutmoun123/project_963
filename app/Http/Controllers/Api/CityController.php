<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Http\Resources\CityResource;
use App\Http\Requests\CityRequest;

class CityController extends Controller
{
    public function index()
    {
        return CityResource::collection(City::all());
    }

    public function store(CityRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Create city with explicit field assignment
            $city = new City();
            $city->city_name = $validated['city_name'];
            $city->languages_idlanguages = $validated['languages_idlanguages'];
            $city->admin_idadmin = $validated['admin_idadmin'];
            $city->media_idmedia = $validated['media_idmedia'];
            $city->links_idlinks = $validated['links_idlinks'];
            $city->categories_idcategories = $validated['categories_idcategories'];
            $city->save();

            return new CityResource($city);
        } catch (\Exception $e) {
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

    public function update(CityRequest $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->validated());
        return new CityResource($city);
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(['message' => 'City deleted successfully']);
    }
}
