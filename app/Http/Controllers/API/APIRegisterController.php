<?php
   
namespace App\Http\Controllers\API;
   
use App\Http\Controllers\API\APIBaseController as BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;
   
class APIRegisterController extends BaseController
{
    /**
     * Register User api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, String $type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
   
        try {
            $name = $request->get('name');
            $email = $request->get('email');
            $password = $request->get('password');
            $password = bcrypt($password);

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();

            switch ($type) {
                case getenv('USR_STD'):
                    $user->assignRole('std_user');
                    break;
                case getenv('USR_PUB'):
                    $user->assignRole('publisher');
                    break;
                
                default:
                    return response()->json([
                        'success' => false,
                        'message' => getenv('MSG_ERROR'),
                        'data' => $type
                    ], 400);
                    break;
            }
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            
            return response()->json([
                'success' => true,
                'message' => "User successfully registered",
                'data' => [
                    'user' => $user,
                    'token' => $success['token']
                ]
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ]);
        }
    }
}