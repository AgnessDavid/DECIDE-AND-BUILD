@extends('frontend.master')

@section('content')
<h1>Mon Panier</h1>

@if(Cart::count() > 0)
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach(Cart::content() as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->price }} €</td>
            <td>{{ $item->subtotal() }} €</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p>Total du panier : {{ Cart::total() }} €</p>

<form action="{{ route('checkout') }}" method="POST">
    @csrf
    <button type="submit">Valider la commande</button>
</form>

@else
<p>Votre panier est vide.</p>
@endif
@endsection
