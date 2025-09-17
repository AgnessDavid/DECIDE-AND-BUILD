<?php

namespace App\Filament\Resources\Factures\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use App\Models\Commande;
use App\Models\Produit;

class FactureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Sélection de la commande
                Select::make('commande_id')
                    ->relationship('commande', 'numero_commande')
                    ->label('Commande')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $commande = Commande::with('client', 'user', 'produits.produit')->find($state);
                            if ($commande) {
                                $set('client_id', $commande->client_id);
                                $set('user_id', $commande->user_id);
                                $set('montant_ht', $commande->montant_ht);
                                $set('tva', 18.0);
                                $set('montant_ttc', $commande->montant_ttc);
                                $set('notes', $commande->notes_internes);
                            }
                        }
                    }),

                // Client (affichage seulement)
                Select::make('client_id')
                    ->relationship('client', 'nom')
                    ->label('Client')
                    ->disabled()
                    ->dehydrated(false),

                // Agent
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Agent')
                    ->disabled()
                    ->dehydrated(false),

                // Numéro de facture
                TextInput::make('numero_facture')
                    ->label('Numéro de facture')
                    ->required(),

                // Date de facturation
                DatePicker::make('date_facturation')
                    ->label('Date de facturation')
                    ->required(),

                // Statut paiement
                Select::make('statut_paiement')
                    ->label('Statut paiement')
                    ->options([
                        'non_paye' => 'Non payé',
                        'paye' => 'Payé',
                    ])
                    ->default('non_paye')
                    ->required(),

                // Montants
               
            TextInput::make('montant_ht')
                ->label('Montant HT')
                ->disabled()
                ->default(fn ($record) => $record->montant_ht)
                ->required(),


                TextInput::make('tva')
                    ->label('TVA (%)')
                    ->numeric()
                    ->disabled()
                    ->required(),

               
            TextInput::make('montant_ttc')
                ->label('Montant TTC')
                ->disabled()
                ->default(fn ($record) => $record->montant_ttc)
                ->required(),






                // Produits de la commande (affichage seulement)
                Repeater::make('produits_lignes')
                    ->label('Produits commandés')
                    ->schema([
                        TextInput::make('nom')->label('Produit')->disabled(),
                        TextInput::make('quantite')->label('Quantité')->disabled(),
                        TextInput::make('prix_unitaire_ht')->label('Prix unitaire HT')->disabled(),
                        TextInput::make('montant_ht')->label('Montant HT')->disabled(),
                        TextInput::make('montant_ttc')->label('Montant TTC')->disabled(),
                    ])
                    ->columns(5)
                    ->disabled()
                    ->dehydrated(false),

                // Notes
                Textarea::make('notes')
                    ->label('Notes')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }
}
