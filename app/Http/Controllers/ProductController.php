<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);

        return response()->json($products, 200);
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
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:255|unique:products',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048',
            'description' => 'required',
        ]);

        $slug= Str::slug(request()->input('title'));
        $image = $request->file('image');

        if($image) {
            $imageName = $slug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->storeAs('images', $imageName);
        }

        $product = Product::create([
            'category_id' => $request->input('category_id'),
            'title' => request()->input('title'),
            'slug' => $slug,
            'price' => request()->input('price'),
            'image' => $imageName ? 'storage/images/'.$imageName : 'no-image.jpg',
            'description' => request()->input('description')
        ]);

        return response()->json('Product Added Successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
