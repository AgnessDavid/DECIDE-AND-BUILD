@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8 text-center" data-aos="fade-down">Passer votre commande</h1>

    <div class="flex flex-col lg:flex-row gap-8">

        <!-- 🛒 Résumé du panier -->
        <div class="lg:w-2/3 bg-white rounded-lg shadow-md p-6" data-aos="fade-right">
            <h2 class="text-xl font-semibold mb-4">Résumé du panier</h2>

            @php
                $tva = 0.18;
                $totalHT = 0;
            @endphp

            @foreach($commande->produits as $produit)
                @php
                    $ligne = $produit->pivot;
                    $sousTotal = $ligne->quantite * $produit->prix_unitaire_ht;
                    $totalHT += $sousTotal;
                @endphp
                <div class="flex justify-between mb-2 border-b border-gray-200 py-2">
                    <span>{{ $produit->nom_produit }} (x{{ $ligne->quantite }})</span>
                    <span>€{{ number_format($ligne->quantite * $produit->prix_unitaire_ht * (1 + $tva), 2) }}</span>
                </div>
            @endforeach

            @php
                $montantTVA = $totalHT * $tva;
                $totalTTC = $totalHT + $montantTVA;
            @endphp

            <div class="mt-4 border-t border-gray-200 pt-4 space-y-2">
                <div class="flex justify-between">
                    <span>Sous-total (HT)</span>
                    <span>€{{ number_format($totalHT, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>TVA (18%)</span>
                    <span>€{{ number_format($montantTVA, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Livraison</span>
                    <span>Gratuite</span>
                </div>
                <div class="flex justify-between font-bold text-lg">
                    <span>Total TTC</span>
                    <span>€{{ number_format($totalTTC, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- 📦 Détails de livraison et paiement -->
        <div class="lg:w-1/3 space-y-6">

            <!-- Adresse -->
            <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-left">
                <h2 class="text-xl font-semibold mb-4">Adresse de livraison</h2>
                @if($adresse)
                    <p>{{ $adresse }}</p>
                @else
                    <p class="text-red-500">Aucune adresse enregistrée. Veuillez la renseigner dans votre profil.</p>
                @endif
            </div>

            <!-- Détails livraison -->
            <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-left">
                <h2 class="text-xl font-semibold mb-4">Détails de livraison</h2>
                <p>Livraison standard gratuite sous 3-5 jours ouvrés.</p>
            </div>

            <!-- Mode de paiement -->
            <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-left">
                <h2 class="text-xl font-semibold mb-4">Mode de paiement</h2>

                <form action="{{ route('panier.valider') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded transition duration-300">
                        Confirmer la commande et payer
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600 mb-2">Ou payer avec :</p>
                    <button
                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded flex items-center justify-center transition duration-300">
                        <i data-feather="credit-card" class="w-5 h-5 mr-2"></i>
                        Stripe
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, easing: 'ease-in-out', once: true });
        feather.replace();
    });
</script>
@endsection
