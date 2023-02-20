<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SponsorshipController extends Controller
{
    public function create($id)
    {
        $apartment = Apartment::where('slug', $id)->first();
        $sponsorships = Sponsorship::all();


        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('admin.apartments.sponsorship', compact('apartment', 'sponsorships', 'clientToken'));
    }

    public function checkout(Request $request, Apartment $apartment)
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        $sponsorship = Sponsorship::find($request->input('sponsorship_id'));
        $amount = $sponsorship->price;

        $nonce = $request->input('payment_method_nonce');

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $start_time = Carbon::now();
            $end_time = $start_time->copy()->addHours($sponsorship->duration_hours);

            $start_time_string = $start_time->format('Y-m-d H:i:s');
            $end_time_string = $end_time->format('Y-m-d H:i:s');

            $apartment->sponsorships()->attach($sponsorship->id, [
                'start_time' => $start_time_string,
                'end_time' => $end_time_string,
            ]);


            return redirect()->route('admin.apartments.show', $apartment)->with('success_message', 'Pagamento completato con successo!');
        } else {
            $error_message = $result->message;

            return redirect()->back()->with('error_message', $error_message);
        }
    }
}
