<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignEmployee extends Model
{
    use HasFactory;
    public function hasOneUser()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
