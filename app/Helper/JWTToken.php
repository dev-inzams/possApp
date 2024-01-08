<?php

namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {

    public static function CreateToken($userEmail){
    try{
        $key = env('JWT_SECRET');
        $payload = [
            'iss' => env('APP_URL'),
            'iat' => time(),
            'exp' => time() + 60*60,
            'userEmail' => $userEmail
        ];
        return JWT::encode($payload, $key, 'HS256');
    }catch(\Exception $e){
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ],200);
    }

    } // end of CreateToken


    // reset password token
    public static function ResetPasswordToken($userEmail){
        try{
            $key = env('JWT_SECRET');
            $payload = [
                'iss' => env('APP_URL'),
                'iat' => time(),
                'exp' => time() + 60*5,
                'userEmail' => $userEmail
            ];
            return JWT::encode($payload, $key, 'HS256');
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ],200);
        } // end of try
    } // end of ResetPasswordToken


    public static function VerifyToken($token){
    try{
        $key = env('JWT_SECRET');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        return $decoded->userEmail;
    }catch(\Exception $e){
        return response()->json([
            'status' => 'unauthorized',
            'message' => $e->getMessage(),
        ],200);
    }
    } // end of VerifyToken



}
