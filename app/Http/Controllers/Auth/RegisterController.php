<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Otp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Events\UserRegisteredEvent;

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

        // $user = User::create([
        //     // 'id' => Str::uuid(),
        //     'name' => request('name'),
        //     'email' => request('email'),
        // ]);

        $data_request = $request->all();
        $user = User::create($data_request);


        $data['user'] = $user;

        event(new UserRegisteredEvent($user));

        // Otp::create([
        //     'otp' => mt_rand(100000, 999999),
        //     'user_id' => $user->id,
        //     'valid_until' => \Carbon\Carbon::now()->addMinutes(5),
        // ]);

        return response()->json([
            'response_code' => '00',
            'response_message' => 'silahkan cek email',
            'data' => $data,
        ],200);  

        // return new UserResource($user);

       // return response('Thanks, you are registered');
    }
    
}
