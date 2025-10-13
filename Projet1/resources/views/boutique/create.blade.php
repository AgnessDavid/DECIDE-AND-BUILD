@extends('layouts.app')

@section('content')
    <h1>Ajouter une nouvelle carte</h1>

    <form action="{{ route('produit.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nom_produit" placeholder="Nom de la carte" required>
        <input type="text" name="reference_produit" placeholder="Référence" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="file" name="photo">
        <input type="text" name="type_carte" placeholder="Type de carte">
        <input type="text" name="orientation" placeholder="Orientation" required>
        <input type="number" name="latitude_centre" placeholder="Latitude" required>
        <input type="number" name="longitude_centre" placeholder="Longitude" required>
        <input type="number" name="prix_unitaire_ht" placeholder="Prix HT" required>
        <input type="number" name="taux_tva" placeholder="TVA">
        <button type="submit">Créer</button>
    </form>
@endsection
