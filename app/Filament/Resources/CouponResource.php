<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, DatePicker, Toggle};
use Filament\Tables\Columns\{TextColumn, BooleanColumn, IconColumn};

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('code')
                ->label('Código')
                ->unique(ignoreRecord: true)
                ->required(),
            TextInput::make('discount_percent')->label('Desconto (R$)')->numeric()->required()->formatStateUsing(fn($state) => $state / 100),
            TextInput::make('min_value')->label('Mínimo p/ aplicar (R$)')->numeric()->required(),
            DatePicker::make('valid_until')->label('Expira em')->required(),
            Toggle::make('ativo')->label('Ativo')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('code')->searchable(),
            TextColumn::make('discount_percent')->label('Desconto')->formatStateUsing(fn($state) => 'R$ ' . number_format($state / 100, 2, ',', '.')),
            BooleanColumn::make('ativo')->label('Ativo'),
            TextColumn::make('valid_until')->label('Expira em')->date(),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
