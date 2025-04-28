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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return ' السيرفر شغّال!';
});

// Contact admin route
Route::post('contact-admin', [UserController::class, 'contactAdmin']);

// Admin Routes
Route::prefix('admin')->group(function () {
    // Authentication routes
    Route::post('login', [AdminController::class, 'login']);
    Route::post('change-password/{id}', [AdminController::class, 'changePassword']);
    
    // Admin management routes
    Route::get('admins', [AdminController::class, 'index']);
    Route::post('admins', [AdminController::class, 'store']);
    Route::get('admins/{admin}', [AdminController::class, 'show']);
    Route::put('admins/{admin}', [AdminController::class, 'update']);
    Route::delete('admins/{admin}', [AdminController::class, 'destroy']);

    // Categories Routes
    Route::prefix('category')->group(function () {
        Route::get('categories', [CategoryController::class, 'index']);
        Route::post('categories', [CategoryController::class, 'store']);
        Route::get('categories/{category}', [CategoryController::class, 'show']);
        Route::put('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
    });

    // Users Routes
    Route::prefix('user')->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/{user}', [UserController::class, 'show']);
        Route::put('users/{user}', [UserController::class, 'update']);
        Route::delete('users/{user}', [UserController::class, 'destroy']);
    });

    // Socials Routes
    Route::prefix('social')->group(function () {
        Route::get('socials', [SocialController::class, 'index']);
        Route::post('socials', [SocialController::class, 'store']);
        Route::get('socials/{social}', [SocialController::class, 'show']);
        Route::put('socials/{social}', [SocialController::class, 'update']);
        Route::delete('socials/{social}', [SocialController::class, 'destroy']);
    });

    // Media Routes
    Route::prefix('media')->group(function () {
        Route::get('media', [MediaController::class, 'index']);
        Route::post('media', [MediaController::class, 'store']);
        Route::get('media/{media}', [MediaController::class, 'show']);
        Route::put('media/{media}', [MediaController::class, 'update']);
        Route::delete('media/{media}', [MediaController::class, 'destroy']);
    });

    // Places Routes
    Route::prefix('place')->group(function () {
        Route::get('places', [PlaceController::class, 'index']);
        Route::post('places', [PlaceController::class, 'store']);
        Route::get('places/{place}', [PlaceController::class, 'show']);
        Route::put('places/{place}', [PlaceController::class, 'update']);
        Route::delete('places/{place}', [PlaceController::class, 'destroy']);
    });

    // Services Routes
    Route::prefix('service')->group(function () {
        Route::get('services', [ServiceController::class, 'index']);
        Route::post('services', [ServiceController::class, 'store']);
        Route::get('services/{service}', [ServiceController::class, 'show']);
        Route::put('services/{service}', [ServiceController::class, 'update']);
        Route::delete('services/{service}', [ServiceController::class, 'destroy']);
    });

    // Ways Routes
    Route::prefix('way')->group(function () {
        Route::get('ways', [WayController::class, 'index']);
        Route::post('ways', [WayController::class, 'store']);
        Route::get('ways/{way}', [WayController::class, 'show']);
        Route::put('ways/{way}', [WayController::class, 'update']);
        Route::delete('ways/{way}', [WayController::class, 'destroy']);
    });

    // Cities Routes
    Route::prefix('city')->group(function () {
        Route::get('cities', [CityController::class, 'index']);
        Route::post('cities', [CityController::class, 'store']);
        Route::get('cities/{city}', [CityController::class, 'show']);
        Route::put('cities/{city}', [CityController::class, 'update']);
        Route::delete('cities/{city}', [CityController::class, 'destroy']);
    });

    // Links Routes
    Route::prefix('link')->group(function () {
        Route::get('links', [LinkController::class, 'index']);
        Route::post('links', [LinkController::class, 'store']);
        Route::get('links/{link}', [LinkController::class, 'show']);
        Route::put('links/{link}', [LinkController::class, 'update']);
        Route::delete('links/{link}', [LinkController::class, 'destroy']);
    });

    // Languages Routes
    Route::prefix('language')->group(function () {
        Route::get('languages', [LanguageController::class, 'index']);
        Route::post('languages', [LanguageController::class, 'store']);
        Route::get('languages/{language}', [LanguageController::class, 'show']);
        Route::put('languages/{language}', [LanguageController::class, 'update']);
        Route::delete('languages/{language}', [LanguageController::class, 'destroy']);
    });
});

// User-specific routes
Route::prefix('user')->group(function () {
    Route::prefix('category1')->group(function () {
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{category}', [CategoryController::class, 'show']);
    });

    Route::prefix('user1')->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::get('users/{user}', [UserController::class, 'show']);
        Route::post('send-email-to-admin/{adminId}', [UserController::class, 'sendEmailToAdmin']);
    });

    Route::prefix('admin1')->group(function () {
        Route::get('admins', [AdminController::class, 'index']);
        Route::get('admins/{admin}', [AdminController::class, 'show']);
    });

    Route::prefix('social1')->group(function () {
        Route::get('socials', [SocialController::class, 'index']);
        Route::get('socials/{social}', [SocialController::class, 'show']);
    });

    Route::prefix('media1')->group(function () {
        Route::get('media', [MediaController::class, 'index']);
        Route::get('media/{media}', [MediaController::class, 'show']);
    });

    Route::prefix('place1')->group(function () {
        Route::get('places', [PlaceController::class, 'index']);
        Route::get('places/{place}', [PlaceController::class, 'show']);
    });

    Route::prefix('service1')->group(function () {
        Route::get('services', [ServiceController::class, 'index']);
        Route::get('services/{service}', [ServiceController::class, 'show']);
    });

    Route::prefix('way1')->group(function () {
        Route::get('ways', [WayController::class, 'index']);
        Route::get('ways/{way}', [WayController::class, 'show']);
    });

    Route::prefix('city1')->group(function () {
        Route::get('cities', [CityController::class, 'index']);
        Route::get('cities/{city}', [CityController::class, 'show']);
    });

    Route::prefix('link1')->group(function () {
        Route::get('links', [LinkController::class, 'index']);
        Route::get('links/{link}', [LinkController::class, 'show']);
    });

    Route::prefix('language1')->group(function () {
        Route::get('languages', [LanguageController::class, 'index']);
        Route::get('languages/{language}', [LanguageController::class, 'show']);
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
