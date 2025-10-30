<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function categoryToppings()
    {
        return $this->hasMany(CategoryTopping::class,'category_id' ,'id');
    }
    public function toppingsProduct()
    {
        return $this->hasMany(ToppingProduct::class, 'category_id', 'id');
    }

    // public function categoryToppings()
    // {
    //     return $this->hasMany(CategoryTopping::class, 'category_id', 'id');
    // }

    // public function toppingsProduct()
    // {
    //     return $this->hasMany(ToppingProduct::class, 'category_id', 'id');
    // }
}
