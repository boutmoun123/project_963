<?php



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Http\Resources\MediaResource;
use App\Http\Requests\MediaRequest;

class MediaController extends Controller
{
    public function index()
    {
        return MediaResource::collection(Media::all());
    }

    public function store(MediaRequest $request)
    {
        \Log::info('Raw request data:', $request->all());
        
        // Get all request data
        $data = $request->all();
        
        // Validate required fields
        if (!isset($data['admin_idadmin'])) {
            return response()->json([
                'message' => 'Admin ID is required',
                'errors' => [
                    'admin_idadmin' => ['The admin ID field is required.']
                ]
            ], 422);
        }

        if (!isset($data['languages_idlanguages'])) {
            return response()->json([
                'message' => 'Language ID is required',
                'errors' => [
                    'languages_idlanguages' => ['The language ID field is required.']
                ]
            ], 422);
        }

        try {
            // Create media record with explicit field assignment
            $media = new Media();
            $media->med_name = $data['med_name'];
            $media->med_type = $data['med_type'];
            $media->med_content = $data['med_content'];
            $media->languages_idlanguages = $data['languages_idlanguages'];
            $media->admin_idadmin = $data['admin_idadmin'];
            $media->save();

            return new MediaResource($media);
        } catch (\Exception $e) {
            \Log::error('Error creating media:', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            return response()->json([
                'message' => 'Error creating media record',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $media = Media::findOrFail($id);
        return new MediaResource($media);
    }

    public function update(MediaRequest $request, $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->validated());
        return new MediaResource($media);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();
        return response()->json(['message' => 'Media deleted successfully']);
    }
}
