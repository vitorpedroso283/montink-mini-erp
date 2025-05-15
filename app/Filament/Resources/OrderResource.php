<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('cep')->label('CEP')->disabled(),
            TextInput::make('endereco')->label('Endereço')->disabled(),
            TextInput::make('subtotal')->label('Subtotal')->disabled()->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
            TextInput::make('frete')->label('Frete')->disabled()->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
            TextInput::make('total')->label('Total')->disabled()->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
            Select::make('status')
                ->options([
                    'pendente' => 'Pendente',
                    'pago' => 'Pago',
                    'enviado' => 'Enviado',
                    'cancelado' => 'Cancelado',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('#')->sortable(),
            TextColumn::make('total')->label('Total')->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
            BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pendente',
                    'success' => 'pago',
                    'info' => 'enviado',
                    'danger' => 'cancelado',
                ])
                ->label('Status'),
            TextColumn::make('created_at')->label('Criado em')->dateTime('d/m/Y H:i'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
