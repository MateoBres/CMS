<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class APILoginController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $retailerLogin = $request->get('retailerLogin');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $user->isRetailer = $user->isRetailer();
            if(($user->isRetailer && $retailerLogin) || !$retailerLogin) {
                $user->load('roles', 'retailers', 'addresses', 'retailers.address');
                
                return response()->json([
                    'success' => true,
                    'message' => 'User successfully logged-in',
                    'data' => [
                        'token' => $user->createToken('loginToken')->accessToken,
                        'user' => $user,
                    ]
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                    'data' => 'Unauthorized'
                ], 500);
            }
        } else {
            // return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'data' => 'Unauthorized'
            ], 500);
        }
    }
}
