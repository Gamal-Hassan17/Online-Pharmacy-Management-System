<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'unit_cost',
        'total_cost',
    ];

    /**
     * العلاقة مع الشراء (Purchase)
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * العلاقة مع المنتج (Product)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
