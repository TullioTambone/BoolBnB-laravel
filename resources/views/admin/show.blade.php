@extends('layouts.app')

@section('content')
<div class="container mt-4 pt-5 show">
    
    <input type="hidden" value="{{$apartment->latitude}}" id="latitude">
    <input type="hidden"  value="{{$apartment->longitude}}" id="longitude">

    <div class="row">
        <h2 class="border-bottom pb-2 mb-3">{{ $apartment->title }}</h2>
        <div class="col-12 text-center">
            <div class="row">
                {{-- cover --}}
                @if ($apartment->cover)
                    <div class="col-12 col-md-6">
                        
                        @if(str_contains($apartment->cover, 'apartment_cover_img'))
                            <img style="border-radius: 20px" class="img-fluid" src="{{ asset('storage/'. $apartment->cover) }}" alt="{{ $apartment->title }}">
                        @else
                            <img style="border-radius: 20px" class="img-fluid" src="{{$apartment->cover}}" alt="{{ $apartment->title }}">
                        @endif
    
                    </div>                
                @else
                    <div style="width: 300px; height: 300px" class="col-12 col-md-6">
                        <h3 style="color:lightgray">NON CI SONO IMMAGINI</h3>
                    </div>
                @endif
                <div class="col-12 col-md-6">
                    <div class="row justify-content-center mt-3">
                        {{-- per prendere le immagini usiamo la relazione con la tabella images --}}
                        @if($apartment->images)
                            <div class="carousel slide col-12 col-md-8 col-lg-8" id="carouselExampleAutoplaying" data-bs-ride="carousel">
                                <div class="carousel-inner w-100">
                                    @foreach($apartment->images as $index => $e)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                                            @if(str_contains($e->url, 'images'))
                                                <img style="border-radius: 20px; width: 100%" class=" bas" src="{{ asset('storage/'. $e->url) }}" alt="{{ $apartment->title }}">
                                            @else
                                                <img style="border-radius: 20px; width: 100%" class=" bas" src="{{$e->url}}" alt="{{ $apartment->title }}">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            {{-- dividere la col-12 in 2 sez col-6 --}}
            <div class="row" id="sub-form-sub">
                <div class="col-12 col-md-6">
                    {{-- tutto il resto da riordinare --}}
                    <p class="mt-3"> <i class="fa-solid fa-location-dot"></i> {{ $apartment->address }}</p>
                    <span>{{ $apartment->rooms }} Stanze <strong>&#183;</strong> </span>
                    <span>{{ $apartment->bedrooms }} Stanze da letto <strong>&#183;</strong></span>
                    <span>{{ $apartment->bathrooms }} Bagni <strong>&#183;</strong> </span>
                    <span>{{ $apartment->square_meters }}mq</span>
                    <span class="d-block mt-1">
                        <strong>Prezzo: </strong> {{ $apartment->price }}&euro;/notte
                    </span>
                    <span class="d-block mt-1">
                        <strong>Visibilità: </strong> {{ ($apartment->visibility) ? 'visibile' : 'non visibile' }}
                    </span>
                    <div class="mt-3">
                        <span class="d-block"><strong>Descrizione</strong></span>
                        <p>
                            {{$apartment->description}}
                        </p>
                    </div>
                    <div class="mt-3" id="services">
                        <span class="mt-2"><strong>Servizi</strong></span>

                        @if ($apartment->services)
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($apartment->services as $elem)
                                    <span class="p-1 mt-1 card d-inline"> 
                                        <i class="fa-solid {{$elem->icon}} me-1"></i> {{  $elem->name }} 
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="d-flex column-gap-1 mt-4 buttons">

                        {{-- edit --}}
                        <a href="{{route('admin.edit', $apartment)}}" class="btn me-2">
                            Modifica
                        </a>
                        
                        {{-- delete --}}
                        <form action="{{ route('admin.destroy', $apartment) }}" method="POST" onsubmit="showConfirmModal(); return false;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Elimina</button>
                        </form>

                        <!-- Modal di conferma per l'eliminazione -->
                        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Conferma eliminazione</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Sei sicuro di voler eliminare l'appartamento?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                        <form action="{{ route('admin.destroy', $apartment) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($apartment->subscriptions->isEmpty())
                    
                    <div class="col-12 col-md-6">
                        {{-- payment form --}}
                        <div class="mt-4 card p-3 w-100 sub">                        
                            <form id="payment-form" action="{{route('subscription')}}" method="POST">
                                <h2 class="text-center">Sponsorizza l'appartamento</h2>           
                                {{-- token --}}
                                @csrf
                                <div class="row">
                                    
                                    @foreach($sub as $e)
        
                                        <div id="checkboxes" class="col-12 col-lg-4">
                                            <input type="radio" class="btn-check" name="subscription_id" id="subscription-{{$e->id}}" value="{{$e->id}}">
                                            <label class="labels border btn w-100" for="subscription-{{$e->id}}" onclick="changeColor(this)">
                                                <span class="d-block">
                                                    {{strtoupper($e->name)}}
                                                </span>
                                                <span class="d-block">{{$e->price}}€</span>
                                                <span class="d-block">{{$e->duration}}h</span>
                                            </label>
                                            <div class="invalid-feedback">Seleziona almeno un'opzione!!</div>
                                        </div>                                    
                                    @endforeach
                                </div>
                                <input type="hidden" name="apartment_id" value="{{$apartment->id}}"> 
        
                                <div id="dropin-container"></div>

                                <input type="submit" class="btn border w-25" id="submit-payment"/>
                                <span id="loading"></span>

                                <input type="hidden" id="nonce" name="payment_method_nonce"/>
                            </form>                
                        </div>
                    </div>
                
                @else
                    <div class="col-12 col-md-6 sub">
                        <div class="card card__one m-auto mt-4">
                            <div class="card__text">
                                @if ($apartment->subscriptions->isNotEmpty())
                                    @php
                                        $lastSubscription = $apartment->subscriptions->last();
                                        $originalData = $lastSubscription->getOriginal();
                                    @endphp

                                    {{-- Verifica se il campo "pivot_subscription_id" dell'oggetto "original" è presente --}}
                                    @if (isset($originalData['pivot_subscription_id']))
                                        <h3>€{{ $lastSubscription->price }}</h3>
                                        <span>{{ $lastSubscription->duration }}h</span>
                                        <span>{{ strtoupper($lastSubscription->name) }}</span>
                                        <hr>
                                        <p class="card__title"></p>
                                        <div>
                                            <ul class="features">
                                                <li>
                                                    <span class="icon">
                                                        <i class="fa-solid fa-check"></i>
                                                    </span>
                                                    <span><strong>{{ $lastSubscription->duration }}h</strong> ore di visibilità</span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                @endif
                                <form action="{{ route('admin.subscription.destroy') }}" onclick="showConfirmModal2();" method="POST" id="my-sub-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                                    <input type="hidden" name="subscription_id" value="{{ $originalData['pivot_subscription_id'] }}">
                                    <button type="submit" class="btn btn-danger mb-4">Annulla</button>

                                </form>
                                {{-- confirm modal subscription --}}
                                
                                <div id="my-modal">
                                    <div id="confirm-modal" class="modal">
                                        <div class="modal-content">
                                            <h2>Conferma l'operazione</h2>
                                            <p>Sei sicuro di voler annullare la sottoscrizione?</p>
                                            <div class="modal-buttons">
                                                <button id="confirm-yes" class="btn btn-danger">Sì</button>
                                                <button id="confirm-no" class="btn btn-secondary">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{-- @dd($apartment->subscriptions) --}}
            <!-- mappa -->
            <div id='map' class='map mt-5 mb-5' style="height: 200px;"></div>
        </div>
    </div> 
</div> 
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps-web.min.js'></script>
@endsection


@section('script')
    <script>
        let clientToken = "{{ $clientToken }}";
        function changeColor(label){
            //label.SetAttribute('background-color','red');
            let labels = document.querySelectorAll('.labels');
            let activeBrown = 'sandybrown';
            let activeGold = 'gold';
            let activePlatinum = 'rgb(229, 228, 226)';

            labels.forEach(l => {

                l.style.backgroundColor = '';
            });

            // Seleziona il label cliccato e cambia il colore di sfondo
            
            if(label === labels[0]){
                label.style.backgroundColor = activeBrown;

            } else if(label === labels[1]){
                label.style.backgroundColor = activeGold;

            } else if(label === labels[2]){
                label.style.backgroundColor = activePlatinum;
            }
        }

        function showConfirmModal() {
            event.preventDefault();
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        }
            // Funzione per aprire il secondo modal
        function showConfirmModal2() {
            event.preventDefault();
            var modal = document.getElementById("confirm-modal");
            modal.style.display = "block";

            var confirmYes = document.getElementById("confirm-yes");
            confirmYes.onclick = function () {
                modal.style.display = "none";
                // Esegui l'azione di conferma (eliminazione sottoscrizione)
                // Qui puoi aggiungere codice per inviare il form utilizzando AJAX o il metodo nativo del form.
                document.querySelector("#my-sub-form").submit();
            };

            var confirmNo = document.getElementById("confirm-no");
            confirmNo.onclick = function () {
                modal.style.display = "none";
            };
        }
    </script>
    @vite(['resources/js/braintree.js'])
    @vite(['resources/js/mapInShow.js'])
@endsection

@section('braintree')
<script src="https://js.braintreegateway.com/web/dropin/1.39.0/js/dropin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('style')

<style>
    #map, #sticky{
        border-radius: 20px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    #sticky{
        position: -webkit-sticky;
        top: 11vh;
    }
    .media-table{
        display: none;
    }
    .guest-message{
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .bas {
        width: 300px;
        height: 300px;
        object-fit: cover;
    }
    

    @media screen and (min-width:576px){
        .media-table{
            display: table-cell;
        }
    }
    @media screen and (max-width: 428px) {
        .bas {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    }
    @media screen and (max-width: 768px) {
        .bas {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
        .sub {
            margin-right: 100px;
        }
    }

</style>
@endsection