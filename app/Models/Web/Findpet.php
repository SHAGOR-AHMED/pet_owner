<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Findpet extends Model
{
    use HasFactory;

    public function scopeSearch($query, $val=''){
        return $query->where('name', 'LIKE', '%' . $val . '%');
    }
}
