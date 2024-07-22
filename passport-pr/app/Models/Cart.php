<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class Cart extends Model
{
    use HasFactory;
    private $rate = 1;

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function checkout()
    {
        // 訂單建立
        $order = $this->order()->create([
            'user_id' => $this->user_id
        ]);

        if($this->user->level ==2){
            $this->rate = 0.8;
        }
        // 購物車商品轉訂單商品
        foreach($this->cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'price' => $cartItem->product->price * $this->rate,
            ]);
        }
        $this->update(['checkouted' => true]);
        $order->orderItems;
        return $order;
    }
}
