<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthAction;
use App\Http\Controllers\Api\FrontendAction;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return 'liza';
})->middleware('auth:sanctum');
    // Customer Auth
Route::prefix('customer')->group(function () {
    Route::post('sign-up', [AuthAction::class, 'registration']);
    Route::post('sign-in', [AuthAction::class, 'login']); 
    Route::get('logout', [AuthAction::class, 'logout'])->middleware(['auth:sanctum']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile-update/{id}', [AuthAction::class, 'profile_update']);
});
Route::get('/setting', [FrontendAction::class, 'setting']);
Route::get('/our-partner', [FrontendAction::class, 'our_partner']);
Route::get('/holiday-package', [FrontendAction::class, 'holiday_package']); 
Route::get('/holiday-package/details/{slug}', [FrontendAction::class, 'holiday_package_details']);
Route::get('/translate-data', [FrontendAction::class, 'translate_data']);
Route::get('/change-language/{lang_code}', [FrontendAction::class, 'change_language']);
Route::get('/slider', [FrontendAction::class, 'slider']);
Route::get('/explore-destination', [FrontendAction::class, 'explore_destination']);
Route::get('/hotel-list/{country_id}', [FrontendAction::class, 'hotel_list']);
Route::get('/hotel-details/{slug}', [FrontendAction::class, 'hotel_show']);
Route::get('/featured-hotels', [FrontendAction::class, 'featured_hotels']);
Route::post('/test-post', [FrontendAction::class, 'test_post']);