<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\UsesUuid;

class Role extends Model
{

    use UsesUuid;
    //
    // protected static function boot() {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         if ( ! $model->getKey()) {
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }    

    protected $guarded = [];

    public function users(){
        return $this-> hasMany('App\User');
    }
}
