<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function hasOneOffer()
    {
        return $this->hasOne('App\Models\Offer','id','offer_id');
    }
    public function hasOneUser()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
