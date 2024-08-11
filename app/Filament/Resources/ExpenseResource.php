<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Expense;
use App\Models\Product;
use Filament\Forms\Form;
use App\Models\Warehouse;
use App\Models\Contractor;
use Filament\Tables\Table;
use App\Models\ExpenseType;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ExpenseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ExpenseResource\RelationManagers;


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

            // Forms\Components\Select::make('expense_type_id')
            //     ->relationship('expenseType', 'name')
            //     ->required()
            //     ->label('Typ wydatku')
            //     ->reactive()
            //     ->afterStateUpdated(function (callable $set, $state) {
            //         $type = ExpenseType::find($state);
            //         $set('show_products', $type?->affects_inventory ?? false);
            //     })
            //     ->default(function (callable $get) {
            //         $type = ExpenseType::find($get('expense_type_id'));
            //         return $type?->id;
            //     }),

            Forms\Components\Select::make('expense_type_id')
                ->relationship('expenseType', 'name')
                ->required()
                ->label('Typ wydatku')
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state) {
                    $type = ExpenseType::find($state);
                    $set('show_products', $type?->affects_inventory ?? false);
                })
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Nowy typ wydatku'),
                    Forms\Components\Toggle::make('affects_inventory')
                        ->label('Czy wydatek wpływa na magazyn?')
                        ->default(false),
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
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, callable $get) {
                            $set('total_amount', $get('quantity') * $get('price_per_unit'));
                        }),

                    Forms\Components\TextInput::make('price_per_unit')
                        ->required()
                        ->numeric()
                        ->label('Cena za sztukę')
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, callable $get) {
                            $set('total_amount', $get('quantity') * $get('price_per_unit'));
                        }),

                    Forms\Components\TextInput::make('total_amount')
                        ->readonly()
                        ->numeric()
                        ->label('Łączna kwota')
                        ->default(function (callable $get) {
                            return $get('quantity') * $get('price_per_unit');
                        }),

                    Forms\Components\Select::make('warehouse_id')
                        ->relationship('warehouse', 'name')
                        ->required()
                        ->label('Magazyn'),
                ])
                ->hidden(function (callable $get) {
                    $type = ExpenseType::find($get('expense_type_id'));
                    Log::info('Repeater hidden status: ' . (!$type?->affects_inventory));
                    return !$type?->affects_inventory;
                })
                ->label('Zakupione produkty')
                ->afterStateHydrated(function (callable $set, callable $get, $state) {
                    Log::info('Repeater state hydrated: ', $state);
                }),
        ]);



    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Data wydatku')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expenseType.name')
                    ->label('Typ wydatku')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contractor.full_name')
                    ->label('Kontrahent')
                    ->searchable(),
                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Numer faktury/dokumentu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('invoice_amount')
                    ->label('Kwota faktury')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Status zapłaty')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Sposób płatności')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_due_date')
                    ->label('Termin płatności')
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
