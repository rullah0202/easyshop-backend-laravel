<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrdersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'payment_intent' => $order->payment_intent,
                'items' => $order->items,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'user' => [
                    'id' => $order->user->id,
                    'name' => $order->user->name,
                ],
            ];
        });
    }
}
