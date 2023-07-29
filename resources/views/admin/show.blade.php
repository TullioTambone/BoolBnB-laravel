@extends('layouts.app')

@section('content')
<div class="container mt-4 pt-5">
    
    <input type="text" hidden value="{{$apartment->latitude}}" id="latitude">
    <input type="text" hidden value="{{$apartment->longitude}}" id="longitude">
    <div class="row">
        <h1 class="border-bottom">{{ $apartment->title }}</h1>
        <div class="col-12 text-center">
            <div class="row">
                {{-- cover --}}
                @if ($apartment->cover)
                    <div class="col-12 col-md-6">
                        {{-- <img class="img-fluid" src="{{ asset('storage/'. $apartment->cover) }}" alt="{{ $apartment->title }}"> --}}
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
                                <div class="carousel-inner">
                                    @foreach($apartment->images as $index => $e)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/'. $e->url) }}" class="d-block w-100" alt="{{$e->id}}">
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
            <div class="row">
                <div class="col-12 col-md-6">
                    {{-- tutto il resto da riordinare --}}
                    <p class="mt-3"> <i class="fa-solid fa-location-dot"></i> {{ $apartment->address }}</p>
                    <span>{{ $apartment->rooms }} stanze <strong>&#183;</strong> </span>
                    <span>{{ $apartment->bedrooms }} stanze da letto <strong>&#183;</strong></span>
                    <span>{{ $apartment->bathrooms }} bagno <strong>&#183;</strong> </span>
                    <span>{{ $apartment->square_meters }}mq</span>
                    <span class="d-block mt-1">
                        <strong>prezzo: </strong> {{ $apartment->price }}&euro;
                    </span>
                    <span class="d-block mt-1">
                        <strong>visibilità: </strong> {{ ($apartment->visibility) ? 'visibile' : 'non visibile' }}
                    </span>
                    <div class="mt-3">
                        <span class="d-block"><strong>Descrizione</strong></span>
                        <p>
                            {{$apartment->description}}
                        </p>
                    </div>
                    <div class="mt-3">
                        <span class="mt-2"><strong>Servizi</strong></span>

                        @if ($apartment->services)
                            <div class="row p-2">
                                @foreach($apartment->services as $elem)
                                <div class="col-12 d-flex align-items-center border rounded">
                                    <i class="fa-solid {{ $elem->icon }} me-1"></i>
                                    <span class="p-1 mt-1">{{  $elem->name }} </span>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="d-flex column-gap-1 mt-2">

                        {{-- edit --}}
                        <a href="{{route('admin.edit', $apartment)}}"
                            class="btn btn-primary"
                        >
                            Modifica
                        </a>
        
                        {{-- delete --}}
                        <form action="{{ route('admin.destroy', $apartment) }}" method="POST" onclick="return confirm(`Sicuro di voler eliminare l'appartamento?`)" >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Elimina</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    {{-- pagamento in stiky --}}
                    <div class="mt-4 card p-3 w-100" id="sticky">
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

                            <input type="submit" class="btn border w-25" onclick="hideContent(this)"/>
                            <span id="loading"></span>

                            <input type="hidden" id="nonce" name="payment_method_nonce"/>
                        </form>                
                    </div>
                </div>
            </div>
            <!-- mappa -->
            <div id='map' class='map mt-5' style="height: 200px;"></div>
            
            <div>
            
                <h4 class="mt-5">Messagi Ricevuti</h4>
                
                @if ($apartment->leads)
                    <div class="table-responsive">
                        <table class="table table-striped
                        table-hover	
                        table-borderless
                        align-middle">
                            <thead class="table-light">
                                <caption>Messaggi</caption>
                                <tr class="border-bottom">
                                    <th>NOME</th>
                                    <th class="media-table">EMAIL</th>
                                    <th>MESSAGGIO</th>
                                </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach($apartment->leads as $elem)
                                    <tr class="" >
                                        <td scope="row">{{  $elem->name }} </td>
                                        <td class="media-table">{{  $elem->email }} </td>
                                        <td class="guest-message">{{  $elem->message }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                        </table>
                    </div>
                @endif

                
                
                @if(isset($results))
                    <!-- Visualizza i risultati come desideri -->
                    <div>
                        Risultati del pagamento:
                        <pre>{{ json_encode($results, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                @endif
            </div>
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
            let activeBrown = 'sandybrown'; // Puoi personalizzare il colore come desideri
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

        function hideContent(element){
            element.style.display = 'none';
            document.getElementById('loading').innerHTML = `
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Loading...</span>
            `;

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
        position: sticky;
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

    @media screen and (min-width:576px){
        .media-table{
            display: table-cell;
        }
    }
</style>
@endsection