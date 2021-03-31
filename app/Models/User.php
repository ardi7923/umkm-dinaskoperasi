<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Umkm;
use App\Models\UserCart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\District;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'confirm_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function carts()
    {
        return $this->hasMany(UserCart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)->using(UserCart::class);
    }

    public function scopeIsUmkm($query)
    {
        return $query->where('role','UMKM');
    }

    public function getDistrictNameAttribute()
    {
        return ($this->district->name);
    }

    // public function scopeIsUmkm($query)
    // {
    //     return $query->where('role','UMKM');
    // }
}
