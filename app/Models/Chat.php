<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public function hasOneUser()
    {
        return $this->hasOne('App\Models\User','id','sender_id');
    }

}
