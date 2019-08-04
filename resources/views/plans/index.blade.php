@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Pricing</h1>
            <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
        </div>
        <div class="card-deck mb-3 text-center">
            @foreach($plans as $plan)
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{ $plan->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">${{ $plan->cost }}</h1>
                        <p>{{ $plan->description }}</p>
                        <a href="{{ route('payment', $plan) }}" class="btn btn-lg btn-block btn-primary">Choose</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection