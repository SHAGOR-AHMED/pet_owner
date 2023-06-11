<?php

namespace App\Models;

use App\Models\Admin\Certificate;
use App\Models\Admin\Marker;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function scopeSearch($query, $val=''){
        return $query->where('name', 'LIKE', '%' . $val . '%')
                     ->orWhere('email', 'LIKE', '%' . $val . '%')
                     ->orWhere('mobile_no', 'LIKE', '%' . $val . '%');
    }

    public function certificates(){
        return $this->hasMany(Certificate::class, 'owner_id', 'id');
    }
    
    public function markers(){
        return $this->belongsTo(Marker::class, 'owner_id', 'id');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Admin\Role', 'user_roles', 'user_id', 'role_id'); //user_roles = table name, user_id & role_id = foreign ky
    }

    // Check Array of roles
    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('slug',$roles)->first()){
            return true;
        }
        return false;
    }

    // Check single roles
    public function hasRole($role)
    {
        if($this->roles()->where('slug',$role)->first()){
            return true;
        }
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
