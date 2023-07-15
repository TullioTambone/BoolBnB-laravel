@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <img style="width:300px" src="{{ asset('storage/'. $apartment->cover) }}" alt="">
            <div class="row">
                @foreach($images as $elem)
                    <div class="col-12 col-md-6 col-lg-4">
                        <img class="img-fluid" src="{{ asset('storage/'. $elem->url) }}" alt="">
                    </div>
                @endforeach
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
                <h5 class="mt-2"> Servizzi  </h5>
                @foreach($services as $elem)
                    <span class="d-block mt-1"> <i class="fa-solid {{ $elem->icon }} me-1 "></i> {{  $elem->name }} </span>
                @endforeach
            </div>
        </div>
    </div> 
</div> 
@endsection
