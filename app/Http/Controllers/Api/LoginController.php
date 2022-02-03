<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function login(LoginRequest $request){
        try {

            if(Auth::attempt($request->only(['email','password']))){
                $user = User::with('roles.permissions')->where(['email' => $request->email])->firstOrFail();
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'user' => $user,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'success'=>true
                ],200);

            }


            return response()->json([
                'success'=>false,
                'msg' => 'La credenciales no son válidas'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success'=>false,
                'msg' => 'Lo sentimos ocurrio un error'
            ],500);

        }
    }

    public function logOut(Request $request){

        try{
            $user = $request->user(); 
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
            return response()->json(['success' => true],200);
        }catch(Exception $e){
            return response()->json(['success' => false,'msg' => 'Error al cerrar la sesión'],500);
        }
        
    }
}
