@extends('layouts.app')

@section('content')
    <h1>Modifier la carte : {{ $carte->nom_produit }}</h1>

    <form action="{{ route('produit.update', $carte->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="nom_produit" value="{{ $carte->nom_produit }}" required>
        <input type="text" name="reference_produit" value="{{ $carte->reference_produit }}" required>
        <textarea name="description">{{ $carte->description }}</textarea>
        <input type="file" name="photo">
        <input type="text" name="type_carte" value="{{ $carte->type_carte }}">
        <input type="text" name="orientation" value="{{ $carte->orientation }}" required>
        <input type="number" name="latitude_centre" value="{{ $carte->latitude_centre }}" required>
        <input type="number" name="longitude_centre" value="{{ $carte->longitude_centre }}" required>
        <input type="number" name="prix_unitaire_ht" value="{{ $carte->prix_unitaire_ht }}" required>
        <input type="number" name="taux_tva" value="{{ $carte->taux_tva }}">
        <button type="submit">Mettre à jour</button>
    </form>
@endsection
