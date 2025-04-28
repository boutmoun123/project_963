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
        $language = Language::create($request->validated());
        return new LanguageResource($language);
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
        $language = Language::findOrFail($id);
        $language->delete();
        return response()->json(['message' => 'Language deleted successfully']);
    }
}