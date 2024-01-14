<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function  auth(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provider credentials are incorrect.']
            ]);
        }

        /*
        * logout others diveces if specified
        if($request->has('logout_others_devices')){
            // 
        }
        */

        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return  response()->json([
            'token'=> $token,
        ]);
    }
}