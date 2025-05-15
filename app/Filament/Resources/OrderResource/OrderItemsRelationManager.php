<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('productVariation.product.name')->label('Produto'),
                TextColumn::make('productVariation.name')->label('Variação'),
                TextColumn::make('quantidade')->label('Qtd'),
                TextColumn::make('preco_unitario')
                    ->label('Preço Unit.')
                    ->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
                TextColumn::make('total')
                    ->label('Total')
                    ->formatStateUsing(fn($record) => 'R$ ' . number_format(($record->preco_unitario * $record->quantidade) / 100, 2, ',', '.')),
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
