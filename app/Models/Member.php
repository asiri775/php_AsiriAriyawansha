<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name', 'email_address', 'join_date','route_id','comments'
    ];

    public function telephones(){
        return $this->hasMany(Telephone::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }


}
