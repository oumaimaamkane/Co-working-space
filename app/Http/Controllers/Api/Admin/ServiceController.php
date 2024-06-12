<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all()->map(function($service) {
            $service->image = $service->getFirstMediaUrl('ServiceImages');
            // $service->image = url('storage/' . $service->getFirstMediaUrl('ServiceImages'));
            return $service;
        });
    
        return response()->json($services);
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $service = Service::create([
            'name' => $request->input('name'),
        ]);
    
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $media = $service->addMedia($request->file('image'))->toMediaCollection('ServiceImages');
            $imageUrl = $media->getUrl();  // This will give you the URL for the stored image
        }
    
        return response()->json([
            'service' => $service,
            'image' => $imageUrl,
        ], 201);
    }




    public function update(Request $request, $id)
    {
        $service = Service::find($id);
    
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
    
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Update service name
        $service->name = $request->input('name');
    
        // Handle the file upload if a file is provided
        if ($request->hasFile('image')) {
            // Remove the old image if it exists
            if ($service->hasMedia('ServiceImages')) {
                $service->clearMediaCollection('ServiceImages');
            }
    
            // Add the new image to the media library
            $service->addMediaFromRequest('image')->toMediaCollection('ServiceImages');
        }
    
        $service->save();
    
        // Fetch the URL of the newly uploaded image
        $imageUrl = $service->getFirstMediaUrl('ServiceImages');
    
        return response()->json(['service' => $service, 'image' => $imageUrl], 200);
    }

    
    













    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(null, 204);
    }
    
}
