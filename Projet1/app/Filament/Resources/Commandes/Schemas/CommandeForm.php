<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;

class CommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Agent')
                    ->required(),

                Select::make('client_id')
    ->relationship('client', 'nom')
    ->label('Client')
    ->required()
    ->searchable()
    ->preload()
    ->createOptionForm([
        TextInput::make('nom')
            ->label('Nom')
            ->required(),

        Select::make('type')
            ->label('Type')
            ->options(\App\Models\Client::TYPES)
            ->required(),

        TextInput::make('nom_interlocuteur')
            ->label('Nom interlocuteur'),

        TextInput::make('fonction')
            ->label('Fonction'),

        TextInput::make('telephone')
            ->label('Téléphone'),

        TextInput::make('cellulaire')
            ->label('Cellulaire'),

        TextInput::make('fax')
            ->label('Fax'),

        TextInput::make('email')
            ->label('Email')
            ->email(),

        TextInput::make('ville')
            ->label('Ville'),

        TextInput::make('quartier_de_residence')
            ->label('Quartier de résidence'),

        Select::make('usage')
            ->label('Usage')
            ->options(\App\Models\Client::USAGES),
            
        TextInput::make('domaine_activite')
            ->label('Domaine d’activité'),
    ]),

                DatePicker::make('date_commande')
                    ->label('Date de commande')
                    ->required(),
TextInput::make('numero_commande')
    ->label('Numéro de commande')
    ->disabled() // utilisateur ne peut pas modifier
    ->default(fn () => 'CMD-BNET-XX') // facultatif, juste pour montrer un placeholder
    ->required(),


   Repeater::make('produits')
    ->label('Produits commandés')
    ->relationship('produits')
    ->schema([
        Select::make('produit_id')
            ->relationship('produit', 'nom_produit')
            ->label('Produit')
            ->required()
            ->searchable()
            ->reactive()
            ->afterStateUpdated(function ($state, callable $set, $get, $livewire) {
                if ($state) {
                    $produit = \App\Models\Produit::find($state);
                    if ($produit) {
                        $set('prix_unitaire_ht', $produit->prix_unitaire_ht);

                        // Montants initiaux
                        $quantite = $get('quantite') ?? 1;
                        $set('montant_ht', $produit->prix_unitaire_ht * $quantite);
                        $set('montant_ttc', $produit->prix_unitaire_ht * $quantite * 1.18);

                        // Stocks
                        $set('stock_actuel', $produit->stock_actuel);
                        $set('stock_minimum', $produit->stock_minimum);
                        $set('stock_maximum', $produit->stock_maximum);

                        // Validation quantité vs stock
                        if ($quantite > $produit->stock_actuel) {
                            $livewire->notify('danger', "La quantité demandée ({$quantite}) dépasse le stock disponible ({$produit->stock_actuel}) !");
                            // Optionnel : ajuster automatiquement la quantité
                            //$set('quantite', $produit->stock_actuel);
                        }
                    }
                }
            })
            ->columnSpan(2),


TextInput::make('quantite')
    ->label('Quantité')
    ->numeric()
    ->required()
    ->reactive()
    ->afterStateUpdated(function ($state, callable $set, $get) {
        $prix = $get('prix_unitaire_ht') ?? 0;
        $stockActuel = $get('stock_actuel') ?? 0;

        // Validation : quantité > stock
        if ($state > $stockActuel) {
            // Notification Filament
            Notification::make()
                ->title('Stock insuffisant')
                ->body("La quantité demandée ({$state}) dépasse le stock disponible ({$stockActuel}) !")
                ->danger()
                ->send();

            // Ajuster la quantité automatiquement si tu veux
            $set('quantite', $stockActuel);
        }

        // Recalcul des montants HT et TTC
        $set('montant_ht', $prix * $get('quantite'));
        $set('montant_ttc', $prix * $get('quantite') * 1.18);
    })
    ->columnSpan(2),



  TextInput::make('stock_actuel')
            ->label('Stock actuel')
            ->disabled()
            ->dehydrated(false)
            ->columnSpan(2),

  

  TextInput::make('stock_minimum')
            ->label('Stock minimun')
            ->disabled()
            ->dehydrated(false)
            ->columnSpan(2),


  TextInput::make('stock_maximun')
            ->label('Stock maximun')
            ->disabled()
            ->dehydrated(false)
            ->columnSpan(2),



        TextInput::make('prix_unitaire_ht')
            ->label('Prix unitaire HT')
            ->numeric()
            ->required()
            ->reactive()
            ->afterStateUpdated(function ($state, callable $set, $get) {
                $set('montant_ht', $get('quantite') * ($state ?? 0));
                $set('montant_ttc', $get('quantite') * ($state ?? 0) * 1.18);
            })
            ->columnSpan(2),

        TextInput::make('montant_ht')
            ->label('Montant HT')
            ->disabled()
            ->default(0)
            ->dehydrated(false)
            ->columnSpan(2),

        TextInput::make('montant_ttc')
            ->label('Montant TTC')
            ->disabled()
            ->default(0)
            ->dehydrated(false)
            ->columnSpan(2),
    ])
    ->columns(6) // grille en 6 colonnes
    ->createItemButtonLabel('Ajouter un produit'),



    TextInput::make('produit_non_satisfait')
  ->label(('Produit non satisfait')),


              Textarea::make('notes_internes')
              ->label('Notes internes'),
              //->columnSpanFull()
              //->rows(5),




              
                Select::make('moyen_de_paiement')
                    ->label('Mode de paiement')
                    ->options([
                        'en_ligne' => 'En ligne',
                        'especes' => 'Espèces',
                        'cheque' => 'Chèque',
                        'virement_bancaire' => 'Virement bancaire',
                    ])
                    ->required(),

                Select::make('statut_paiement')
                    ->label('Statut paiement')
                    ->options([
                        'Impayé' => 'Impayé',
                        'payé' => 'Payé',
                        
                    ])
                    ->default('Impayé')
                    ->required(),
            ]);
    }
}


