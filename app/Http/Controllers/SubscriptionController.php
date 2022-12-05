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

    public function checkout()
    {

    }

    public function cancel()
    {
        $user = Auth::user();
        $user->braintree_active = false;
        $user->save();
    }
}
