<?php

namespace App\Models\Article;

use App\Models\user;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','slug','body','subject_id'];

    protected $with = ['subject','user'];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

}
