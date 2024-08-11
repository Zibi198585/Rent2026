<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    public static function getPluralLabel(): string { return __('Pojazdy'); }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('registration_number')
                    ->label('Numer rejestracyjny')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('brand')
                    ->label('Marka')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->label('Model')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('purchase_date')
                    ->label('Data zakupu')
                    ->required(),
                Forms\Components\DatePicker::make('insurance_date')
                    ->label('Data ubezpieczenia')
                    ->required(),
                Forms\Components\DatePicker::make('inspection_date')
                    ->label('Data przeglądu')
                    ->required(),
                Forms\Components\TextInput::make('mileage')
                    ->label('Stan licznika')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vehicle_type')
                    ->label('Rodzaj pojazdu')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('vin')
                    ->label('Numer Vin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('notes')
                    ->label('Dodaj komentarz')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('registration_number')
                    ->label('Numer rejestracyjny')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->label('Marka')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->label('Model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('purchase_date')
                    ->label('Data zakupu')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('insurance_date')
                    ->label('Data ubezpieczenia')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inspection_date')
                    ->label('Data przeglądu')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mileage')
                    ->label('Stan licznika')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_type')
                    ->label('Rodzaj pojazdu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vin')
                    ->label('Numer Vin')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('created_at')
                    ->label('Data utworzenia')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Data aktualizacji')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Data usunięcia')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
