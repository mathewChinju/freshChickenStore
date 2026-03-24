<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'quantity',
        'stock_at_order_time',
        'unit_price',
        'total_price',
        'status',
        'notes',
        'whatsapp_number',
        'is_whatsapp_inquiry'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'is_whatsapp_inquiry' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
