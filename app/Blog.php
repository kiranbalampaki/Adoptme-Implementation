<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected $fillable = ['title'];

    //in message model
    // public function users(){
    //     return $this->belongsToMany('App\User');
    // }
}
