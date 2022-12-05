<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'subscribe' => 'required|in:monthly,yearly'
        ]);
        return view('subscriptions.subscription')->with(['subscription' => $request->subscribe]);
    }

    public function checkout(Request $request)
    {
        // get your logged-in user
        $user = Auth::user();

        // brain tree user payment nouce
        $payment_method_nonce = $request->payment_method_nonce;

        // make sure that if we do not have customer nonce already
        // then we create nonce and save it to our database
        if ( !$user->braintree_nonce )
        {
            $result = \Braintree\PaymentMethod::create([
                'customerId' => $user->braintree_id,
                'paymentMethodNonce' => $payment_method_nonce
            ]);

            // save this nonce to user table
            $user->braintree_nonce = $payment_method_nonce;
            $user->save();
        }

        // process the user payment
        $client_nonce = \Braintree\PaymentMethodNonce::create($user->braintree_nonce);
        $result = \Braintree\Transaction::sale([
            'amount' => $request->subscribe === 'monthly' ? 9.99 : 99.99,
            'options' => [
                'submitForSettlement' => True
                ],
            'paymentMethodNonce' => $client_nonce->paymentMethodNonce->nonce
        ]);

        if( !empty($result->transaction) ) {
            //save to user
            $user->braintree_plan = $request->subscribe;
            $user->braintree_active = true;
            $user->save();
            return redirect("dashboard")->withSuccess('Payment successful.');
        }

        return redirect("dashboard")->withSuccess('Payment was not successful.');
    }

    public function cancel()
    {
        $user = Auth::user();
        $user->braintree_active = false;
        $user->braintree_nonce = null;
        $user->save();

        return redirect("dashboard")->withSuccess('You have cancelled your subscription.');
    }
}
