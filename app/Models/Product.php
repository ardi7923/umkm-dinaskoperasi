<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Umkm;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function scopeVerified($query)
    {
    	return $query->where('verified',1);
    }

    public function scopeUnverified($query)
    {
    	return $query->where('verified',0);
    }
}
