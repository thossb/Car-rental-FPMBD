<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    public function vehicle(){
        return $this->belongsTo('App\Models\Vehicle' , "vehicle_id" ,"id");
    }

    public function client(){
        return $this->belongsTo('App\Models\User' , "client_id" ,"id");
    }

    public function feedback(){
        return $this->belongsTo('App\Models\UserFeedback' , "feedback_id" ,"id");
    }

}
