<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    public function scopeSearch($query, $val=''){
        return $query->where('os', 'LIKE', '%' . $val . '%')
                    ->orWhere('browser', 'LIKE', '%' . $val . '%')
                    ->orWhere('device', 'LIKE', '%' . $val . '%')
                    ->orWhere('ip', 'LIKE', '%' . $val . '%');
    }
}
