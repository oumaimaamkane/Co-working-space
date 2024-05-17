<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $category = Category::create([
            'name' => $request->input('name'),
        ]);
        return response()->json($category, 201);

    }

    public function update(Request $request, $id){

        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(null, 204);

    }
}
