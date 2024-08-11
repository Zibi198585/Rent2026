<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseProduct extends Model
{
    protected $fillable = [
        'expense_id',
        'product_id',
        'quantity',
        'price_per_unit',
        'total_amount',
        'warehouse_id',
    ];

     // Automatically set total_amount before saving
     public static function boot()
     {
         parent::boot();

         static::saving(function ($expenseProduct) {
             $expenseProduct->total_amount = $expenseProduct->quantity * $expenseProduct->price_per_unit;
         });
     }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
