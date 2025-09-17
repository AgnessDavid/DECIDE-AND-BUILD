{{-- resources/views/exports/commande_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Commande #{{ $commande->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Facture Commande #{{ $commande->numero_commande }}</h1>
    <p><strong>Client :</strong> {{ $commande->client->nom }}</p>
    <p><strong>Agent :</strong> {{ $commande->user->name }}</p>
    <p><strong>Date :</strong> {{ $commande->date_commande->format('d/m/Y') }}</p>

    <h3>Produits commandés :</h3>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire (HT)</th>
                <th>Montant (HT)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->produits as $ligne)
            <tr>
                <td>{{ $ligne->produit->nom_produit }}</td>
                <td>{{ $ligne->quantite }}</td>
                <td>{{ number_format($ligne->prix_unitaire_ht, 0, ',', ' ') }} FCFA</td>
                <td>{{ number_format($ligne->montant_ht, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total HT :</strong> {{ number_format($commande->montant_ht, 0, ',', ' ') }} FCFA</p>
    <p><strong>TVA :</strong> {{ $commande->tva ?? 18 }}%</p>
    <p><strong>Total TTC :</strong> {{ number_format($commande->montant_ttc, 0, ',', ' ') }} FCFA</p>
</body>
</html>
