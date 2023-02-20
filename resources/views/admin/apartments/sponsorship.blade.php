@extends('layouts.admin')

@section('content')
    <form id="payment-form" method="post" action="{{ route('admin.apartments.checkout', $apartment->id) }}">
        @csrf

        <div class="form-group">
            <label for="sponsorship">Sponsorship</label>
            <select name="sponsorship_id" id="sponsorship" class="form-control">
                @foreach ($sponsorships as $sponsorship)
                    <option value="{{ $sponsorship->id }}">{{ $sponsorship->name }} - {{ $sponsorship->price }} €</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="payment-method">Payment Method</label>
            <div class="input-group">
                <div id="payment-method"></div>
            </div>
        </div>

        <input type="hidden" id="nonce" name="payment_method_nonce" />

        <input type="hidden" name="amount" value="{{ $sponsorship->price }}">

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
@endsection

@push('scripts')
    <script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $clientToken }}";
        var nonceInput = document.querySelector('#nonce');

        braintree.dropin.create({
            authorization: client_token,
            container: '#payment-method'
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                if (!nonceInput.value) {
                    instance.requestPaymentMethod(function(err, payload) {
                        if (err) {
                            console.log('Request Payment Method Error', err);
                            return;
                        }
                        nonceInput.value = payload.nonce;
                        form.submit();
                    });
                } else {
                    form.submit();
                }
            });
        });
    </script>
@endpush
