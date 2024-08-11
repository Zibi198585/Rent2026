<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class WarehouseProduct extends Model
{
    use HasFactory;

    protected $table = 'warehouse_product';

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'quantity',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function updateStock(WarehouseMovement $movement)
    {
        Log::info('Updating stock for movement ID: ' . $movement->id);

        $warehouseProduct = self::firstOrNew([
            'warehouse_id' => $movement->warehouse_id,
            'product_id' => $movement->product_id,
        ]);

        if ($movement->type === 'inbound') {
            $warehouseProduct->quantity += $movement->quantity;
        } elseif ($movement->type === 'outbound' || $movement->type === 'return') {
            $warehouseProduct->quantity -= $movement->quantity;
        }

        $warehouseProduct->save();

        Log::info('Updated stock for product ID: ' . $movement->product_id . ' in warehouse ID: ' . $movement->warehouse_id);
    }


}
