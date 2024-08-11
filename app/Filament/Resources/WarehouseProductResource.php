<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarehouseProductResource\Pages;
use App\Filament\Resources\WarehouseProductResource\RelationManagers;
use App\Models\WarehouseProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WarehouseProductResource extends Resource
{
    protected static ?string $model = WarehouseProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function getPluralLabel(): string
    {
        return __('Warehouse Products');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('warehouse_id')
                ->relationship('warehouse', 'name')
                ->required()
                ->label('Warehouse'),
            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')
                ->required()
                ->label('Product'),
            Forms\Components\TextInput::make('quantity')
                ->required()
                ->label('Quantity')
                ->numeric(),
            Forms\Components\Select::make('status')
                ->options([
                    'available_for_rent' => 'Available',
                    'new_for_sale' => 'New for Sale',
                    'used_for_sale' => 'Used for Sale',
                    'rented' => 'Rented',
                ])
                ->required()
                ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('warehouse.name')
                ->label('Warehouse')
                ->searchable(),
            Tables\Columns\TextColumn::make('product.name')
                ->label('Product')
                ->searchable(),
            Tables\Columns\TextColumn::make('quantity')
                ->label('Quantity')
                ->searchable(),
            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWarehouseProducts::route('/'),
            'create' => Pages\CreateWarehouseProduct::route('/create'),
            'edit' => Pages\EditWarehouseProduct::route('/{record}/edit'),
        ];
    }
}
