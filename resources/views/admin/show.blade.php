@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="row">

        <div class="col-12 col-md-6 col-lg-6">

            {{-- cover --}}
            <img style="width:300px" src="{{ asset('storage/'. $apartment->cover) }}" alt="{{ $apartment->title }}">

            <div class="row">

                {{-- per prendere le immagini usiamo la relazione con la tabella images --}}
                @if($apartment->images)
                    @foreach($apartment->images as $elem)
                        <div class="col-12 col-md-6 col-lg-4">
                            <img class="img-fluid" src="{{ asset('storage/'. $elem->url) }}" alt="">
                        </div>
                    @endforeach
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
                <h5 class="mt-2"> Servizi  </h5>

                @if ($apartment->services)
                    @foreach($apartment->services as $elem)
                        <span class="d-block mt-1"> <i class="fa-solid {{ $elem->icon }} me-1 "></i> {{  $elem->name }} </span>
                    @endforeach
                @endif

                <div class="d-flex column-gap-5 mt-3">

                    {{-- edit --}}
                    <a href="{{route('admin.edit', $apartment)}}"
                        class="btn btn-primary"
                    >
                        edit
                    </a>
    
                    {{-- delete --}}
                    <form action="{{ route('admin.destroy', $apartment) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div> 
@endsection
