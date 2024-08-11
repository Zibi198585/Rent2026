<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Contractor;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContractorResource\Pages;
use App\Filament\Resources\ContractorResource\RelationManagers;

class ContractorResource extends Resource
{
    protected static ?string $model = Contractor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';


    public static function getPluralLabel(): string { return __('Kontrahenci'); }
    //protected static ?string $navigationLabel = 'Kontrahenci';




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->label('Imię')
                    ->maxLength(255),
                Forms\Components\TextInput::make('middle_name')
                    ->label('Drugie imię')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->label('Nazwisko')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_line_1')
                    ->required()
                    ->label('Ulica')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_line_2')
                    ->label('Ulica 2')
                    ->maxLength(255),
                Forms\Components\TextInput::make('post_code')
                    ->required()
                    ->label('Kod pocztowy')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->label('Miasto')
                    ->maxLength(255),
                Forms\Components\TextInput::make('province')
                    ->required()
                    ->label('Województwo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->label('Państwo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->label('Numer kontaktowy')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Adres e-mail')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pesel')
                    ->label('Numer PESEL')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Imię')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->label('Drugie imię')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nazwisko')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address_line_1')
                    ->label('Ulica')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address_line_2')
                ->label('Ulica 2')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('post_code')
                    ->label('Kod pocztowy')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city')
                    ->label('Miasto')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('province')
                    ->label('Województwo')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('country')
                    ->label('Państwo')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Numer kontaktowy')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Adres e-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pesel')
                    ->label('Numer PESEL')
                    ->searchable()
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
            'index' => Pages\ListContractors::route('/'),
            'create' => Pages\CreateContractor::route('/create'),
            'edit' => Pages\EditContractor::route('/{record}/edit'),
        ];
    }
}
