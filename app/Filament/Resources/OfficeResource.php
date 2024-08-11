<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeResource\Pages;
use App\Filament\Resources\OfficeResource\RelationManagers;
use App\Models\Office;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeResource extends Resource
{
    protected static ?string $model = Office::class;


    protected static ?string $navigationGroup = 'Ustawienia';
    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel(): string { return __('Oddziały'); }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nazwa oddziału')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_line_1')
                    ->label('Adres')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_line_2')
                    ->label('Adres2')
                    ->maxLength(255),
                Forms\Components\TextInput::make('post_code')
                    ->label('Kod pocztowy')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label('Miasto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('province')
                    ->label('Województwo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->label('Państwo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Numer kontaktowy')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Adres e-mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('established_date')
                    ->label('Data utworzenia')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Notatki')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa oddziału')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address_line_1')
                    ->label('Adres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address_line_2')
                ->label('Adres2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_code')
                    ->label('Kod pocztowy')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Miasto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province')
                    ->label('Województwo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->label('Państwo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Numer kontaktowy')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Adres e-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('established_date')
                    ->label('Data utworzenia')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListOffices::route('/'),
            'create' => Pages\CreateOffice::route('/create'),
            'edit' => Pages\EditOffice::route('/{record}/edit'),
        ];
    }
}
