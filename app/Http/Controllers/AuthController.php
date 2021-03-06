<?php

namespace Reporthero\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Reporthero\User;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        
        try {
            if (! $token = JWTAuth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'activated' => true])) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // Check if user is active.
        // all good so return the token

        return response()->json(compact('token'));
    }

    public function check()
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
            if($user->activated){
                return response(['authenticated' => true]);
            }
        } catch (JWTException $e) {
            return response(['authenticated' => false]);
        }

        return response(['authenticated' => false]);
    }

    public function checkIsAdmin()
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response(['authenticated' => false]);
        }
        if($user->isA('admin')){
            return response(['admin' => true]);
        }

        return response(['admin' => false]);
    }

    public function logout()
    {

        try {
            $token = JWTAuth::getToken();

            if ($token) {
                JWTAuth::invalidate($token);
            }

        } catch (JWTException $e) {
            return response()->json($e->getMessage(), 401);
        }

        return response()->json(['message' => 'Log out success'], 200);
    }

    public function register(Request $request) {
        try{
            $user = new User($request->all());
            $user->password = bcrypt(request()->input('password'));
            $user->save();
        }
        catch (\Illuminate\Database\QueryException $e){
           return response()->json([
            'message' => 'Duplicate Entry',
        ], 401);
        }
         return response()->json([
            'message' => 'Account Registered',
        ], 201);
    }
}
