<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::orderBy('created_at', 'desc')->get();
            return response()->json(new AllProductsCollection($products), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
