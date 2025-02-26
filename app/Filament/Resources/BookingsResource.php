<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingsResource\Pages;
use App\Filament\Resources\PropertiesResource\RelationManagers;
use App\Models\Bookings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingsResource extends Resource
{
    protected static ?string $model = Bookings::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('user_id')
                ->label('Utilisateur')
                ->relationship('user', 'name') // Suppose que User a une colonne 'name'
                ->required(),

            Forms\Components\Select::make('property_id')
                ->label('Propriété')
                ->relationship('property', 'name') // Suppose que Properties a une colonne 'name'
                ->required(),

            Forms\Components\DatePicker::make('start_date')
                ->label('Date de début')
                ->required(),

            Forms\Components\DatePicker::make('end_date')
                ->label('Date de fin')
                ->required(),

            Forms\Components\TextInput::make('total_price')
                ->label('Prix total')
                ->numeric()
                ->required(),
        ]);
    }


    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->label('Utilisateur')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('property.name')
                ->label('Propriété')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('start_date')
                ->label('Date de début')
                ->sortable()
                ->date(),

            Tables\Columns\TextColumn::make('end_date')
                ->label('Date de fin')
                ->sortable()
                ->date(),

            Tables\Columns\TextColumn::make('total_price')
                ->label('Prix total')
                ->sortable(),
        ])
        ->filters([ // Si tu veux ajouter des filtres plus tard
            // Exemple de filtre par date :
            Tables\Filters\Filter::make('start_date')
                ->form([
                    Forms\Components\DatePicker::make('start_date'),
                ])
                ->query(fn (Builder $query, array $data) => $query->whereDate('start_date', $data['start_date'])),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\BookingsRelationManager::class, // Relation avec les réservations

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBookings::route('/create'),
            'edit' => Pages\EditBookings::route('/{record}/edit'),
        ];
    }
}
