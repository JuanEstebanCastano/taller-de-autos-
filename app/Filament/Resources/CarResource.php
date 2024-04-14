<?php

namespace App\Filament\Resources;

use App\Models\Car;
use Filament\Forms;
use Filament\Tables;
use App\Enums\CarBrand;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CarResource\RelationManagers;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $modelLabel = 'Carro';

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Datos del Carro')
                    ->schema([
                        Forms\Components\TextInput::make('plate_number')
                            ->label('Placa')
                            ->minLength(6)
                            ->maxLength(6)
                            ->required(),
                        Forms\Components\Select::make('brand')
                            ->options(CarBrand::class)
                            ->label('Marca')
                            ->required(),
                        Forms\Components\TextInput::make('model')
                            ->label('Modelo')
                            ->required(),
                        Forms\Components\TextInput::make('color')
                            ->label('Color')
                            ->required(),
                        Forms\Components\TextInput::make('year')
                            ->label('Año')
                            ->minValue(now()->subYears(50)->year)
                            ->maxValue(now()->addYears(1)->year)
                            ->step(1)
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('mileage')
                            ->label('Kilometraje')
                            ->minValue(0)
                            ->step(1)
                            ->required()
                            ->numeric(),
                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plate_number')
                    ->label('Placa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->label('Marca')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->label('Modelo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color')
                    ->label('Color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Año')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mileage')
                    ->numeric()
                    ->label('Kilometraje')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
