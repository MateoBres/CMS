<?php

namespace App\Http\Controllers;

use App\ItalianDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ItalianDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Districts successfully retrieved',
                'data' => ItalianDistrict::with('zipcodes')->get()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ]);
        }
    }

    public function index_by_query(String $district)
    {
        try {
            $results = ItalianDistrict::with('zipcodes')->where('nome', 'ILIKE', $district . '%')->limit(15)->get();
            return response()->json([
                'status' => 'success',
                'message' => getenv('MSG_SUCCESS'),
                'data' => $results
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItalianDistrict  $italianDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(ItalianDistrict $italianDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItalianDistrict  $italianDistrict
     * @return \Illuminate\Http\Response
     */
    public function edit(ItalianDistrict $italianDistrict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItalianDistrict  $italianDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItalianDistrict $italianDistrict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItalianDistrict  $italianDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItalianDistrict $italianDistrict)
    {
        //
    }
}
