<?php

namespace App\Http\Controllers\Profile;


// namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return response()->json([
            'response_code' => '00',
            'response_message' => 'Profile Berhasil Ditampilkan',
            'data' => [
                "profile" => $data['user'],
            ]
        ],200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user = auth()->user();
        $user->name = $request->name;
        $user->update();


        $data['user'] = $user;
        return response()->json([
            'response_code' => '00',
            'response_message' => 'Profile Berhasil Diupdate',
            'data' => [
                "profile" => $data['user'],
            ]
        ],200);        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
