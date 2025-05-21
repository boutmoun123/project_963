<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\PlaceCollection;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Place::query();

            // Debug the request
            Log::info('Search request received', [
                'name' => $request->name,
                'all_params' => $request->all()
            ]);

            // Search by place name
            if ($request->has('name') && !empty($request->name)) {
                $searchTerm = $request->name;
                $query->where('place_name', 'like', '%' . $searchTerm . '%');
                
                // Debug the SQL query
                Log::info('Search query', [
                    'sql' => $query->toSql(),
                    'bindings' => $query->getBindings()
                ]);
            }

            if ($request->has('type') && !empty($request->type)) {
                $query->where('place_type', $request->type);
            }

            if ($request->has('category') && !empty($request->category)) {
                $query->where('categories_idcategories', $request->category);
            }

            if ($request->has('city') && !empty($request->city)) {
                $query->where('cities_idcities', $request->city);
            }

            if ($request->has('star')) {
                $query->where('stars_idstars', $request->star);
            }
            if ($request->has('service')) {
                $query->where('services_idservices', $request->service);
            }

            // Load all relationships
            $query->with([
                'language',
                'category',
                'city',
                'star',
                'service'
            
            ]);

            // Order by
            if ($request->has('order_by')) {
                $query->orderBy($request->order_by, $request->order_direction ?? 'asc');
            }

            $perPage = $request->input('per_page'); // Default to 10 if not specified
            $page = $request->input('page'); // Default to page 1 if not specified

            $places = $query->paginate($perPage, ['*'], 'page', $page);
            return new PlaceCollection($places);
        } catch (\Exception $e) {
            Log::error('Error searching places', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error searching places',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = Place::query();

            $starIsNull = $request->has('star') && ($request->star === '0' || $request->star === 0);
            $serviceIsNull = $request->has('service') && ($request->service === '0' || $request->service === 0);

            if ($starIsNull && $serviceIsNull) {
                $query->whereNull('stars_idstars')->whereNull('services_idservices');
            } elseif ($starIsNull) {
                $query->whereNull('stars_idstars');
            } elseif ($serviceIsNull) {
                $query->whereNull('services_idservices');
            } else {
                if ($request->has('star')) {
                    $query->where('stars_idstars', $request->star);
                }
                if ($request->has('service')) {
                    $query->where('services_idservices', $request->service);
                }
            }

            if ($request->has('name')) {
                $query->where('place_name', 'like', '%' . $request->name . '%');
            }
            if ($request->has('type')) {
                $query->where('place_type', $request->type);
            }
            if ($request->has('category')) {
                $query->where('categories_idcategories', $request->category);
            }
            if ($request->has('city')) {
                $query->where('cities_idcities', $request->city);
            }
            if ($request->has('language')) {
                $query->where('languages_idlanguages', $request->language);
            }
         
            $query->with([
                'language',
                'category',
                'city',
                'star',
                'service'
               
            ]);

            $perPage = $request->input('per_page', 5); // Default to 10 if not specified
            $page = $request->input('page', 1); // Default to page 1 if not specified

            $places = $query->paginate($perPage, ['*'], 'page', $page);
            return new PlaceCollection($places);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error searching places',
                'error' => $e->getMessage()
            ], 500);
        }
    }


  

    public function store(PlaceRequest $request)
    {
        try {
            // 1. استلم البيانات المفلترة
            $validated = $request->validated();
    
            // 2. سجل البيانات في اللوج للتحقّق
            \Log::info('VALIDATED DATA:', $validated);
    
            // 3. خريطة star & service
            $validated['stars_idstars']     = $validated['star']    ?? null;
            $validated['services_idservices'] = $validated['service'] ?? null;
    
            // 4. ضبط date_created بصيغة Y-m-d
            if (!empty($validated['date_created'])) {
                $validated['date_created'] = Carbon::parse($validated['date_created'])
                                                  ->toDateString();
            } else {
                $validated['date_created'] = now()->toDateString();
            }
    
            // 5. معالجة رفع الصورة إن وجدت
            if ($request->hasFile('place_photo')) {
                $file     = $request->file('place_photo');
                $name     = time() . '_' . $file->getClientOriginalName();
                $dest     = public_path('places');
                if (!file_exists($dest)) {
                    mkdir($dest, 0755, true);
                }
                $file->move($dest, $name);
                $validated['photo'] = url('places/' . $name);
            }
    
            // 6. أنشئ السجل
            $place = Place::create($validated);
    
            // 7. أعد الـ Resource
            return new PlaceResource($place->load(['star', 'service']));
        } catch (\Exception $e) {
            \Log::error('Error creating place', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'message' => 'Error creating place',
                'error'   => $e->getMessage(),
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
    try {
        $place = Place::findOrFail($id);
        $validated = $request->validated();
        
        // Map 'star' and 'service' to the correct DB columns
        $validated['stars_idstars'] = $validated['star'] ?? null;
        $validated['services_idservices'] = $validated['service'] ?? null;

        // Set date_created to current timestamp if not provided

        // Handle file upload if provided
        if ($request->hasFile('photo') || $request->hasFile('place_photo')) {
            // Check if there is an existing photo and delete it
            if ($place->photo && !str_contains($place->photo, 'default.png')) {
                $oldFilename = basename($place->photo);
                $oldFilePath = public_path('places/' . $oldFilename);

                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Upload new photo - check both field names
            $file = $request->hasFile('photo') ? $request->file('photo') : $request->file('place_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('places');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the file to the places directory
            $file->move($destinationPath, $filename);
            $validated['photo'] = url('places/' . $filename);
        }

        // Update the place record
        $place->update($validated);

        return new PlaceResource($place->load(['star', 'service']));
    } catch (\Exception $e) {
        Log::error('Error updating place', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'message' => 'Error updating place',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function destroy($id)
    {
        try {
            $place = place::findOrFail($id);
    
            // Delete the photo file if exists
            if ($place->photo && !str_contains($place->photo, 'default.png')) {
                $oldFilename = basename($place->photo); 
                $oldFilePath = public_path('places/' . $oldFilename);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); 
                }
            }
       
        // Then delete ways (as they depend on services)
        $place->ways()->delete();
        
        // Then delete links (as they depend on languages)
        $place->links()->delete();
        
        // Then delete media (as they depend on languages)
        $place->media()->delete();

        $place->delete();

        return response()->json(['message' => 'Place and all related records deleted successfully']);
    } catch (\Exception $e) {
        Log::error('Error deleting place', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'message' => 'Error deleting place',
            'error' => $e->getMessage()
        ], 500);
    }
    }

 public function filterByNullStarAndService(Request $request , $cityId, $categoryId, $languageId )
{
    $perPage = $request->input('per_page'); // Default to 10 if not specified
    $page = $request->input('page'); // Default to page 1 if not specified

    $places = Place::whereNull('stars_idstars')
                   ->whereNull('services_idservices')
                   ->where('languages_idlanguages', $languageId)
                   ->where('categories_idcategories', $categoryId)
                   ->where('cities_idcities', $cityId)
                   ->with(['language', 'category', 'city'])
                   ->orderBy('date_created', 'desc')  
                   ->paginate($perPage, ['*'], 'page', $page);

    return new PlaceCollection($places);
}

public function filterByCityCategoryAndLanguageServiceStar(Request $request, $cityId, $categoryId, $languageId, $serviceId, $starId)
{
    try {
        $perPage = $request->input('per_page'); 
        $page = $request->input('page'); 

        $places = Place::where('stars_idstars', $starId)
            ->where('cities_idcities', $cityId)
            ->where('categories_idcategories', $categoryId)
            ->where('languages_idlanguages', $languageId)
            ->where('services_idservices', $serviceId)
            ->with(['city', 'category', 'language', 'service', 'star'])
            ->orderBy('date_created', 'desc')  
            ->paginate($perPage, ['*'], 'page', $page);

        return PlaceResource::collection($places);
    } catch (\Exception $e) {
        \Log::error('Error filtering places', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'message' => 'Error filtering places',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function filterByCityCategoryAndLanguageService(Request $request, $cityId, $categoryId, $languageId, $serviceId)
{
    try {
        $perPage = $request->input('per_page'); 
        $page = $request->input('page'); 

        $places = Place::where('cities_idcities', $cityId)
            ->where('categories_idcategories', $categoryId)
            ->where('languages_idlanguages', $languageId)
            ->where('services_idservices', $serviceId)
            ->with(['city', 'category', 'language', 'service'])
            ->orderBy('date_created', 'desc')  
            ->paginate($perPage, ['*'], 'page', $page);

        return PlaceResource::collection($places);
    } catch (\Exception $e) {
        \Log::error('Error filtering places', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'message' => 'Error filtering places',
            'error' => $e->getMessage()
        ], 500);
    }
}
    public function star()
    {
        return $this->belongsTo(Star::class, 'stars_idstars');
    }
 
    public function services()
    {
        return $this->hasMany(\App\Models\Service::class, 'places_idplaces');
    }

}

