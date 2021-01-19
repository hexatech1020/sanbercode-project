<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(!$token = auth()->attempt($request->only('email', 'password'))){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'silahkan cek kembali email & password Anda',
            ],200);  
        }

        // $data['user'] = $request->user();
        // return response()->json([
        //     'response_code' => '00',
        //     'response_message' => 'User berhasil Login',
        //     'data' => [
        //         "token" => $token,
        //         "user" => $data['user'],
        //     ]
        // ],200);  

        $data['token'] = $token;
        $data['user'] = auth()->user();
        
        return response()->json([
            'response_code' => '00',
            'response_message' => 'user berhasil login',
            'data' => $data,
        ],200);


        // return response()->json(['token' => $token]);
        //return response()->json(compact('token'));

    }
}
