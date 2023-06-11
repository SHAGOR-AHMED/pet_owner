<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    public function scopeSearch($query, $val=''){
        return $query->where('name', 'LIKE', '%' . $val . '%')
                     ->orWhere('color', 'LIKE', '%' . $val . '%')
                     ->orWhere('dob', 'LIKE', '%' . $val . '%');
    }

    public function users(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
