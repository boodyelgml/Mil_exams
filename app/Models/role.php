<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';

    public function users(){
        return $this->belongsToMany("/App/User" , "user_roles" , "role_id" , "user_id");
    }
}
