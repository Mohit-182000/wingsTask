<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function priority(){
        return $this->belongsTo(Priority::class,'priority_id');
    }

    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function assign_user(){
        return $this->belongsTo(User::class,'assign_to_user_id');
    }
}
