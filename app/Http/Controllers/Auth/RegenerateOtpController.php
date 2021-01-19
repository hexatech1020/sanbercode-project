<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Otp;
use App\Models\User;

class RegenerateOtpController extends Controller
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

        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Email Tidak Ditemukan',
            ],200);            
        }

        $user->generate_otp_code();

        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'OTP Berhasil diupdate',
            'data' => $data,
        ],200);



    }
}
