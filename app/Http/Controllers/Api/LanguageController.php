<?php



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Http\Resources\LanguageResource;
use App\Http\Requests\LanguageRequest;

class LanguageController extends Controller
{
    public function index()
    {
        return LanguageResource::collection(Language::all());
    }
 
    public function store(LanguageRequest $request)
    {
        try {
            \Log::info('Attempting to create language with data:', $request->all());
            
            $validated = $request->validated();
            \Log::info('Validated data:', $validated);
            
            $language = Language::create($validated);
            \Log::info('Language created successfully:', ['id' => $language->idlanguages]);
            
            return new LanguageResource($language);
        } catch (\Exception $e) {
            \Log::error('Error creating language: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('Request data:', $request->all());
            
            return response()->json([
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ], 500);
        }
    }

    public function show($id)
    {
        $language = Language::findOrFail($id);
        return new LanguageResource($language);
    }

    public function update(LanguageRequest $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->validated());
        return new LanguageResource($language);
    }


    public function destroy($id)
    {
        $Language = Language::findOrFail($id);
        
        // Delete in the correct order to respect foreign key constraints
        // First delete users (as they depend on ways)
        $Language->users()->delete();
        // Then delete ways (as they depend on services)
        $Language->ways()->delete();
        
        // Then delete services (as they depend on places)
        $Language->services()->delete();
        
       
        // Then delete links (as they depend on languages)
        $Language->links()->delete();
        
        // Then delete media (as they depend on languages)
        $Language->media()->delete();
 // Then delete places (as they depend on cities)
        $Language->places()->delete();
        
        // Then delete cities (as they depend on categories)
        $Language->cities()->delete();
        
        // Then delete categories (as they're referenced by cities)
        $Language->categories()->delete();
        
        // Then delete socials (as they depend on languages)
      //  $Language->socials()->delete();
        
        // Then delete languages
        $Language->delete();
    
        return response()->json(['message' => 'Language and all related records deleted successfully']);
    }
}