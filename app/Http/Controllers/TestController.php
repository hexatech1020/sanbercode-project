<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TestController extends Controller
{
    //
    public function route1(){

        
        return 'Anda Adalah User yang sudah melakukan Verifikasi Email';
    }

    public function route2(){
        return 'Anda Adalah User dengan role sebagai seorang admin';
    }
}
