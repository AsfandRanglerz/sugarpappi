<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTopping extends Model
{
    use HasFactory;
    protected $guarded = [];
    // public function topping(){
    //     return $this->hasMany(topping::class, 'topping_id', 'id');
    // }
    public function topping()
    {
        return $this->belongsTo(Topping::class, 'topping_id', 'id');
    }
    // public function category()
    // {
    //     return $this->hasMany(Category::class, 'category_id', 'id');
    // }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
