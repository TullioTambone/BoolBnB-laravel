@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="row">

        <div class="col-12 col-md-6 col-lg-6 text-center">

            {{-- cover --}}
            @if ($apartment->cover)
                <div>
                    <img class="img-fluid" src="{{ asset('storage/'. $apartment->cover) }}" alt="{{ $apartment->title }}">
                </div>                
            @else
                <div style="width: 300px; height: 300px">
                    <h3 style="color:lightgray">NON CI SONO IMMAGINI</h3>
                </div>
            @endif
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

        <div class="col-12 col-md-6 col-lg-6">
            <h1 class="border-bottom">{{ $apartment->title }}</h1>
            <div>
                <p>{{ $apartment->description }}</p>
                <span class="d-block">
                    numero stanza: {{ $apartment->rooms }}
                </span>
                <span class="d-block">
                    numero stanze letto: {{ $apartment->bedrooms }}
                </span>
                <span class="d-block">
                    numero bagni: {{ $apartment->bathrooms }}
                </span>
                <span class="d-block">
                    metri quadri: {{ $apartment->square_meters }}mq
                </span>
                <span class="d-block">
                   indirizzo: {{ $apartment->address }}
                </span>
                <span class="d-block">
                    prezzo: {{ $apartment->price }}&euro;
                </span>
                <span class="d-block">
                    visibilità: {{ ($apartment->visibility) ? 'visibile' : 'non visibile' }}
                </span>
                <h5 class="mt-2"> Servizi  </h5>

                @if ($apartment->services)
                    @foreach($apartment->services as $elem)
                        <span class="d-block mt-1"> <i class="fa-solid {{ $elem->icon }} me-1 "></i> {{  $elem->name }} </span>
                    @endforeach
                @endif

                @if ($apartment->leads)

                    <h2>Messagi Ricevuti</h2>
                    @foreach($apartment->leads as $elem)
                        <span class="d-block mt-1"> 
                            Nome: {{  $elem->name }} 
                        </span>
                        <span class="d-block mt-1"> 
                            Email: {{  $elem->email }} 
                        </span>
                        <p class="d-block mt-1"> 
                            Messaggio: {{  $elem->message }} 
                        </p>
                    @endforeach
                @endif

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

                

                <div class="mt-4">
                    <form id="payment-form" action="{{route('subscription')}}" method="POST">
                                            
                        {{-- token --}}
                        @csrf
                        <!-- Putting the empty container you plan to pass to
                        'braintree.dropin.create' inside a form will make layout and flow
                        easier to manage -->
                        <div class="row">
                            @foreach($sub as $e)

                                <div class="col-4">
                                    <input type="radio" class="btn-check" name="subscription_id" id="subscription-{{$e->id}}" value="{{$e->id}}">
                                    <label class="btn btn-outline-success" for="subscription-{{$e->id}}">
                                        {{$e->name}}
                                        {{$e->price}}€
                                        {{$e->duration}}
                                    </label>

                                </div>
          
                                @endforeach
                            </div>
                            <input type="hidden" name="apartment_id" value="{{$apartment->id}}"> 

                        <div id="dropin-container"></div>
                        <input type="submit" />
                        <input type="hidden" id="nonce" name="payment_method_nonce" />
                    </form>                
                </div>
            </div>
        </div>
    </div> 
</div> 
@endsection


@section('script')
@vite(['resources/js/braintree.js'])
@endsection

@section('braintree')
<script src="https://js.braintreegateway.com/web/dropin/1.39.0/js/dropin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection