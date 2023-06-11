<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function scopeSearch($query, $val=''){
        return $query->where('name', 'LIKE', '%'.$val.'%');
    }

    public function users(){
        return $this->hasOne(\App\Models\User::class, 'role_id', 'id');
    }

    public function usedRole(){
        return $this->hasOne(\App\Models\Admin\UserRole::class, 'role_id', 'id');
    }

    protected $fillable = ['id','name','slug'];

}
