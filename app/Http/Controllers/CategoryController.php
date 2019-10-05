<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        // return view('admin.users.index')->with('users', User::all());
        // return new CategoryCollection(Category::all());
        return response(Category::all()->toJson());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required|string|unique:categories'
        ]);
        
        if($validate->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }

        Category::create([
            'category_name' => $request->category_name
        ]);

        return response()->json('success'); 
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'category_name' => 'required|string|unique:categories,category_name,' .$id
        ]);
        
        if($validate->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }

        $category = Category::find($id);
        
        $category->category_name = $request->category_name;

        $category->save();

        return response()->json('success');
    }
}
