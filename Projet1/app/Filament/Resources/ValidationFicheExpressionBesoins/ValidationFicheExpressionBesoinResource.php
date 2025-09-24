<?php

namespace App\Filament\Resources\ValidationFicheExpressionBesoins;

use App\Filament\Resources\ValidationFicheExpressionBesoins\Pages\CreateValidationFicheExpressionBesoin;
use App\Filament\Resources\ValidationFicheExpressionBesoins\Pages\EditValidationFicheExpressionBesoin;
use App\Filament\Resources\ValidationFicheExpressionBesoins\Pages\ListValidationFicheExpressionBesoins;
use App\Filament\Resources\ValidationFicheExpressionBesoins\Pages\ViewValidationFicheExpressionBesoin;
use App\Filament\Resources\ValidationFicheExpressionBesoins\Schemas\ValidationFicheExpressionBesoinForm;
use App\Filament\Resources\ValidationFicheExpressionBesoins\Schemas\ValidationFicheExpressionBesoinInfolist;
use App\Filament\Resources\ValidationFicheExpressionBesoins\Tables\ValidationFicheExpressionBesoinsTable;
use App\Models\ValidationFicheExpressionBesoin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ValidationFicheExpressionBesoinResource extends Resource
{
    protected static ?string $model = ValidationFicheExpressionBesoin::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Validation Fiche Expression';

    public static function form(Schema $schema): Schema
    {
        return ValidationFicheExpressionBesoinForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ValidationFicheExpressionBesoinInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ValidationFicheExpressionBesoinsTable::configure($table);
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
            'index' => ListValidationFicheExpressionBesoins::route('/'),
            'create' => CreateValidationFicheExpressionBesoin::route('/create'),
            'view' => ViewValidationFicheExpressionBesoin::route('/{record}'),
            'edit' => EditValidationFicheExpressionBesoin::route('/{record}/edit'),
        ];
    }
}
