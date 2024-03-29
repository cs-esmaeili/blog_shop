<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $guarded = ['product_id'];
    protected $fillable  = ['category_id' , 'file_id', 'name', 'price', 'sale_price', 'status', 'stock', 'order_number', 'description'];

    public function items()
    {
        return $this->belongsToMany(Token::class, 'product_item', 'product_id', 'item_id');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'category_id', 'category_id');
    }
    public function userJournal()
    {
        return $this->hasMany(UserJournal::class, 'product_id', 'product_id');
    }
    public function factorProducts()
    {
        return $this->hasMany(FactorProduct::class, 'product_id', 'product_id');
    }
    public function userCart()
    {
        return $this->hasMany(UserCart::class, 'product_id', 'product_id');
    }
}
