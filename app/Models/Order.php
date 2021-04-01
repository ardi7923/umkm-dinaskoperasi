<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderList;
use App\Models\Bank;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];


    public function lists()
    {
        return $this->hasMany(OrderList::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWait($query)
    {
        return $query->where('sts',1);
    }
}
