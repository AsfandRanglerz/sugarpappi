<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {

        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    // public function toppingsProduct()
    // {
    //     return $this->hasMany(ToppingProduct::class, 'topping_id', 'id');
    // }
    // public function categoryToppings()
    // {
    //     return $this->belongsTo(CategoryTopping::class,'topping_id' ,'id');
    // }
    public function categoryToppings()
{
    return $this->hasMany(CategoryTopping::class, 'topping_id', 'id');
}
}
