<?php

use App\Http\Controllers\AiTravelPlannerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes - SaudiWings Travel Tech
|--------------------------------------------------------------------------
|
| The 8 dedicated presentation pages required for the platform showcase.
|
*/

// 1. Home Landing Page (Direct visual match to reference image)
Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

// 2. Flight Booking Landing Page
Route::get('/flights', function () {
    return Inertia::render('Flights');
})->name('flights');

// 3. Discover Saudi Arabia
Route::get('/discover', function () {
    return Inertia::render('Discover');
})->name('discover');

// 4. Destinations Directory
Route::get('/destinations', function () {
    return Inertia::render('Destinations');
})->name('destinations');

// 5. Travel Experiences & Events
Route::get('/experiences', function () {
    return Inertia::render('Experiences');
})->name('experiences');

// 6. Airlines & Travel Resources Ecosystem
Route::get('/partners', function () {
    return Inertia::render('Partners');
})->name('partners');

// 7. AI Trip Planner Showcase
Route::get('/ai-planner', function () {
    return Inertia::render('AiPlanner');
})->name('ai-planner');

// 8. About & Contact
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

/*
|--------------------------------------------------------------------------
| AI Travel Planner Endpoints (OpenAI-Ready Architecture)
|--------------------------------------------------------------------------
*/
Route::post('/api/ai/itinerary', [AiTravelPlannerController::class, 'generateItinerary']);
Route::post('/api/ai/chat', [AiTravelPlannerController::class, 'chat']);
