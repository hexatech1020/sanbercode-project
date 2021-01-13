<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Support\Str;
use App\Traits\UsesUuid;
use Auth;
use App\Role;

class User extends Authenticatable
{
    use Notifiable, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // protected static function boot() {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         if ( ! $model->getKey()) {
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }


    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role(){
        return $this->belongsTo('App\Role');

    }

    public function otp(){
        return $this->belongsTo('App\Otp');
    }

    public function isAdmin(){
        $role_id=Auth::user()->role_id;
        $role_name = Role::where('id', $role_id)->first();
        if($role_name->name == 'Admin'){
            return true;
        }
        return false;
    }

    public function isEmailVerified(){
        if(Auth::user()->email_verified_at !== null){
            return true;
        }
        return false;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
