<?php

namespace App\Filament\Resources\Ventes;

use App\Filament\Resources\Ventes\Pages\CreateVente;
use App\Filament\Resources\Ventes\Pages\EditVente;
use App\Filament\Resources\Ventes\Pages\ListVentes;
use App\Filament\Resources\Ventes\Pages\ViewVente;
use App\Filament\Resources\Ventes\Schemas\VenteForm;
use App\Filament\Resources\Ventes\Schemas\VenteInfolist;
use App\Filament\Resources\Ventes\Tables\VentesTable;
use App\Models\Vente;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VenteResource extends Resource
{
    protected static ?string $model = Vente::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Vente';

    protected static UnitEnum|string|null $navigationGroup = 'Gestion Clients et Ventes';
    public static function form(Schema $schema): Schema
    {
        return VenteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VenteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VentesTable::configure($table);
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
            'index' => ListVentes::route('/'),
            'create' => CreateVente::route('/create'),
            'view' => ViewVente::route('/{record}'),
            'edit' => EditVente::route('/{record}/edit'),
        ];
    }
}
