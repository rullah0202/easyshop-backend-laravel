<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        try {

            $address = Address::where('user_id',$id)->first();
            return response()->json($address,200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in AddressController.index',
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

            $address = new Address();
  
            $address->user_id = auth()->user()->id;
            $address->name = $request->input('name');
            $address->address = $request->input('address');
            $address->zipcode = $request->input('zipCode');
            $address->city = $request->input('city');
            $address->country = $request->input('country');
            $address->save();

            return response()->json(['success' => 'OK'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        // $request->validate([
        //     'name' => 'required|max:20',
        //     'address' => 'required'
        // ]);
        
        $address = Address::where('user_id',auth()->user()->id)->first();

        try {
            $address->name = $request->input('name');
            $address->address = $request->input('address');
            $address->zipcode = $request->input('zipCode');
            $address->city = $request->input('city');
            $address->country = $request->input('country');

            $address->save();

            return response()->json(['ADDRESS DETAILS UPDATED SUCCESSFULLY'],200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
