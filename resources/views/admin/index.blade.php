@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="container">
            @foreach ($apartments as $apartment)
                <h2>Appartamento: {{ $apartment->title }}</h2>
    
                @if (isset($results[$apartment->id]) && !$results[$apartment->id]->isEmpty())
                    <h3>Risultati delle transazioni:</h3>
                    <ul>
                        @foreach ($results[$apartment->id] as $transaction)
                            <li>ID transazione: {{ $transaction->id }}</li>
                            <!-- Altri dettagli della transazione... -->
                        @endforeach
                    </ul>
                @else
                    <p>Nessun risultato di transazione per questo appartamento.</p>
                @endif
    
                <!-- Altre informazioni sull'appartamento... -->
            @endforeach
        </div> --}}
        
        {{-- se non hai degli appartamenti --}}
        @if($apartments->isEmpty())
        <div class="d-flex flex-column mt-5 row-gap-3">
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
            <h1 class="text-center text-dark my-4">I TUOI APPARTAMENTI</h1>

            <ul class="list-unstyled">
                @foreach($apartments as $elem)
                    <li class="my-2">            
                        {{-- show --}}
                        <div class="mt-1 row justify-content-between">
                            <a href="{{route('admin.show', $elem)}}" class="fs-4 nav-link col-12 col-md-6 col-lg-6">
                                <b class="me-1">
                                    {{ $elem->title }}:
                                </b>
                                <span>
                                    {{$elem->address}},
                                </span>
                                <span>
                                    {{($elem->visibility) ? 'visibile' : 'non visibile'}}
                                </span>
                            </a>
                        
                            <div class="d-flex column-gap-2 col-12 col-md-6 col-lg-6 justify-content-center">
                                {{-- edit --}}
                                <div>
                                    <a href="{{route('admin.edit', $elem)}}" class="btn btn-primary">
                                        Modifica
                                    </a>
                                </div>
                
                                {{-- delete --}}
                                <form action="{{ route('admin.destroy', $elem) }}" method="POST" onclick="return confirm(`Sicuro di voler eliminare l'appartamento?`)" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </li>        
                @endforeach
            </ul>
        @endif
    </div>
@endsection