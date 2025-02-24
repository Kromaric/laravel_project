<?php
namespace App\Filament\Resources\PropertiesResource\RelationManagers;

use App\Models\Bookings;
use App\Models\Properties;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\RelationManager;
use Filament\Resources\RelationManagers\HasManyRelationManager;
;
use Filament\Tables;

class BookingsRelationManager 
{
    protected static string $relationship = 'bookings'; // Le nom de la relation

    protected static string $primaryColumn = 'id'; // La clé primaire de la table bookings

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Booking ID'),
                Tables\Columns\TextColumn::make('start_date')->label('Start Date'),
                Tables\Columns\TextColumn::make('end_date')->label('End Date'),
                Tables\Columns\TextColumn::make('total_price')->label('Total Price'),
                Tables\Columns\TextColumn::make('user.name')->label('User'), // Affiche le nom de l'utilisateur associé
                Tables\Columns\TextColumn::make('property.name')->label('Property'), // Affiche le nom de la propriété associée
            ])
            ->filters([
                // Ajouter des filtres ici si nécessaire
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Permet l'édition de la réservation
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Permet la suppression en masse
            ]);
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),

                Forms\Components\Select::make('property_id')
                    ->label('Property')
                    ->options(Properties::all()->pluck('name', 'id'))
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('End Date')
                    ->required(),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->required(),
            ]);
    }
}
