<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Izinkan kolom-kolom ini untuk disimpan secara massal.
     * Ini akan memperbaiki error MassAssignmentException.
     */
    protected $fillable = [
        'customer_id',
        'merchant_id',
        'total_price',
        'status',
        'delivery_date'
    ];

    // Relasi ke User (sebagai Customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relasi ke Merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // Relasi ke Item Pesanan
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}