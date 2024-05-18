<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspaceController extends Controller
{
    public function index()
    {
        $espaces = Espace::all();
        return response()->json($espaces);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'floor' => 'required|integer',
            'description' => 'required|string|max:1000',
            'status' => 'required|string|in:valable,reserver',
            'price' => 'required|numeric|min:0.01',
            'capacity' => 'required|integer',
            'client_categorie' => 'required|string|in:freelancer,start,entreprise',
            'category_id' => 'required|exists:categories,id|integer',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $espace = Espace::create($request->except('images'));

        if ($request->hasFile('images')) {
            $espace->addMedia($request->file('images'))->toMediaCollection('EspaceImages');
        }

        return response()->json($espace, 201);
    }


    public function update(Request $request, Espace $espace)
    {
        $validator = Validator::make($request->all(), [
            'floor' => 'integer',
            'description' => 'required|string|max:1000',
            'status' => 'string|in:valable,reserver',
            'price' => 'numeric|min:0.01',
            'capacity' => 'integer',
            'client_categorie' => 'string|in:freelancer,start,entreprise',
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
    
        $espace->update($request->except(['images', 'service_id']));
    
        // Update espace services
        if ($request->has('service_id')) {
            $espace->services()->sync($request->input('service_id'));
        } else {
            $espace->services()->detach();
        }
    
        return response()->json($espace, 200);
    }
    


    public function destroy(Espace $espace)
    {
        $espace->delete();
    
        return response()->json(null, 204);
    }
    
}
