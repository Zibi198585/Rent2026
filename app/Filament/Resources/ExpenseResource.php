<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Contractor;
use App\Models\Product;
use App\Models\Warehouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function getPluralLabel(): string
    {
        return __('Wydatki');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                ->required()
                ->label('Data wydatku'),
            Forms\Components\Select::make('expense_type_id')
                ->relationship('expenseType', 'name')
                ->required()
                ->label('Typ wydatku')
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Nowy typ wydatku'),
                ]),
            Forms\Components\Select::make('contractor_id')
                ->relationship('contractor', 'first_name', fn (Builder $query) => $query->select(['id', 'first_name', 'last_name']))
                ->getOptionLabelUsing(fn ($value) => Contractor::find($value)->full_name)
                ->searchable()
                ->label('Kontrahent'),
            Forms\Components\TextInput::make('invoice_number')
                ->required()
                ->label('Numer faktury/dokumentu'),
            Forms\Components\TextInput::make('invoice_amount')
                ->required()
                ->numeric()
                ->label('Kwota faktury'),
            Forms\Components\Select::make('payment_status')
                ->options([
                    'paid' => 'Zapłacono',
                    'partially_paid' => 'Częściowo zapłacono',
                    'due' => 'Do zapłaty',
                ])
                ->required()
                ->label('Status zapłaty'),
            Forms\Components\Select::make('payment_method')
                ->options([
                    'cash' => 'Gotówka',
                    'transfer' => 'Przelew',
                ])
                ->required()
                ->label('Sposób płatności'),
            Forms\Components\DatePicker::make('payment_due_date')
                ->required()
                ->label('Termin płatności'),
            Forms\Components\Repeater::make('products')
                ->relationship()
                ->schema([
                    Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required()
                            ->label('Produkt'),
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->numeric()
                            ->label('Ilość')
                            ->reactive() // Make this field reactive
                            ->afterStateUpdated(function (callable $set, callable $get) {
                                $set('total_amount', $get('quantity') * $get('price_per_unit'));
                            }),
                        Forms\Components\TextInput::make('price_per_unit')
                            ->required()
                            ->numeric()
                            ->label('Cena za sztukę')
                            ->reactive() // Make this field reactive
                            ->afterStateUpdated(function (callable $set, callable $get) {
                                $set('total_amount', $get('quantity') * $get('price_per_unit'));
                            }),
                        Forms\Components\TextInput::make('total_amount')
                            ->disabled()
                            ->label('Łączna kwota')
                            ->numeric(),
                        Forms\Components\Select::make('warehouse_id')
                            ->relationship('warehouse', 'name')
                            ->required()
                            ->label('Magazyn'),
                    ])
                    ->label('Zakupione produkty'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Expense Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('amount')
                ->label('Amount')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('date')
                ->label('Date')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('warehouse.name')
                ->label('Warehouse')
                ->searchable(),
            Tables\Columns\TextColumn::make('product.name')
                ->label('Product')
                ->searchable(),
            Tables\Columns\TextColumn::make('quantity')
                ->label('Quantity')
                ->searchable(),
            Tables\Columns\TextColumn::make('expense_type')
                ->label('Expense Type')
                ->searchable(),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
