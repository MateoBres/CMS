<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::orderby('name', 'asc')->get();

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $users
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role_id' => 'required|integer'
        ]);

        try {
            $name = $request->get('name');
            $email = $request->get('email');
            $password = $request->get('password');
            $role_id = $request->get('role_id');
    
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->assignRole($role_id);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User successfully created',
                'data' => $user
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $user->load('addresses', 'retailers', 'orders', 'orders.details', 'orders.status', 'orders.retailer')
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $name = $request->get('name');
            $user->name = $name;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User successfully edited',
                'data' => $user
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User successfully deleted',
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Change User's password
     * 
     * @param \App\User $user
     * @param \Illuminate\Http\Request $request
     */
    public function change_password(Request $request, User $user) {
        try {
            $old_password = $request->get('old_password');
            $new_password = $request->get('new_password');
    
            if(Hash::check($old_password, $user->password)) {
                $user->password = bcrypt($new_password);
                $user->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Password successfully changed',
                    'data' => null
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Old password does not match',
                    'data' => null
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Reset User's password
     * 
     * @param Illuminate\Http\Request $request
     */
    public function reset_password(Request $request) {
        try {
            $mail = $request->get('mail');
            $user = User::where('email', $mail)->first();
            if($user) {
                $new_password = Str::random(2) . Str::random(2) . Str::random(2);
                $user->password = bcrypt($new_password);
                $user->save();

                $data = [
                    'new_password' => $new_password
                ];

                Mail::to($mail)->send(new PasswordReset($data));
    
                return response()->json([
                    'success' => true,
                    'message' => 'Mail per il reset della password inviata',
                    'data' => $new_password
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Non è stato trovato nessun utente corrispondente alla mail inserita',
                    'data' => $mail
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false, 
                'message' => 'Si è verificato un errore; Riprova più tardi o contatta l\'assistenza',
                'data' => $th->getMessage()
            ], 500);
        }
    }
}
