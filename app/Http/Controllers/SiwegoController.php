<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiwegoController extends Controller
{
    public function index(Request $request)
    {   
        try 
        {
            $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6InVzZXJuYW1lIiwiaWF0IjoxNjA3OTUzMTUyfQ.4AIAAiluo5E0_dZVEaxcM5buDucZL2E1LD5SK7XXIZA';

            //$url = 'https://partner.siwego.com/data/routes?type=carry&from=Brescia, BS, Italia&to=Milano, MI, Italia&date=2020-12-06';
            $url = 'https://partner.siwego.com/data/routes';

            $response = Http::withToken($token)
                ->get($url, [
                    'type' => $request->get('type'),
                    'from' => $request->get('from'),
                    'to' => $request->get('to'),
                    'date' => $request->get('date'),
                ]);

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $response->json()
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => $th,
                'description' => $th->getMessage()
            ], 200);
        }
    }
}
