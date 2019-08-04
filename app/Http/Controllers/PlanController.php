<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index() {
        $plans = Plan::all();
        return view('plans.index', compact('plans'));
    }

    public function payment(Plan $plan) {
        return view('payment', compact('plan'));
    }

    public function subscribe(Request $request) {
        $user = $request->user();
        $user->newSubscription('subscription', $request->stripe_plan)->create($request->stripeToken);
        return redirect()->route('home')->with('subscribed', 'You have been subscribed successfully');
    }
}
