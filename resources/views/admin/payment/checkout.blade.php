@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-3">Checkout</h1>

        <form id="checkout-form" action="{{ route('checkout.process') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="card-number">Numero della carta di credito</label>
                <div id="card-number"></div>
            </div>

            <!-- Aggiungi qui i campi per la data di scadenza, il CVV e il nome del titolare della carta di credito -->

            <div class="form-group">
                <label for="amount">Importo da pagare</label>
                <input type="number" id="amount" name="amount" class="form-control" value="{{ $apartment->price }}">
            </div>

            <input type="hidden" id="nonce" name="payment_method_nonce">

            <button type="submit" class="btn btn-primary" id="submit-button">Paga ora</button>
        </form>
    </div>
@endsection
