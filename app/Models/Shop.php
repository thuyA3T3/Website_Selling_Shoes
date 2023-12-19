<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'customer_id',
        // Thêm các trường mới vào đây tương ứng với cột trong bảng shops
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
