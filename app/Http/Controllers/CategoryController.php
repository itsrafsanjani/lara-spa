<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return response()->json($categories, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->only('name');

        $validator = Validator::make($input, [
            'name' => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            return response()->json('Category added successfully!', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug): \Illuminate\Http\JsonResponse
    {
        $category = Category::where('slug', $slug)->first();
        if($category){
            return response()->json($category, 200);
        } else {
            return response()->json('failed', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $slug): \Illuminate\Http\JsonResponse
    {
        $input = $request->only('name');

        $validator = Validator::make($input, [
            'name' => 'required|unique:categories', $slug,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $category = Category::where('slug', $slug)->first();

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            return response()->json('Category updated successfully!', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();
            return response()->json('Category deleted successfully!', 200);
        } else {
            return response()->json('Category delete failed!', 404);
        }
    }
}
