<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Way;
use App\Http\Resources\WayResource;
use App\Http\Requests\WayRequest;
use Illuminate\Http\Request;

class WayController extends Controller
{
    public function index()
    {
        return WayResource::collection(Way::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        // Set default values for required fields if not provided
        $data['horizontal'] = $data['horizontal'] ?? 0;
        $data['vertical'] = $data['vertical'] ?? 0;
        $data['way_add'] = $data['way_add'] ?? '';
        $data['address'] = $data['address'] ?? '';  // Set default empty string for address
        $data['admin_idadmin'] = $data['admin_idadmin'] ?? 1;
        $data['languages_idlanguages'] = $data['languages_idlanguages'] ?? 1;
        $data['socials_idsocials'] = $data['socials_idsocials'] ?? 1;
        $data['places_idplaces'] = $data['places_idplaces'] ?? 1;
        $data['services_idservices'] = $data['services_idservices'] ?? 1;
        $data['links_idlinks'] = $data['links_idlinks'] ?? 1;
        
        // Create the way with the data
        $way = Way::create($data);
        return new WayResource($way);
    }

    public function show($id)
    {
        $way = Way::findOrFail($id);
        return new WayResource($way);
    }

    public function update(WayRequest $request, $id)
    {
        $way = Way::findOrFail($id);
        $way->update($request->validated());
        return new WayResource($way);
    }

    public function destroy($id)
    {
        $way = Way::findOrFail($id);
        $way->delete();
        return response()->json(['message' => 'Way deleted successfully']);
    }
}
