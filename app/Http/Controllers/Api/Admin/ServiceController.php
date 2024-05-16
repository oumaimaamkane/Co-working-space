<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::all();
        return response()->json($services);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $service = Service::create([
            'name' => $request->input('name'),
            'image' => $request->input('image'),
        ]);
        return response()->json($service, 201);

    }

    public function update(Request $request, $id){

        $service = Service::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $service->update($request->all());
        return response()->json($service, 200);
    }

    public function destroy(Request $request, $id){
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(null, 204);

    }
}
