<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Otp;
use App\Models\User;

class VerificationController extends Controller
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
        $request->validate(
            [
                'otp' => 'required',
            ]
        );

        $otp = Otp::where('otp', $request->otp)->first();

        if (!$otp) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'OTP Code tidak di temukan'
            ], 200);
        }

        $now = Carbon::now();

        if ($now > $otp->valid_until) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Kode OTP sudah tidak berlaku, silahkan generate ulang'
            ], 200);
        }

        $user = User::find($otp->user_id);
        $user->email_verified_at = Carbon::now();
        $user->save();

        $otp->delete();
        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Anda berhasil diverifikasi',
            'data' => $data,
        ], 200);
    }
}
