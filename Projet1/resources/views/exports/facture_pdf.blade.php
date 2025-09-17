<!-- resources/views/exports/facture_pdf.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $facture->numero_facture }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; line-height: 1.4; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h1, h2, h3 { margin: 0; padding: 0; }
    </style>
</head>
<body>
    <h1>Facture : {{ $facture->numero_facture }}</h1>
    <p>Date : {{ $facture->date_facturation->format('d/m/Y') }}</p>
    <p>Client : {{ $facture->client->nom ?? 'Inconnu' }}</p>
    <p>Agent : {{ $facture->user->name ?? 'Inconnu' }}</p>
    <p>Statut de paiement : {{ ucfirst(str_replace('_', ' ', $facture->statut_paiement)) }}</p>

    <h3>Produits commandés :</h3>
    <table>
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
            @foreach($facture->produits_lignes as $ligne)
                <tr>
                    <td>{{ $ligne['nom'] }}</td>
                    <td>{{ $ligne['quantite'] }}</td>
                    <td>{{ number_format($ligne['prix_unitaire_ht'], 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($ligne['montant_ht'], 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($ligne['montant_ttc'], 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Totaux :</h3>
    <p>Montant HT : {{ number_format($facture->montant_ht, 0, ',', ' ') }} FCFA</p>
    <p>TVA : {{ $facture->tva }}%</p>
    <p>Montant TTC : {{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</p>

    @if($facture->notes)
        <h3>Notes :</h3>
        <p>{{ $facture->notes }}</p>
    @endif
</body>
</html>
