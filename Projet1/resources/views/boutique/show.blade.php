@extends('layouts.app')

@section('content')
    <h1>{{ $carte->nom_produit }}</h1>

    <img src="{{ asset($carte->photo) }}" alt="{{ $carte->nom_produit }}">
    <p>{{ $carte->description }}</p>
    <p>Prix : {{ $carte->prix_unitaire_ht }} € HT</p>

    <form action="{{ route('commande.ajouter', $carte->id) }}" method="POST">
        @csrf
        <label>Quantité :</label>
        <input type="number" name="quantite" value="1" min="1">
        <button type="submit">Ajouter au panier</button>
    </form>
@endsection
