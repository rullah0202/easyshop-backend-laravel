<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersCollection;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $order = Order::where('user_id',auth()->user()->id)->whereNotNull('payment_intent')->get();
            $address = Address::where('user_id',$order[0]->user_id)->first();
            return response()->json([
                'orders' => new OrdersCollection($order),
                'address' => $address
            ] ,200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in OrderController.index',
                'error' =>$e->getMessage()
            ],400);
        }
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
