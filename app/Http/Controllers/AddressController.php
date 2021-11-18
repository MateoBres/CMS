<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $addresses = Address::orderBy('city', 'asc')->get();
            
            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $addresses
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required',
            'address' => 'required',
            'province' => 'required',
            'zip_code' => 'required',
            'user_id' => 'required_without:retailer_id',
            'retailer_id' => 'required_without:user_id'
        ]);

        try {
            $name = $request->get('name');
            $city = $request->get('city');
            $address = $request->get('address');
            $province = $request->get('province');
            $zip_code = $request->get('zip_code');
            $user_id = $request->get('user_id');
            $retailer_id = $request->get('retailer_id');

            $new_address = new Address();
            $new_address->name = $name;
            $new_address->city = $city;
            $new_address->address = $address;
            $new_address->province = $province;
            $new_address->zip_code = $zip_code;

            if($user_id) {
                $new_address->user_id = $user_id;
            } else {
                $new_address->retailer_id = $retailer_id;
            }

            $new_address->save();

            return response()->json([
                'success' => true,
                'message' => 'Address successfully created',
                'data' => $new_address
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $address
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        try {
            $name = $request->get('name');
            $city = $request->get('city');
            $address_in = $request->get('address');
            $province = $request->get('province');
            $zip_code = $request->get('zip_code');

            $address->name = $name;
            $address->city = $city;
            $address->address = $address_in;
            $address->province = $province;
            $address->zip_code = $zip_code;
            
            $address->save();

            return response()->json([
                'success' => true,
                'message' => 'Address successfully edited',
                'data' => $address
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        try {
            $address->delete();

            return response()->json([
                'success' => true,
                'message' => 'Address successfully deleted',
                'data' => $address
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }
}
