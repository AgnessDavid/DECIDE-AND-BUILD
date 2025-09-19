<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CARTE-CIGN - Rapport Caisses</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
        h2 { font-size: 14px; margin-top: 20px; }
        .products-table { margin-left: 20px; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <h1>CARTE-CIGN - Rapport Caisses</h1>
    <p>Généré le : {{ now()->format('d-m-Y H:i:s') }}</p>
    <table>
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>N° Commande</th>
                <th>Client</th>
                <th>Montant HT</th>
                <th>TVA</th>
                <th>Montant TTC</th>
                <th>Entrée</th>
                <th>Sortie</th>
                <th>Statut Paiement</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->user->name ?? 'N/A' }}</td>
                    <td>{{ $record->numero_commande ?? 'N/A' }}</td>
                    <td>{{ $record->nom_client ?? 'N/A' }}</td>
                    <td>{{ number_format($record->montant_ht, 2, ',', ' ') }} €</td>
                    <td>{{ number_format($record->tva, 2, ',', ' ') }} %</td>
                    <td>{{ number_format($record->montant_ttc, 2, ',', ' ') }} €</td>
                    <td>{{ number_format($record->entree, 2, ',', ' ') }} €</td>
                    <td>{{ number_format($record->sortie, 2, ',', ' ') }} €</td>
                    <td>{{ $record->statut_paiement }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($records as $index => $record)
        @if (!empty($record->produits_commande))
            <div @if ($index > 0) class="page-break" @endif>
                <h2>Détails des produits pour la commande {{ $record->numero_commande ?? 'N/A' }}</h2>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire HT</th>
                            <th>Montant HT</th>
                            <th>Montant TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($record->produits_commande as $produit)
                            <tr>
                                <td>{{ $produit['nom'] ?? 'N/A' }}</td>
                                <td>{{ $produit['quantite'] }}</td>
                                <td>{{ number_format($produit['prix_unitaire_ht'], 2, ',', ' ') }} €</td>
                                <td>{{ number_format($produit['montant_ht'], 2, ',', ' ') }} €</td>
                                <td>{{ number_format($produit['montant_ttc'], 2, ',', ' ') }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endforeach
</body>
</html>