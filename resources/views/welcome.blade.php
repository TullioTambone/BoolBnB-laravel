@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">
        <h1 class="display-5 fw-bold">
            Welcome to BoolBnB
        </h1>
        <div class="row">
            <p class="col-12 col-md-8 fs-4">
                Benvenuto nella tua area personale! Qui potrai gestire facilmente i tuoi servizi con pieno controllo. Crea, modifica o cancella le offerte che desideri mettere a disposizione degli ospiti. Personalizza ogni dettaglio per rendere i tuoi servizi unici ed irresistibili. Il nostro intuitivo sistema ti guiderà passo dopo passo, garantendo una gestione semplice ed efficiente. Siamo qui per aiutarti a far crescere il tuo business e offrire esperienze indimenticabili ai nostri utenti. Buona fortuna nella tua avventura come host!
            </p>
            <div class="col-12 col-md-4 d-flex align-items-center gap-1 flex-column">
                <h3>Inizia da qui</h3>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg" type="button">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg" type="button">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
    </div>
</div>
@endsection