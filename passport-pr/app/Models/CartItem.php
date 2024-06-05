<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // protected $guarded = ['quantity']; //
    protected $guarded = ['']; //
    // protected $hidden = ['updated_at']; //
    // protected $appends = ['current_price']; //

    public function getCurrentPriceAttribute()
    {
        return $this->quantity * 10;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
