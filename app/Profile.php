<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'firstname', 'lastname', 'contact', 'user_image'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
