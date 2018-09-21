<?php

namespace App\Http\Controllers;
use Firebase\JWT\JWT;

use Illuminate\Http\Request;
use Validator;
use App\User;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     **/
    public function __construct()
    {
        
    }
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->token, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 
    public function authenticate(Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'email'     => 'required|email',
        //     'password'  => 'required'
        // ]);
        // Find the user by email
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the 
            // below respose for now.
            return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }
        // Verify the password and generate the token
      //  if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
    //    }
        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
    public function rollback(Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'email'     => 'required|email',
        //     'password'  => 'required'
        // ]);
        // Find the user by email
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the 
            // below respose for now.
            return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }
        // Verify the password and generate the token
      //  if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
    //    }
        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
    
}

    //

