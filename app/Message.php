<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['channel_id'];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function channels(){
        return $this->belongsTo('App\Channel');
    }
}
