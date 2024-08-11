<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseProduct extends Model
{
    protected $fillable = [
        'expense_id',
        'product_id',
        'warehouse_id',
        'quantity',
        'price_per_unit',
        'total_amount',
    ];

   // Relacja do modelu Expense
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    // Relacja do modelu Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relacja do modelu Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
