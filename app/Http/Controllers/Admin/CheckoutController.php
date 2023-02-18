<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Gate;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {


        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $amount = $request->input('amount');
        $nonce = $request->input('payment_method_nonce');

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // Pagamento completato con successo

            return redirect()->back()->with('success_message', 'Pagamento completato con successo!');
        } else {
            // Errore nel pagamento

            $error_message = $result->message;

            return redirect()->back()->with('error_message', $error_message);
        }
    }
}




/////////////////////////

// $result = Braintree\Transaction::sale([
//     'amount' => '10.00',
//     'paymentMethodNonce' => $request->payment_method_nonce,
//     'options' => [
//         'submitForSettlement' => True
//     ]
// ]);


// use Braintree\Gateway;
// use Illuminate\Support\Facades\Config;

// $config = Config::get('services.braintree');
// $gateway = new Gateway($config);
