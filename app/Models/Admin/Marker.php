<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marker extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

}
