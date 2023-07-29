@extends('layouts.app')

@section('style')
    @vite(['resources/scss/pages/_dashboard.scss'])
@endsection

@section('content')


<div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>


<div id="dashboard">
    <div class="container">
        <div class="row mb-5">
            <div class="box-img col-12 col-md-4 col-lg-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/Boolbnb-logo.png') }}" alt="">
            </div>
            <div class="box-description col-12 col-md-8 col-lg-7 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column">
                    <h2>{{ __('Benvenuto '. $user->name.' Prenota su BoolBnB: è facile e conveniente!') }} </h2>
                    <ul>
                        <li>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/support.png') }}" alt="">
                                <div class="info d-flex flex-column justify-content-center">
                                    <h4>Supporto clienti pronto ad aiutarti</h4>
                                    <p>Il nostro team di supporto è disponibile 24/7 per assisterti in ogni tua esigenza.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/discount.jpeg') }}" alt="">
                                <div class="info d-flex flex-column justify-content-center">
                                    <h4>Accedi a sconti immediati</h4>
                                    <p>Con le tariffe per soli iscritti risparmi in media un 15% su migliaia di hotel.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/calendar.png') }}" alt="">
                                <div class="info d-flex flex-column justify-content-center">
                                    <h4>Cancellazione gratuita</h4>
                                    <p>Prenotazione flessibile per gran parte degli hotel*.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="box-description col-12 col-md-8 col-lg-7 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column">
                    <h3>qui ce qualcosa</h3>
                    <p>e poi qui qualcos' altro</p>
                    <span>magari qualcosa anche qua</span>
                </div>
            </div>
            <div class="box-img col-12 col-md-4 col-lg-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/Boolbnb-logo.png') }}" alt="">
            </div>
        </div>
       
        <div class="row mb-5">
            <div class="box-img col-12 col-md-4 col-lg-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/Boolbnb-logo.png') }}" alt="">
            </div>
            <div class="box-description col-12 col-md-8 col-lg-7 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column">
                    <h3>qui ce qualcosa</h3>
                    <p>e poi qui qualcos' altro</p>
                    <span>magari qualcosa anche qua</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
