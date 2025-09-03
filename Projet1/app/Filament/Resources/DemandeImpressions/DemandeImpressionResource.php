<?php

namespace App\Filament\Resources\DemandeImpressions;

use App\Filament\Resources\DemandeImpressions\Pages\CreateDemandeImpression;
use App\Filament\Resources\DemandeImpressions\Pages\EditDemandeImpression;
use App\Filament\Resources\DemandeImpressions\Pages\ListDemandeImpressions;
use App\Filament\Resources\DemandeImpressions\Pages\ViewDemandeImpression;
use App\Filament\Resources\DemandeImpressions\Schemas\DemandeImpressionForm;
use App\Filament\Resources\DemandeImpressions\Schemas\DemandeImpressionInfolist;
use App\Filament\Resources\DemandeImpressions\Tables\DemandeImpressionsTable;
use App\Models\DemandeImpression;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DemandeImpressionResource extends Resource
{
    protected static ?string $model = DemandeImpression::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Demande Impressions';

    public static function form(Schema $schema): Schema
    {
        return DemandeImpressionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DemandeImpressionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemandeImpressionsTable::configure($table);
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
            'index' => ListDemandeImpressions::route('/'),
            'create' => CreateDemandeImpression::route('/create'),
            'view' => ViewDemandeImpression::route('/{record}'),
            'edit' => EditDemandeImpression::route('/{record}/edit'),
        ];
    }
}
