<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name',
    'description',
    'price',
    'cost_price',
    'barcode',
    'expiry_date',
    'supplier_id',
    'category_id',
];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function stock()
{
    return $this->hasOne(Stock::class);
}
public function category()
{
    return $this->belongsTo(Category::class);
}


}
