<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'expense_type_id',
        'contractor_id',
        'invoice_number',
        'invoice_amount',
        'payment_status',
        'payment_method',
        'payment_due_date',
    ];

    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function products()
    {
        return $this->hasMany(ExpenseProduct::class);
    }


}
