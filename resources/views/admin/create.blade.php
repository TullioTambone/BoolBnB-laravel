@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Crea il tuo Appartamento</h2>
    
        <div class="row justify-content-center">
            <div class="col-7">

                {{-- errors list --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- form create --}}
                <form id="form-create" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    
                    {{-- token --}}
                    @csrf

                    {{-- title --}}
                    <div>
                        <label for="title">Titolo *</label>
                        <input class="form-control" @error('title') is-invalid  @enderror type="text" id="title" name="title" 
                        value="{{ old('title')}}" autocomplete="off">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- description --}}
                    <div>
                        <label for="description">Descrizione</label>
                        <textarea class="form-control"  name="description" id="description" rows="5"></textarea>
                    </div>

                    {{-- rooms --}}
                    <div>
                        <label for="rooms">Stanze *</label>
                        <input class="form-control" @error('rooms') is-invalid  @enderror type="number" id="rooms" name="rooms" min="0" required value="{{ old('rooms')}}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('rooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bedrooms --}}
                    <div>
                        <label for="bedrooms">Camere da letto *</label>
                        <input class="form-control" @error('bedrooms') is-invalid  @enderror type="number" id="bedrooms" name="bedrooms" min="0" required value="{{ old('bedrooms')}}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('bedrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bathrooms --}}
                    <div>
                        <label for="bathrooms">Bagni *</label>
                        <input class="form-control" @error('bathrooms') is-invalid  @enderror type="number" id="bathrooms" name="bathrooms" min="0" required value="{{ old('bathrooms')}}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('bathrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- square meters --}}
                    <div>
                        <label for="square_meters">Metri quadrati *</label>
                        <input class="form-control" @error('square_meters') is-invalid  @enderror type="number" id="square_meters" name="square_meters" min="0" required value="{{ old('square_meters')}}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('square_meters')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address
                        esempio: Via... civico, 0001.. RM, Regione
                         --}}
                    <div>
                        <label for="address">Indirizzo *</label>
                        <input list="data" class="form-control" @error('address') is-invalid  @enderror type="text" id="address" name="address" autocomplete="off" required value="{{ old('address')}}">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Inserisci un indirizzo valido!</div>
                        <datalist id="data">                           
                            
                        </datalist>
                    </div>

                    {{-- visibility --}}
                    <div>
                        <label class="d-block" for="visibility">Vuoi rendere visibile il tuo appartamento? *</label>
                        <input type="radio" name="visibility" value="1">
                        <label for="visibility">Si</label><br>
                        <input type="radio" name="visibility" value="0" checked>
                        <label for="visibility">No</label><br>
                    </div>

                    {{-- cover --}}
                    <div class="mb-3">
                        <label for="cover" class="form-label">immagine principale dell'appartamento *</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" required aria-label="file example">
                        {{-- error --}}
                        @error('cover')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- per inserire più immagini alla volta --}}
                    <div class="mb-3">
                        <label for="url" class="form-label">inserire l'album immagini</label>
                        <input type="file" class="form-control" id="url" name="images[]" multiple>
                     
                    </div>

                    {{-- servizi --}}
                    <div class="mb-3">
                        <label for="services">Servizi *</label>
                        @foreach ($services as $element)
                        <div id="checkbox-container">
                            <label for="check-service-{{ $element->id }}" class="form-label">
                                {{ $element->name }}
                                <i class="fa-solid {{ $element->icon }}"></i>
                            </label>
                            <input type="checkbox" name="services[]" id="check-service-{{ $element->id }}" value="{{ $element->id }}">
                        </div>
                        @endforeach
                    </div>

                    {{-- prezzo --}}
                    <div>
                        <label for="price">Prezzo</label>
                        <input class="form-control"  type="number" id="price" name="price" min="0">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                    </div>
                    
                    {{-- inputs hidden --}}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="latitude" id="latitude" value="">
                    <input type="hidden" name="longitude" id="longitude" value="">

                    <button id="submit" class="btn btn-success my-3 w-25" type="submit">Salva</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @vite(['resources/js/validation.js'])
@endsection