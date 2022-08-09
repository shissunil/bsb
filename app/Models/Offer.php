<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    public function hasOneMaterial()
    {
        return $this->hasOne('App\Models\Material','id','material_id');
    }
    public function hasOneGrade()
    {
        return $this->hasOne('App\Models\Grade','id','grade_id');
    }
    public function hasOneColour()
    {
        return $this->hasOne('App\Models\Colour','id','colour_id');
    }
    public function hasOneCountry()
    {
        return $this->hasOne('App\Models\Country','id','origin_id');
    }
    public function hasOneUser()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function hasOneCurency()
    {
        return $this->hasOne('App\Models\Currency','id','courrency_id');
    }
    public function hasManyOfferMedia()
    {
        return $this->hasMany('App\Models\OfferMedia','offer_id','id');
        
    }
}
