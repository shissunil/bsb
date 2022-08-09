<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHead extends Model
{
    use HasFactory;

    public function hasOneEmployee()
    {
        return $this->hasOne('App\Models\User','id','recever_id');
    }
    
    public function hasOneMaterial()
    {
        return $this->hasOne('App\Models\Material','order_id','id');
    }
    public function hasOneMassage()
    {
        return $this->hasOne('App\Models\Chat','chat_head_id','id')->orderBy('id','DESC')->limit(1);
    }
     public function hasOneOfferCode()
    {
        return $this->hasOne('App\Models\Order','id','order_id');
    }
}