<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'expense_id',
        'rental_id',
        'sale_id',
        'quantity',
        'type',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    // public function rental()
    // {
    //     return $this->belongsTo(Rental::class);
    // }

    // public function sale()
    // {
    //     return $this->belongsTo(Sale::class);
    // }
}
