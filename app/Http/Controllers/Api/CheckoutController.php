<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $stripe = new \Stripe\StripeClient('sk_test_51N8mB2F9JKTGa2vjTbO03gBwJyGZS2EAkmFH8UaizUQ4SFtZF1Jry7YuSZ9hSzwcNnjZxZN7M5fgW9BroM8UIFY300vnH7ueeZ');

            $order = Order::where('user_id', '=', auth()->user()->id)
                ->where('payment_intent', null)
                ->first();
    
            // if (!is_null($order)) {
            //     return redirect()->route('checkout_success.index');
            // }
    
            $intent = $stripe->paymentIntents->create([
                'amount' => (int) $order->total,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            return response()->json( [
                'intent' => $intent,
                'order' => $order
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in CheckoutController.index',
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

        try {
            $res = Order::where('user_id', '=', auth()->user()->id)
            ->where('payment_intent', null)
            ->first();

            if (!is_null($res)) {
                $res->total = $request->total;
                $res->total_decimal = $request->total_decimal;
                $res->items = json_encode($request->items);
                $res->save();
            } else {
                $order = new Order();
                $order->user_id = auth()->user()->id;
                $order->total = $request->total;
                $order->total_decimal = $request->total_decimal;
                $order->items = json_encode($request->items);
                $order->save();
            }

            return response()->json(['success' => 'OK'], 200);
        
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in CheckoutController.store',
                'error' =>$e->getMessage()
            ],400);
        }

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
    public function update(Request $request, int $id)
    {
        try {
            $order = Order::where('id',$id)
            ->where('payment_intent', null)
            ->first();
            $order->payment_intent = $request['payment_intent'];
            $order->save();
    
            Mail::to($request->user())->send(new OrderShipped($order));
    
            // return redirect()->route('checkout_success.index');
            return response()->json(['success' => 'OK'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in CheckoutController.update',
                'error' =>$e->getMessage()
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
