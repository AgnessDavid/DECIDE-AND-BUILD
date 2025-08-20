@extends('frontend.master')

@section('content')

<div class="container my-5">
    <h2>Votre Panier d'Achat</h2>

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if (count($panier) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $totalGeneral = 0; @endphp
                @foreach ($panier as $id => $details)
                    @php
                        $itemTotal = $details['prix'] * $details['quantite'];
                        $totalGeneral += $itemTotal;
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['titre'] }}" style="width: 80px;">
                        </td>
                        <td>{{ $details['titre'] }}</td>
                        <td>{{ number_format($details['prix'], 2) }} €</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="quantite" value="{{ $details['quantite'] }}" min="1" class="form-control w-25 me-2">
                                <button type="submit" class="btn btn-sm btn-info">Mettre à jour</button>
                            </form>
                        </td>
                        <td>{{ number_format($itemTotal, 2) }} €</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total du panier :</strong></td>
                    <td colspan="2"><strong>{{ number_format($totalGeneral, 2) }} €</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex justify-content-between">
            <a href="{{ url('/') }}" class="btn btn-secondary">Continuer mes achats</a>
            <form action="{{ route('cart.destroy') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">Vider le panier</button>
            </form>
            <a href="#" class="btn btn-success">Passer à la caisse</a>
        </div>
    @else
        <div class="alert alert-info">Votre panier est vide.</div>
        <a href="{{ url('/') }}" class="btn btn-secondary">Retour à la boutique</a>
    @endif
</div>

@endsection