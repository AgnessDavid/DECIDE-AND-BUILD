<?php

namespace App\Filament\Resources\DemandeImpressions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DemandeImpressionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('demande_id')
                    ->numeric(),
                TextEntry::make('numero_ordre'),
                TextEntry::make('quantite_demandee')
                    ->numeric(),
                TextEntry::make('quantite_imprimee')
                    ->numeric(),
                TextEntry::make('date_demande')
                    ->date(),
                TextEntry::make('agent_commercial'),
                TextEntry::make('service'),
                TextEntry::make('date_visa_chef_service')
                    ->date(),
                TextEntry::make('nom_visa_chef_service'),
                TextEntry::make('date_autorisation')
                    ->date(),
                IconEntry::make('est_autorise_chef_informatique')
                    ->boolean(),
                TextEntry::make('nom_visa_autorisateur'),
                TextEntry::make('date_impression')
                    ->date(),
                TextEntry::make('quantite_totale_imprimee')
                    ->numeric(),
                TextEntry::make('nom_visa_agent_impression'),
                TextEntry::make('date_reception_stock')
                    ->date(),
                TextEntry::make('quantite_totale_receptionnee')
                    ->numeric(),


                TextEntry::make('nom_signature_final'),
                TextEntry::make('created_at')
                    ->dateTime(),

           
                // ✅ Statut avec badge coloré
                TextEntry::make('statut')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'en_attente' => 'warning',    // 🟡 Jaune
                        'en_production' => 'info',    // 🔵 Bleu
                        'terminer' => 'success',      // 🟢 Vert
                        default => 'gray',
                    }),

                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
