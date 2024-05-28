<?php

use App\Models\Service;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $services = Service::all()->map(function($service) {
        $service->image = $service->getFirstMediaUrl('ServiceImages');
        return $service;
    });

    return view('services.index', compact('services'));
});
