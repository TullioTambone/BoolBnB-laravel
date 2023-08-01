@extends('layouts.app')

@section('style')
@vite(['resources/scss/pages/_index.scss'])
@endsection

@section('content')
<div class="box">

    <div class="container py-5">

        {{-- se non hai degli appartamenti --}}
        @if($apartments->isEmpty())
            <div style="height: 70vh" class="d-flex flex-column row-gap-3 my-5 py-5">
                <h2>
                    Ciao, qui vedrai i tuoi appartamenti.
                </h2>
                <h4>
                    Inizia ad aggiungere degli appartamenti da mettere in vendita!
                </h4>
                <a class="btn col-12 col-md-5 col-lg-3" href="{{ route('admin.create') }}">
                    Crea il tuo primo appartamento!
                </a>
            </div>
        @else
            <div class="row">
                <h1 class="text-center text-dark my-5">I Tuoi Appartamenti</h1>

                @foreach($apartments->reverse() as $elem)
                
                <a href="{{route('admin.show', $elem)}}">
                    <div class="card mb-4 col-12 col-md-12 col-lg-12">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex flex-column justify-content-center">
                                @if(str_contains($elem->cover, 'apartment_cover_img'))
                                    <img class="img-fluid" src="{{ asset('storage/'. $elem->cover) }}" alt="{{ $elem->title }}">
                                @else
                                    <img class="img-fluid" src="{{$elem->cover}}" alt="{{ $elem->title }}">
                                @endif
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $elem->title }}</h4>
                                    <p class="card-text description">{{$elem->description}}</p>
                                    <p class="card-text">
                                        <small class="text-body-secondary">{{$elem->address}}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach  
            </div>
        @endif
    </div>
</div>
@endsection
