<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function scopeVerify($query)
    {
    	return $query->where('verify',1);
    }

    public function scopeUnverify($query)
    {
    	return $query->where('verify',0);
    }
}
