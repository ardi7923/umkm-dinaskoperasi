<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderList;
use App\Models\Product;

class Umkm extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orderList()
    {
        return $this->hasManyThrough(OrderList::class,Product::class);
    }

    public function scopeVerify($query)
    {
    	return $query->where('verify',1);
    }

    public function scopeUnverify($query)
    {
    	return $query->where('verify',0);
    }
}
