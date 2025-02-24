<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertiesResource\Pages;
use App\Filament\Resources\PropertiesResource\RelationManagers;
use App\Models\Properties;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertiesResource extends Resource
{
    protected static ?string $model = Properties::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name') // champ 'name'
                    ->required()
                    ->label('Nom de la propriété'),
                Forms\Components\RichEditor::make('description') // champ 'adresse'
                    ->label('Description')
                    ->columnSpan(2),
                Forms\Components\TextInput::make('price_per_night') // champ 'prix'
                    ->numeric()
                    ->label(' Prix par nuit'),
                Forms\Components\TextInput::make('location') // champ 'capacité'
                    ->label('Localisation'),
                Forms\Components\TextInput::make('capacity') // champ 'capacité'
                    ->numeric()
                    ->label('Capacité d\'accueil'),
                Forms\Components\FileUpload::make('image') // champ 'image'
                    ->image()
                    ->label('Image'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name') // Affiche le nom de la propriété
                    ->label('Nom de la propriété')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_night') // Affiche le prix de la propriété
                    ->label('Prix par nuit')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location') // Affiche la date de création
                    ->label('Localisation')
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity') // Affiche la date de création
                    ->label('Capacité d\'accueil')
                    ->sortable(),

            ])
            ->filters([
                // Tu peux ajouter des filtres ici si nécessaire
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Permet d'éditer l'enregistrement
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Permet de supprimer plusieurs enregistrements
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            // RelationManagers\BookingsRelationManager::class, // Relation avec les réservations
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperties::route('/create'),
            'edit' => Pages\EditProperties::route('/{record}/edit'),
        ];
    }
}
