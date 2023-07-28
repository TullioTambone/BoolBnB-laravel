@extends('layouts.app')

@section('style')
    @vite(['resources/scss/pages/_dashboard.scss'])
@endsection

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Benvenuto '. $user->name.' questa è la tua Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>
                        {{ __($user->name .' '. $user->surname) }}
                    </h1>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>
                        Benvenuto nella tua Dashboard personale! Questo è il centro di controllo dove puoi gestire tutti gli aspetti dei tuoi servizi su Airbnb. Qui potrai tenere traccia di tutte le informazioni importanti relative ai tuoi appartamenti e offerte.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
