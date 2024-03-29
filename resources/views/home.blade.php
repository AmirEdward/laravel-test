@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('subscribed'))
            <div class="alert alert-info">
                {{ session('subscribed') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Hello {{ Auth::user()->name }},
                        Your role is {{ Auth::user()->user_type }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
