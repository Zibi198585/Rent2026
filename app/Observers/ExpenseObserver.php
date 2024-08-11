<?php

namespace App\Observers;

use App\Models\Expense;
use App\Models\WarehouseProduct;

class ExpenseObserver
{
    /**
     * Handle the Expense "created" event.
     */
    public function created(Expense $expense): void
    {
        if ($expense->warehouse_id && $expense->product_id) {
            $warehouseProduct = WarehouseProduct::firstOrNew([
                'warehouse_id' => $expense->warehouse_id,
                'product_id' => $expense->product_id,
                'status' => $expense->expense_type === 'purchase_for_sale' ? 'new_for_sale' : 'available_for_rent'
            ]);

            $warehouseProduct->quantity += $expense->quantity;
            $warehouseProduct->save();
        }
    }

    /**
     * Handle the Expense "updated" event.
     */
    public function updated(Expense $expense): void
    {
        //
    }

    /**
     * Handle the Expense "deleted" event.
     */
    public function deleted(Expense $expense): void
    {
        //
    }

    /**
     * Handle the Expense "restored" event.
     */
    public function restored(Expense $expense): void
    {
        //
    }

    /**
     * Handle the Expense "force deleted" event.
     */
    public function forceDeleted(Expense $expense): void
    {
        //
    }
}
