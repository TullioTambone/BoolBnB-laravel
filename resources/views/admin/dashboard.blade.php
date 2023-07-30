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

{{-- dashboard --}}
<div id="dashboard">
    <div class="container pt-5">
        <div class="row">

            {{-- description --}}
            <div class="box-description col-12 col-md-8 col-lg-6 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column">
                    <div class="info d-flex justify-content-center align-items-center">
                        <div class="w-75">
                            <h2>Esplora le case vacanza</h2>
                            <p>
                                Naviga tra le nostre incantevoli opzioni di case vacanza disponibili in destinazioni mozzafiato in tutto il mondo. Dalle rilassanti spiagge tropicali ai pittoreschi rifugi di montagna, troverai sicuramente la casa perfetta per il tuo prossimo soggiorno indimenticabile.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- img --}}
            <div class="box-img col-12 col-md-4 col-lg-6 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/Boolbnb-logo.png') }}" alt="">
            </div>
        </div>

        {{-- benvenuto --}}
        <div class="row mb-5">
            <div class="box-img col-12 col-md-4 col-lg-6 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/Boolbnb-logo.png') }}" alt="logo boolb&b">
            </div>
            <div class="box-description col-12 col-md-8 col-lg-6 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column">
                    <h2>
                        {{ __('Benvenuto '. $user->name.' Prenota su BoolBnB: è facile e conveniente!') }}
                    </h2>
                    <ul class="p-0">
                        <li>
                            <div class="d-flex align-items-center single-cont">
                                <img src="{{ asset('img/support.png') }}" alt="">
                                <div class="info d-flex flex-column justify-content-center">
                                    <h4>Supporto clienti pronto ad aiutarti</h4>
                                    <p>Il nostro team di supporto è disponibile 24/7 per assisterti in ogni tua
                                        esigenza.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center single-cont">
                                <img src="{{ asset('img/discount.jpeg') }}" alt="">
                                <div class="info d-flex flex-column justify-content-center">
                                    <h4>Accedi a sconti immediati</h4>
                                    <p>Con le tariffe per soli iscritti risparmi in media un 15% su migliaia di hotel.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center single-cont">
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
            <div class="box-description col-12 col-md-8 col-lg-6 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column">
                    <div class="info d-flex justify-content-center align-items-center">
                        <div class="w-75">
                            <h2>Invia una richiesta personalizzata</h2>
                            <ul class="p-0">
                                <li>
                                    <div class="d-flex align-items-center single-cont">
                                        <img src="{{ asset('img/contact.png') }}" alt="">
                                        <div class="info d-flex flex-column justify-content-center">
                                            <h4>Contatta l'Host</h4>
                                            <p>Una volta trovata la casa che cattura il tuo cuore, non esitare a contattare
                                                l'host.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center single-cont">
                                        <img src="{{ asset('img/custom.png') }}" alt="">
                                        <div class="info d-flex flex-column justify-content-center">
                                            <h4>Personalizza la tua esperienza</h4>
                                            <p>L'host sarà lieto di aiutarti a personalizzare il tuo soggiorno secondo le tue
                                                preferenze. Che si tratti di suggerimenti su attrazioni locali, consigli sui
                                                ristoranti o servizi aggiuntivi, siamo qui per rendere la tua vacanza unica e
                                                indimenticabile.</p>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-img col-12 col-md-4 col-lg-6 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/Boolbnb-logo.png') }}" alt="">
            </div>
        </div>

        <div class="row mb-5">
            <div class="box-description col-12 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column w-75 text-center">
                    <h2 class="text-center">Scopri i Piani di Abbonamento: Metti in Evidenza la Tua Casa Vacanza!</h2>
                    <p>"Rendi il tuo appartamento un vero protagonista con i nostri esclusivi piani di abbonamento!
                        Aumenta la visibilità del tuo annuncio, posizionandolo in cima alle ricerche degli ospiti.
                        Scopri le opzioni su misura per te e attira più prenotazioni creando un'esperienza eccezionale
                        per i tuoi futuri ospiti. Esplora i piani disponibili e raggiungi un pubblico più ampio oggi
                        stesso!"</p>
                </div>
            </div>

            <div class="card-sub d-flex justify-content-center">
                <div class="card card__one">
                    <div class="card__text">
                        <h3>€2.99</h3>
                        <span>24h</span>
                        <span>BASE</span>
                        <hr>
                        <p class="card__title"></p>
                        <div>
                            <ul class="features">
                                <li>
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span><strong>1</strong> giorno di visibilità</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card card__two">
                    <div class="card__text">
                        <h3>€5.99</h3>
                        <span>48h</span>
                        <span>PREMIUM</span>
                        <hr>
                        <p class="card__title"></p>
                        <div>
                            <ul class="features">
                                <li>
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span><strong>2</strong> giorni di visibilità</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span><strong>Badge</strong> "Premium"</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card card__three">
                    <div class="card__text">
                        <h3>€9.99</h3>
                        <span>144h</span>
                        <span>PLATINO</span>
                        <hr>
                        <p class="card__title"></p>
                        <div>
                            <ul class="features">
                                <li>
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span><strong>6</strong> giorni di visibilità</span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span>Premium <strong>x3</strong></span>
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span><strong>Badge</strong> "Platino"</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
