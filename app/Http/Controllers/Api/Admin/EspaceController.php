<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Espace;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspaceController extends Controller
{
    public function index()
    {
        $espaces = Espace::with('category')->get()->map(function ($espace) {
            $espace->first_image_url = $espace->first_image_url; // This calls the getFirstImageUrlAttribute method
            return $espace;
        });
    
        return response()->json($espaces);
    }
    

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'floor' => 'required|integer',
    //         'description' => 'required|string|max:1000',
    //         'status' => 'required|string|in:valable,reserver',
    //         'price' => 'required|numeric|min:0.01',
    //         'capacity' => 'required|integer',
    //         'category_id' => 'required|exists:categories,id|integer',
    //         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 400);
    //     }
    
    //     $espace = Espace::create($request->except('images', 'service_id'));
    
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             $espace->addMedia($image)->toMediaCollection('EspaceImages');
    //         }
    //     }
    
    //     if ($request->has('service_id')) {
    //         $espace->services()->attach($request->input('service_id'));
    //     }
    
    //     return response()->json($espace, 201);
    // }
    public function store(Request $request)
{
        $validator = Validator::make($request->all(), [
            'floor' => 'required|integer',
            'description' => 'required|string|max:1000',
            'status' => 'required|string|in:valable,reserver',
            'price' => 'required|numeric|min:0.01',
            'capacity' => 'required|integer',
            'category_id' => 'required|exists:categories,id|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

    $espace = Espace::create($request->except('images', 'service_id', 'equipement_id'));

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $espace->addMedia($image)->toMediaCollection('EspaceImages');
        }
    }

    if ($request->has('service_id')) {
        $espace->services()->attach($request->input('service_id'));
    }
    if ($request->has('equipement_id')) {
        $espace->equipements()->attach($request->input('equipement_id'));
    }

    // Ensure the espace is loaded with all necessary relationships and attributes
    $espace->load('category');
    $espace->first_image_url = $espace->first_image_url;

    return response()->json(['espace' => $espace], 201);
}

    
    
    
    

    public function update(Request $request, Espace $espace)
    {
        $validator = Validator::make($request->all(), [
            'floor' => 'integer',
            'description' => 'required|string|max:1000',
            'status' => 'string|in:valable,reserver',
            'price' => 'numeric|min:0.01',
            'capacity' => 'integer',
            'category_id' => 'exists:categories,id|integer',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if ($request->hasFile('images')) {
            $espace->clearMediaCollection('EspaceImages');
            $espace->addMedia($request->file('images'))->toMediaCollection('EspaceImages');
        }

        $espace->update($request->except(['images', 'service_id', 'equipement_id']));

        if ($request->has('service_id')) {
            $espace->services()->sync($request->input('service_id'));
        } else {
            $espace->services()->detach();
        }
        if ($request->has('equipement_id')) {
            $espace->equipements()->sync($request->input('equipement_id'));
        } else {
            $espace->equipements()->detach();
        }

        return response()->json(['message' => 'Espace updated successfully', 'espace' => $espace], 200);
    }





    public function show($id)
    {
        try {
            $espace = Espace::with(['services', 'equipements', 'category'])->findOrFail($id);
            return response()->json(['espace' => $espace], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Espace not found'], 404);
        }
    }







    public function destroy(Espace $espace)
    {
        $espace->delete();

        return response()->json(['message' => 'Espace deleted successfully'], 204);
    }
}

