<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\WayController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\StarController;
use App\Http\Controllers\Api\DeviceLogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return ' السيرفر شغّال!';
});

// Contact admin route
Route::post('contact-admin', [ContactController::class, 'sendMessage']);

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::post('login', [AdminController::class, 'login']);
    Route::post('change-password/{id}', [AdminController::class, 'changePassword']);
    Route::get('admins', [AdminController::class, 'index']);
    Route::post('admins', [AdminController::class, 'store']);
    Route::get('admins/{admin}', [AdminController::class, 'show']);
    Route::put('admins/{admin}', [AdminController::class, 'update']);
    Route::delete('admins/{admin}', [AdminController::class, 'destroy']);
    // Languages Routes
    Route::prefix('language')->group(function () {
        Route::get('languages', [LanguageController::class, 'index']);
        Route::post('languages', [LanguageController::class, 'store']);
        Route::get('languages/{language}', [LanguageController::class, 'show']);
        Route::put('languages/{language}', [LanguageController::class, 'update']);
        Route::delete('languages/{language}', [LanguageController::class, 'destroy']);
    });

    // Categories Routes
    Route::prefix('category')->group(function () {
        Route::get('categories', [CategoryController::class, 'index']);
        Route::post('categories', [CategoryController::class, 'store']);
        Route::get('categories/{category}', [CategoryController::class, 'show']);
        Route::post('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
    });
    Route::prefix('city')->group(function () {
        Route::get('cities', [CityController::class, 'index']);
        Route::post('cities', [CityController::class, 'store']);
        Route::get('cities/{city}', [CityController::class, 'show']);
        Route::post('cities/{city}', [CityController::class, 'update']);
        Route::delete('cities/{city}', [CityController::class, 'destroy']);
    });
    // Places Routes
    Route::prefix('place')->group(function () {
        Route::get('places', [PlaceController::class, 'index']);
        Route::post('places', [PlaceController::class, 'store']);
        Route::get('places/{place}', [PlaceController::class, 'show']);
        Route::post('places/search', [PlaceController::class, 'search']);
        Route::post('places/{place}', [PlaceController::class, 'update']);
        Route::delete('places/{place}', [PlaceController::class, 'destroy']);
    });
    // Services Routes
    Route::prefix('service')->group(function () {
        Route::get('services', [ServiceController::class, 'index']);
        Route::post('services', [ServiceController::class, 'store']);
        Route::get('services/{service}', [ServiceController::class, 'show']);
        Route::post('services/{service}', [ServiceController::class, 'update']);
        Route::delete('services/{service}', [ServiceController::class, 'destroy']);
    });
        // Media Routes
        Route::prefix('media')->group(function () {
            Route::get('media', [MediaController::class, 'index']);
            Route::post('media', [MediaController::class, 'store']);
            Route::get('media/{media}', [MediaController::class, 'show']);
            Route::post('media/{media}', [MediaController::class, 'update']);
            Route::delete('media/{media}', [MediaController::class, 'destroy']);
        });
       // Links Routes
       Route::prefix('link')->group(function () {
        Route::get('links', [LinkController::class, 'index']);
        Route::post('links', [LinkController::class, 'store']);
        Route::get('links/{link}', [LinkController::class, 'show']);
        Route::post('links/{link}', [LinkController::class, 'update']);
        Route::delete('links/{link}', [LinkController::class, 'destroy']);
    });
    // Ways Routes
    Route::prefix('way')->group(function () {
        Route::get('ways', [WayController::class, 'index']);
        Route::post('ways', [WayController::class, 'store']);
        Route::get('ways/{way}', [WayController::class, 'show']);
        Route::post('ways/{way}', [WayController::class, 'update']);
        Route::delete('ways/{way}', [WayController::class, 'destroy']);
    });
    // Cities Routes
    Route::prefix('star')->group(function () {
        Route::get('stars', [StarController::class, 'index']);
        Route::post('stars', [StarController::class, 'store']);
        Route::get('stars/{star}', [StarController::class, 'show']);
        Route::post('stars/{star}', [StarController::class, 'update']);
        Route::delete('stars/{star}', [StarController::class, 'destroy']);
    });
    Route::prefix('device')->group(function () {
        Route::get('logs', [DeviceLogController::class, 'index']);
        Route::get('logs/{id}', [DeviceLogController::class, 'show']);
        Route::delete('logs/{id}', [DeviceLogController::class, 'destroy']);
        Route::delete('logs', [DeviceLogController::class, 'destroyAll']);
        
    });
});
// User-specific routes
Route::prefix('user')->group(function () {

    Route::prefix('language1')->group(function () {
        Route::get('languages', [LanguageController::class, 'index']);
        Route::get('languages/{language}', [LanguageController::class, 'show']);
    });
    Route::prefix('category1')->group(function () {
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{category}', [CategoryController::class, 'show']);
        Route::get('category/language/{languageId}', [CategoryController::class, 'filterByLanguage']);
    });
    Route::prefix('city1')->group(function () {
        Route::get('cities', [CityController::class, 'index']);
        Route::get('cities/{city}', [CityController::class, 'show']);
        Route::get('cities/category/{categoryId}/language/{languageId}', [CityController::class, 'filterByCategoryAndLanguage']);
    });

    Route::prefix('place1')->group(function () {
        Route::get('places', [PlaceController::class, 'index']);
        Route::get('places/{place}', [PlaceController::class, 'show']);
        Route::post('search', [PlaceController::class, 'search']);
        Route::get('places/city/{cityId}/category/{categoryId}/language/{languageId}', [PlaceController::class, 'filterByNullStarAndService']);
        Route::get('places/city/{cityId}/category/{categoryId}/language/{languageId}/service/{serviceId}', [PlaceController::class, 'filterByCityCategoryAndLanguageService']);
        Route::get('places/city/{cityId}/category/{categoryId}/language/{languageId}/service/{serviceId}/star/{starId}', [PlaceController::class, 'filterByCityCategoryAndLanguageServiceStar']);
        Route::get('places/category/{categoryId}/language/{languageId}', [PlaceController::class, 'filterByCategoryAndlanguage']);

    });

    Route::prefix('service1')->group(function () {
        Route::get('services', [ServiceController::class, 'index']);
        Route::get('services/{service}', [ServiceController::class, 'show']);
        Route::get('services/city/{cityId}/category/{categoryId}/language/{languageId}', [ServiceController::class, 'filterByCityCategoryAndLanguage']);
    });
    Route::prefix('media1')->group(function () {
        Route::get('media', [MediaController::class, 'index']);
        Route::get('media/{media}', [MediaController::class, 'show']);
        Route::get('media/place/{placeId}/city/{cityId}/category/{categoryId}/language/{languageId}', [MediaController::class, 'filterByPlaceCityCategoryAndLanguage']);
    });
    Route::prefix('link1')->group(function () {
        Route::get('links', [LinkController::class, 'index']);
        Route::get('links/{link}', [LinkController::class, 'show']);
        Route::get('links/place/{placeId}/city/{cityId}/category/{categoryId}/language/{languageId}', [LinkController::class, 'filterByPlaceCityCategoryAndLanguage']);
    });

    Route::prefix('way1')->group(function () {
        Route::get('ways', [WayController::class, 'index']);
        Route::get('ways/{way}', [WayController::class, 'show']);
        Route::get('ways/place/{placeId}/city/{cityId}/category/{categoryId}/language/{languageId}', [WayController::class, 'filterByPlaceCityCategoryAndLanguage']);
    });
        
    Route::prefix('star1')->group(function () {
        Route::get('star', [StarController::class, 'index']);
        Route::get('star/{star}', [StarController::class, 'show']);
        Route::get('star/service/{serviceId}/city/{cityId}/category/{categoryId}/language/{languageId}', [StarController::class, 'filterByCategoryAndLanguage']);
    });

    Route::prefix('device')->group(function () {
        Route::post('store', [DeviceLogController::class, 'store']);
    });
});


// // Categories
// Route::apiResource('categories', CategoryController::class);

// // Users
// Route::apiResource('users', UserController::class);

// // Admins
// Route::apiResource('admins', AdminController::class);

// // Socials
// Route::apiResource('socials', SocialController::class);

// // Media
// Route::apiResource('media', MediaController::class);

// // Places
// Route::apiResource('places', PlaceController::class);

// // Services
// Route::apiResource('services', ServiceController::class);

// // Ways
// Route::apiResource('ways', WayController::class);

// // Cities
// Route::apiResource('cities', CityController::class);

// // Links
// Route::apiResource('links', LinkController::class);

// // Languages
// Route::apiResource('languages', LanguageController::class); -->

    // Users Routes
    // Route::prefix('user')->group(function () {
    //     Route::get('users', [UserController::class, 'index']);
    //     Route::post('users', [UserController::class, 'store']);
    //     Route::get('users/{user}', [UserController::class, 'show']);
    //     Route::put('users/{user}', [UserController::class, 'update']);
    //     Route::delete('users/{user}', [UserController::class, 'destroy']);
    // });

    // Socials Routes
    // Route::prefix('social')->group(function () {
    //     Route::get('socials', [SocialController::class, 'index']);
    //     Route::post('socials', [SocialController::class, 'store']);
    //     Route::get('socials/{social}', [SocialController::class, 'show']);
    //     Route::put('socials/{social}', [SocialController::class, 'update']);
    //     Route::delete('socials/{social}', [SocialController::class, 'destroy']);
    // });
