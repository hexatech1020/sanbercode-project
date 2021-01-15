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
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Email Tidak Ditemukan',
            ],200);            
        }
        $otp_baru = mt_rand(100000, 999999);

        $otp = Otp::where('user_id',$user->id)->first();
        $otp->otp = mt_rand(100000, 999999);
        $otp->valid_until = \Carbon\Carbon::now()->addMinutes(5);

        $otp->update();
        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'OTP Berhasil diupdate',
            'user' => $data['user'],
        ],200);



    }
}
