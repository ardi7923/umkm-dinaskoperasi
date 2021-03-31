<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCart extends Model
{
    use HasFactory;

    protected $table = 'product_user';
    protected $appends = ['total'];
    // protected $visible = ['total'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'confirm_password'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAttribute()
    {
        return ($this->qty) ?  $this->product->price * $this->qty : $this->product->price;
    }
}
