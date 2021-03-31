<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderList;
use App\Models\Bank;

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
}
