<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados do Produto')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),

                    ]),

                Section::make('Variações')
                    ->schema([
                        Repeater::make('variations')
                            ->label('Variações')
                            ->relationship()
                            ->schema([
                                TextInput::make('name')->label('Variação')->required(),
                                TextInput::make('price')
                                    ->label('Preço (R$)')
                                    ->required()
                                    ->numeric()
                                    ->suffix('R$')
                                    ->formatStateUsing(fn($state) => $state / 100),
                                \Filament\Forms\Components\Fieldset::make('Estoque')
                                    ->relationship('stock')
                                    ->schema([
                                        TextInput::make('quantity')
                                            ->label('Estoque')
                                            ->numeric()
                                            ->required(),
                                    ]),

                            ])
                            ->defaultItems(1)
                            ->columns(3)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nome')->searchable(),
                TextColumn::make('variations_sum_stock')
                    ->label('Estoque Total')
                    ->getStateUsing(function (Product $record) {
                        return $record
                            ->variations
                            ->loadMissing('stock')
                            ->sum(fn($v) => $v->stock->quantity ?? 0);
                    }),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['variations.stock']);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
