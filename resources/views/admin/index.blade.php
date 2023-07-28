@extends('layouts.app')

@section('style')
    @vite(['resources/scss/pages/_index.scss'])
@endsection

@section('content')
<div class="box">

    <div class="container pt-5">
        
        {{-- se non hai degli appartamenti --}}
        @if($apartments->isEmpty())
        <div class="d-flex flex-column row-gap-3">
            <h2>
                Ciao, qui vedrai i tuoi appartamenti.
            </h2>
            <h4>
                Inizia ad aggiungere degli appartamenti da mettere in vendita!
            </h4>
            <a class="btn btn-primary w-25" href="{{ route('admin.create') }}">
                Crea il tuo primo appartamento!
            </a>
        </div>
        @else
        <div class="row">
            <h1 class="text-center text-dark my-2">I Tuoi Appartamenti</h1>


            @foreach($apartments as $elem)
            
                <div class="card mb-4 col-12 col-md-12 col-lg-12">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex flex-column justify-content-center">
                            <a href="{{route('admin.show', $elem)}}">
                                @if(str_contains($elem->cover, 'apartment_cover_img'))
                                    <img class="img-fluid" src="{{ asset('storage/'. $elem->cover) }}" alt="{{ $elem->title }}">
                                @else
                                    <img class="img-fluid" src="{{$elem->cover}}" alt="{{ $elem->title }}">
                                @endif
                            </a>
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="card-body">
                                <a href="{{route('admin.show', $elem)}}">
                                    <h4 class="card-title">{{ $elem->title }}</h4>
                                </a>
                                <p class="card-text description">{{$elem->description}}</p>
                                <p class="card-text">
                                    <small class="text-body-secondary">{{$elem->address}}</small>
                                </p>
                            </div>


                            <div class="row justify-content-around mb-3">
                                <div class="col-6 col-md-6 col-lg-6 text-center">
                                    <a href="{{route('admin.edit', $elem)}}" class="btn btn-primary">
                                        Modifica
                                    </a>
                                </div>
        
                                <div class="col-6 col-md-6 col-lg-6 text-center">
                                    <form action="{{ route('admin.destroy', $elem) }}" method="POST" onclick="return confirm(`Sicuro di voler eliminare l'appartamento?`)" >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Elimina</button>
                                    </form>
                                </div>
        
                            </div>
                        </div>
                    </div>
                    
                </div>
              @endforeach  
        </div>
        @endif
    </div>
</div>
@endsection

