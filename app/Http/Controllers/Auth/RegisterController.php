<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Otp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        // request()->validate([
        //     'name' => ['string', 'required'],
        //     'email' => ['email','required'],
        //     'password' => ['required','min:6'],
        // ]);

        $user = User::create([
            // 'id' => Str::uuid(),
            'name' => request('name'),
            'email' => request('email'),
        ]);

        $data['user'] = $user;

        Otp::create([
            'otp' => mt_rand(100000, 999999),
            'user_id' => $user->id,
            'valid_until' => \Carbon\Carbon::now()->addMinutes(5),
        ]);

        return response()->json([
            'response_code' => '00',
            'response_message' => 'silahkan cek email',
            'user' => $data['user'],
        ],200);  

        // return new UserResource($user);

       // return response('Thanks, you are registered');
    }
    
}
