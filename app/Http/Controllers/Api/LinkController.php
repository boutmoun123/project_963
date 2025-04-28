<?php



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Http\Resources\LinkResource;
use App\Http\Requests\LinkRequest;
use App\Models\Social;

class LinkController extends Controller
{
    public function index()
    {
        return LinkResource::collection(Link::all());
    }
 
    public function store(LinkRequest $request)
    {
        \Log::info('Raw request data:', $request->all());
        
        // Get all request data
        $data = $request->all();
        
        // Validate required fields
        if (!isset($data['languages_idlanguages'])) {
            return response()->json([
                'message' => 'Language ID is required',
                'errors' => [
                    'languages_idlanguages' => ['The language ID field is required.']
                ]
            ], 422);
        }

        if (!isset($data['admin_idadmin'])) {
            return response()->json([
                'message' => 'Admin ID is required',
                'errors' => [
                    'admin_idadmin' => ['The admin ID field is required.']
                ]
            ], 422);
        }

        if (!isset($data['media_idmedia'])) {
            return response()->json([
                'message' => 'Media ID is required',
                'errors' => [
                    'media_idmedia' => ['The media ID field is required.']
                ]
            ], 422);
        }

        try {
            // Create social record if it doesn't exist
            $social = Social::firstOrCreate(
                [
                    'social_name' => 'Default Social',
                    'social_address' => 'https://example.com/social',
                    'languages_idlanguages' => $data['languages_idlanguages'],
                    'admin_idadmin' => $data['admin_idadmin']
                ]
            );

            // Create link record with explicit field assignment
            $link = new Link();
            $link->link_name = $data['link_name'];
            $link->link_http = $data['link_http'];
            $link->languages_idlanguages = $data['languages_idlanguages'];
            $link->admin_idadmin = $data['admin_idadmin'];
            $link->media_idmedia = $data['media_idmedia'];
            $link->socials_idsocials = $social->idsocials;
            $link->save();

            return new LinkResource($link);
        } catch (\Exception $e) {
            \Log::error('Error creating link:', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            
            return response()->json([
                'message' => 'Error creating link record',
                'error' => $e->getMessage()
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
        $link->update($request->validated());
        return new LinkResource($link);
    }

    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();
        return response()->json(['message' => 'Link deleted successfully']);
    }
}
