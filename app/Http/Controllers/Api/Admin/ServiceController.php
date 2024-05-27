<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('media')->get();
        $services = $services->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'image' => $service->getFirstMediaUrl('ServiceImages'),
            ];
        });
        return response()->json($services);
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $service = Service::findOrFail($id);    
    
        $service->update($request->except('image'));
    
        if ($request->hasFile('image')) {
            $service->clearMediaCollection('images');
            
            $service->addMedia($request->file('image'))->toMediaCollection('images');
        }
    
        return response()->json($service, 200);
    }

    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(null, 204);
    }
}
