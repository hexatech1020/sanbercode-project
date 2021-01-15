<?php

namespace App\Models;

use App\Models\Article\Article;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Support\Str;
use App\Traits\UsesUuid;
use Auth;
use App\Role;

class User extends Authenticatable implements JWTSubject
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

    protected function get_user_role_id(){
        $role = \App\Role::where('name','User')->first();
        return $role->id;
    }

    public static function boot(){
        parent::boot();

        static::creating(function ($model){
            $model->role_id = $model->get_user_role_id();
        });
    }

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

        if($this->role_id == $this->get_user_role_id()){
            return false;
        }

        return true;

        // $role_id=Auth::user()->role_id;
        // $role_name = Role::where('id', $role_id)->first();
        // if($role_name->name == 'Admin'){
        //     return true;
        // }
        // return false;
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i:s');
    }
    
    public function getUpdatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i:s');
    }    
}
