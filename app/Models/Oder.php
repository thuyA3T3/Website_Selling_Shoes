<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;
    protected $table = 'orders';

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
        'CustomerID',
        'OrderDate',
        'TotalAmount',
        'status',
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'OrderID', 'id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the customer associated with the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }
}
