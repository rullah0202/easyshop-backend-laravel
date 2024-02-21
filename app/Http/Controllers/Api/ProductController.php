<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllProductsCollection;
use App\Http\Resources\ProductById;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Product $product)
    {
        try {

            $product = Product::where('title','like','%'.$request->title.'%')->take(5)->get();
            return response()->json( new AllProductsCollection($product),200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ProductController.show',
                'error' =>$e->getMessage()
            ],400);
        }
    }
    /**
     * Display the specified resource.
     */
    public function productById(Product $product)
    {
        try {

            $product = Product::findOrFail($product->id);
            return response()->json([
                'product' => new ProductById($product)
             ],200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ProductController.productById',
                'error' =>$e->getMessage()
            ],400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
