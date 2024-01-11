<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
        'Description',
        'Price',
        'CategoryID',
        'thumb',
        'shop_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the category associated with the product.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }
    public function orders()
    {
        return $this->hasMany(OrderDetail::class, 'ProductID');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}
