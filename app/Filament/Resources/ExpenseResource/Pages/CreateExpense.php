<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use App\Models\WarehouseMovement;
use App\Models\WarehouseProduct;
use Illuminate\Support\Facades\Log;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;



    protected function afterCreate(): void
    {
        $expense = $this->record;  // Zapisany rekord Expense

        $expense->load('products');  // Załaduj powiązane produkty

        $expenseType = $expense->expenseType;

        if ($expenseType && $expenseType->affects_inventory) {
            Log::info('Expense affects inventory: ' . $expenseType->name);

            $products = $expense->products;

            if ($products->isEmpty()) {
                Log::info('No products found for this expense.');
            } else {
                Log::info('Found ' . $products->count() . ' products for this expense.');
            }

            foreach ($products as $product) {
                Log::info('Processing product ID: ' . $product->product_id . ' in warehouse ID: ' . $product->warehouse_id);

                $movement = WarehouseMovement::create([
                    'expense_id' => $expense->id,
                    'warehouse_id' => $product->warehouse_id,
                    'product_id' => $product->product_id,
                    'quantity' => $product->quantity,
                    'type' => 'inbound',
                ]);

                Log::info('Warehouse movement created: ' . $movement->id);

                WarehouseProduct::updateStock($movement);
            }
        } else {
            Log::info('Expense does not affect inventory or expense type not found.');
        }
    }
}

