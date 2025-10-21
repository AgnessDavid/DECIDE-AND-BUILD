<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - Cartologue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        .transition-all { transition: all 0.3s ease; }
        #wave-qr {
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.4s ease;
        }
        #wave-qr:not(.hidden) {
            opacity: 1;
            transform: scale(1);
        }
    </style>
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
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-blue-500 hover:text-white transition duration-300">Connexion</a>
                    <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300">Inscription</a>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <i data-feather="menu" class="w-6 h-6 text-gray-500"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden mobile-menu bg-white shadow-md">
            <ul>
                <li><a href="{{ route('accueil') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-500 hover:text-white transition">Accueil</a></li>
                <li><a href="{{ route('boutique') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-500 hover:text-white transition">Boutique</a></li>
                <li><a href="{{ route('panier') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-500 hover:text-white transition">Panier</a></li>
                <li><a href="{{ route('contact') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-500 hover:text-white transition">Contact</a></li>
                <li><a href="{{ route('login') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-500 hover:text-white transition">Connexion</a></li>
                <li><a href="{{ route('register') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-500 hover:text-white transition">Inscription</a></li>
            </ul>
        </div>
    </nav>

    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8 space-y-6">

                <h2 class="text-2xl font-semibold mb-6 text-center">Effectuer votre paiement</h2>

                {{-- Messages --}}
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if(isset($commande) && isset($mode))
                <div class="grid grid-cols-1 gap-6 mb-6">

                    {{-- Infos Client --}}
                    <div class="bg-blue-50 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2">Informations du client</h3>
                        <p class="text-gray-700"><span class="font-medium">Nom :</span> {{ $commande->client->name ?? auth()->user()->name }}</p>
                        <p class="text-gray-700"><span class="font-medium">Email :</span> {{ $commande->client->email ?? auth()->user()->email }}</p>
                    </div>

                    {{-- Adresse Livraison --}}
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2">Adresse de livraison</h3>
                        @if($commande->livraison)
                            <p class="text-gray-700"><span class="font-medium">Adresse :</span> {{ $commande->livraison->adresse ?? '-' }}</p>
                            <p class="text-gray-700"><span class="font-medium">Téléphone :</span> {{ $commande->livraison->numero_tel ?? '-' }}</p>
                            <p class="text-gray-700"><span class="font-medium">Ville :</span> {{ $commande->livraison->ville ?? '-' }}</p>
                            <p class="text-gray-700"><span class="font-medium">Code postal :</span> {{$commande->livraison->code_postal ?? '-' }}</p>
                            <p class="text-gray-700"><span class="font-medium">Pays :</span> {{ $commande->livraison->pays ?? '-' }}</p>
                        @else
                            <p class="text-gray-500">Aucune adresse définie</p>
                        @endif
                    </div>

                    {{-- Infos Commande --}}
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-lg mb-2">Informations de la commande</h3>
                        <p><span class="font-medium">Commande :</span> {{ $commande->numero_commande ?? '-' }}</p>
                        <p><span class="font-medium">Montant total :</span> {{ number_format($commande->total_ttc ?? 0, 2, ',', ' ') }} FCFA</p>
                        <p><span class="font-medium">Mode choisi :</span> {{ ucfirst(str_replace('_', ' ', $mode)) }}</p>
                    </div>

                    {{-- Résumé du panier --}}
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2">Résumé du panier</h3>
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th class="border-b py-2">Produit</th>
                                    <th class="border-b py-2">Quantité</th>
                                    <th class="border-b py-2">Prix unitaire</th>
                                    <th class="border-b py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($commande->produits as $produit)
                                    @php
                                        $ligne = $produit->pivot;
                                        $sousTotal = $ligne->quantite * $produit->prix_unitaire_ht;
                                        $total += $sousTotal;
                                    @endphp
                                    <tr>
                                        <td class="py-2">{{ $produit->nom_produit }}</td>
                                        <td class="py-2">{{ $ligne->quantite }}</td>
                                        <td class="py-2">{{ number_format($produit->prix_unitaire_ht, 2, ',', ' ') }} FCFA</td>
                                        <td class="py-2">{{ number_format($sousTotal, 2, ',', ' ') }} FCFA</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t font-semibold">
                                    <td colspan="3" class="py-2 text-right">Total TTC</td>
                                    <td class="py-2">{{ number_format($total * 1.18, 2, ',', ' ') }} FCFA</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- QR Wave --}}
                    @if($showWaveQr)
                    <div id="wave-qr" class="mt-6 text-center">
                        <p class="mb-2">Scannez ce code QR avec Wave :</p>
                        <iframe src="{{ asset('images/wave_qr.pdf') }}" class="mx-auto w-64 h-64 border mb-2" width="500px" height="500px"></iframe>
                        <p><a href="{{ asset('images/wave_qr.pdf') }}" target="_blank" class="text-blue-500 underline">Ouvrir le QR dans un nouvel onglet</a></p>

                        <form action="{{ route('confirmer.wave.post', $commande->id) }}" method="POST" class="mt-4 max-w-sm mx-auto">
                            @csrf
                            <div class="mb-4">
                                <label for="montant" class="block text-gray-700 font-medium mb-2">
                                    Montant payé (FCFA)
                                </label>
                                <input type="number" name="montant" id="montant" 
                                       class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="{{ number_format($commande->total_ttc, 2, ',', ' ') }}" 
                                       required min="0" step="0.01">
                            </div>
                            <button type="submit" 
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">
                                J’ai effectué le paiement
                            </button>
                        </form>
                    </div>
                    @endif

                </div>

                {{-- Autres moyens de paiement --}}
                @if(!in_array($mode, ['wave']) && in_array($mode, [
                    \App\Enums\MoyenPaiement::MOOV_MONEY->value,
                    \App\Enums\MoyenPaiement::MTN_MONEY->value,
                    \App\Enums\MoyenPaiement::ORANGE_MONEY->value,
                    \App\Enums\MoyenPaiement::PAYPAL->value,
                    \App\Enums\MoyenPaiement::STRIPE->value,
                    \App\Enums\MoyenPaiement::CARTE->value,
                ]))
                <form action="{{ route('afficher.paiement', $commande->id ?? 0) }}" method="POST" class="space-y-4 mt-4 bg-white p-4 rounded-lg shadow-sm">
                    @csrf
                    @if($mode === 'mobile_money')
                        <div>
                            <label for="numero_mobile" class="block font-medium text-gray-700 mb-2">Numéro Mobile Money</label>
                            <input type="text" name="numero_mobile" id="numero_mobile"
                                   class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Ex: 225 01 23 45 67"
                                   required>
                        </div>
                        <div>
                            <label for="operateur" class="block font-medium text-gray-700 mb-2">Opérateur</label>
                            <select name="operateur" id="operateur"
                                    class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="">Sélectionnez votre opérateur</option>
                                <option value="mtn">MTN</option>
                                <option value="moov">Moov</option>
                                <option value="orange">Orange</option>
                            </select>
                        </div>
                    @endif

                    @if(in_array($mode, ['paypal', 'stripe', 'carte']))
                        <div>
                            <label for="numero_carte" class="block font-medium text-gray-700 mb-2">Numéro de carte</label>
                            <input type="text" name="numero_carte" id="numero_carte"
                                   class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="1234 5678 9012 3456"
                                   required>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label for="date_expiration" class="block font-medium text-gray-700 mb-2">Date d'expiration</label>
                                <input type="text" name="date_expiration" id="date_expiration"
                                       class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="MM/AA"
                                       required>
                            </div>
                            <div class="w-1/2">
                                <label for="cvc" class="block font-medium text-gray-700 mb-2">CVC</label>
                                <input type="text" name="cvc" id="cvc"
                                       class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="123"
                                       required>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">
                        Confirmer le paiement
                    </button>
                </form>
                @endif

                @else
                <p class="text-red-600 text-center">Erreur : commande ou mode de paiement non défini.</p>
                @endisset

            </div>
        </div>
    </section>

    <div class="text-center mt-4">
        <a href="{{ route('accueil')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
           Retour à vos achats
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400 text-sm">&copy; 2025 Cartologue. Tous droits réservés.</p>
        </div>
    </footer>

<script>
    // Mobile menu toggle
    const btn = document.querySelector(".mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");
    btn.addEventListener("click", () => menu.classList.toggle("hidden"));

    document.addEventListener('DOMContentLoaded', () => {
        AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
        feather.replace();
    });
</script>

</body>
</html>
