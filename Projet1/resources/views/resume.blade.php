<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résumé de la commande - Cartologue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="font-sans bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex space-x-7">
                    <a href="{{ route('accueil') }}" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-2xl">Cartologue</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('accueil') }}" class="py-4 px-2 text-blue-500 border-b-4 border-blue-500 font-semibold">Accueil</a>
                        <a href="{{ route('boutique') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Boutique</a>
                        <a href="{{ route('panier') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Panier</a>
                        <a href="{{ route('contact') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section Résumé -->
    <section class="py-28 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8 space-y-6">

                <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Résumé de votre commande</h2>

                @if(isset($commande))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <!-- Client -->
                    <div class="bg-blue-50 p-4 rounded shadow" data-aos="fade-up">
                        <h3 class="text-lg font-semibold mb-2">Informations du client</h3>
                        <p><strong>Nom :</strong> {{ $commande->client->name ?? auth()->user()->name ?? '-' }}</p>
                        <p><strong>Email :</strong> {{ $commande->client->email ?? auth()->user()->email ?? '-' }}</p>
                    </div>

                    <!-- Livraison -->
                    <div class="bg-gray-100 p-4 rounded shadow" data-aos="fade-up">
                        <h3 class="text-lg font-semibold mb-2">Adresse de livraison</h3>
                        @if($commande->livraison)
                            <p><strong>Adresse :</strong> {{ $commande->livraison->adresse ?? '-' }}</p>
                            <p><strong>Téléphone :</strong> {{ $commande->livraison->numero_tel ?? '-' }}</p>
                            <p><strong>Ville :</strong> {{ $commande->livraison->ville ?? '-' }}</p>
                            <p><strong>Code postal :</strong> {{ $commande->livraison->code_postal ?? '-' }}</p>
                            <p><strong>Pays :</strong> {{ $commande->livraison->pays ?? '-' }}</p>
                        @else
                            <p class="text-gray-500">Aucune adresse définie</p>
                        @endif
                    </div>

                    <!-- Commande -->
                    <div class="bg-gray-50 p-4 rounded shadow" data-aos="fade-up">
                        <h3 class="text-lg font-semibold mb-2">Informations de la commande</h3>
                        <p><strong>Numéro :</strong> {{ $commande->numero_commande ?? '-' }}</p>
                        <p><strong>Date :</strong> {{ $commande->date_commande ? $commande->date_commande: '-' }}</p>
                        <p><strong>Total TTC :</strong> {{ number_format($commande->total_ttc ?? 0, 2, ',', ' ') }} FCFA</p>
                        <p><strong>État :</strong> 
                            <span class="px-2 py-1 rounded {{ $commande->etat == 'payée' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($commande->etat ?? 'en attente') }}
                            </span>
                        </p>
                    </div>


                    <!-- Paiement -->
                    <div class="bg-white p-4 rounded shadow" data-aos="fade-up">
                        <h3 class="text-lg font-semibold mb-2">Mode de paiement</h3>
                        @if($commande->paiement && $commande->paiement->mode)
                            <p>
                                <strong>Méthode :</strong>
                                @switch($commande->paiement->mode)
                                    @case('carte')
                                        Carte bancaire
                                        @break
                                    @case('mobile_money')
                                        Mobile Money
                                        @break
                                    @case('paypal')
                                        PayPal
                                        @break
                                    @case('stripe')
                                        Stripe
                                        @break
                                    @case('livraison')
                                        Paiement à la livraison
                                        @break
                                    @default
                                        Non renseigné
                                @endswitch
                            </p>
                            <p><strong>Référence :</strong> {{ $commande->paiement->reference ?? 'N/A' }}</p>
                        @else
                            <p><strong>Méthode :</strong> Non renseigné</p>
                        @endif
                    </div>
                </div>

           <!-- Produits -->
<div class="bg-white p-4 rounded shadow" data-aos="fade-up">
    <h3 class="text-lg font-semibold mb-4">Produits commandés</h3>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b bg-gray-100">
                <th class="py-2 px-2">Produit</th>
                <th class="py-2 px-2 text-center">Quantité</th>
                <th class="py-2 px-2 text-right">Prix unitaire HT</th>
                <th class="py-2 px-2 text-right">Montant HT</th>
                <th class="py-2 px-2 text-right">TVA (18%)</th>
                <th class="py-2 px-2 text-right">Montant TTC</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $total_ht = 0; 
                $total_tva = 0;
                $total_ttc = 0;
            @endphp

            @foreach($commande->produits as $produit)
                @php
                    $ligne = $produit->pivot;
                    $prix_ht = $ligne->prix_unitaire_ht;
                    $quantite = $ligne->quantite;
                    $montant_ht = $prix_ht * $quantite;
                    $tva = $montant_ht * 0.18;
                    $montant_ttc = $montant_ht + $tva;

                    $total_ht += $montant_ht;
                    $total_tva += $tva;
                    $total_ttc += $montant_ttc;
                @endphp
                <tr class="border-b">
                    <td class="py-2 px-2">{{ $produit->nom_produit }}</td>
                    <td class="py-2 px-2 text-center">{{ $quantite }}</td>
                    <td class="py-2 px-2 text-right">{{ number_format($prix_ht, 2, ',', ' ') }} FCFA</td>
                    <td class="py-2 px-2 text-right">{{ number_format($montant_ht, 2, ',', ' ') }} FCFA</td>
                    <td class="py-2 px-2 text-right">{{ number_format($tva, 2, ',', ' ') }} FCFA</td>
                    <td class="py-2 px-2 text-right">{{ number_format($montant_ttc, 2, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="font-semibold border-t">
            <tr>
                <td colspan="3" class="text-right py-2 px-2">Total HT</td>
                <td class="py-2 px-2 text-right">{{ number_format($total_ht, 2, ',', ' ') }} FCFA</td>
                <td class="py-2 px-2 text-right">{{ number_format($total_tva, 2, ',', ' ') }} FCFA</td>
                <td class="py-2 px-2 text-right">{{ number_format($total_ttc, 2, ',', ' ') }} FCFA</td>
            </tr>
        </tfoot>
    </table>
</div>


             

                 <div class="text-center mt-8">
                   <a href="{{ route('afficher.paiement', ['commandeId' => $commande->id]) }}" class="btn btn-primary">
                 Payer maintenant
                 </a>
                </div>

                   <div class="text-center mt-8">
                    <a href="{{ route('accueil') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition">
                        Retour à vos achats
                    </a>
                </div>

                @else
                    <p class="text-center text-red-500">Aucune commande trouvée.</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="text-gray-400 text-sm">&copy; 2025 Cartologue. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
            feather.replace();
        });
    </script>

</body>
</html>
