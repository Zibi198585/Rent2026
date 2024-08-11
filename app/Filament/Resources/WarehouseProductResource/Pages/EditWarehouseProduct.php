<?php

namespace App\Filament\Resources\WarehouseProductResource\Pages;

use App\Filament\Resources\WarehouseProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWarehouseProduct extends EditRecord
{
    protected static string $resource = WarehouseProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
