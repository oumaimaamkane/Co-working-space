<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EquipementController extends Controller
{
    public function index(){
        $equipements = Equipement::all();
        return response()->json($equipements);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $equipement = Equipement::create([
            'name' => $request->input('name'),
        ]);
        return response()->json($equipement, 201);

    }

    public function update(Request $request, $id){

        $equipement = Equipement::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $equipement->update($request->all());
        return response()->json($equipement, 200);
    }

    public function destroy(Request $request, $id){
        $equipement = Equipement::findOrFail($id);
        $equipement->delete();
        return response()->json(null, 204);

    }
}
