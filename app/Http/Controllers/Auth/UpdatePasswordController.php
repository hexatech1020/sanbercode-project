<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Email Tidak Ditemukan',
            ],200);            
        }

        if ($request->password !== $request->password_confirmation){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Password Tidak Sama',
            ],200);    
        }

        if(!$user->email_verified_at){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'User Belum Terverifikasi',
            ],200);              
        }

        $user->password = bcrypt($request->password);
        $user->update();

        $data['user'] = $user;
        return response()->json([
            'response_code' => '00',
            'response_message' => 'Password Berhasil Diubah',
            'user' => $data['user'],
        ],200);
    }
}
