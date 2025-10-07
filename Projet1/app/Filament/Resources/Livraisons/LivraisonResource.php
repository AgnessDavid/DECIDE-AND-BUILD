<?php

namespace App\Filament\Resources\Livraisons;

use App\Filament\Resources\Livraisons\Pages\CreateLivraison;
use App\Filament\Resources\Livraisons\Pages\EditLivraison;
use App\Filament\Resources\Livraisons\Pages\ListLivraisons;
use App\Filament\Resources\Livraisons\Pages\ViewLivraison;
use App\Filament\Resources\Livraisons\Schemas\LivraisonForm;
use App\Filament\Resources\Livraisons\Schemas\LivraisonInfolist;
use App\Filament\Resources\Livraisons\Tables\LivraisonsTable;
use App\Models\Livraison;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LivraisonResource extends Resource
{
    protected static ?string $model = Livraison::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Livraison';

    public static function form(Schema $schema): Schema
    {
        return LivraisonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LivraisonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LivraisonsTable::configure($table);
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
            'index' => ListLivraisons::route('/'),
            'create' => CreateLivraison::route('/create'),
            'view' => ViewLivraison::route('/{record}'),
            'edit' => EditLivraison::route('/{record}/edit'),
        ];
    }
}
