<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['first_user','second_user'];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function pets(){
        return $this->belogsTo('App\Pet');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }
}
