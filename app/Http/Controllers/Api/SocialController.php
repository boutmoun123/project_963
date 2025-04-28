<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Http\Resources\SocialResource;
use App\Models\Social;

class SocialController extends Controller
{
    public function index()
    {
        // Return all records using Resource to transform the data
        return SocialResource::collection(Social::all());
    }

    public function store(SocialRequest $request)
    {
        // Validate data using SocialRequest
        $social = Social::create($request->validated());

        // Return the response using SocialResource
        return new SocialResource($social);
    }

    public function show($id)
    {
        $social = Social::findOrFail($id);

        return new SocialResource($social);
    }

    public function update(SocialRequest $request, $id)
    {
        $social = Social::findOrFail($id);
        $social->update($request->validated());

        return new SocialResource($social);
    }

    public function destroy($id)
    {
        $social = Social::findOrFail($id);
        $social->delete();

        return response()->json(['message' => 'Social deleted successfully']);
    }
}
