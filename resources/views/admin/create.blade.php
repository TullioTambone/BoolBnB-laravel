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
                <form class="mt-4" id="form" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    
                    {{-- token --}}
                    @csrf

                    {{-- title --}}
                    <div class="mb-3">
                        <label class="form-label" for="title">Titolo *</label>
                        <input class="form-control" type="text" id="title" name="title" autocomplete="off" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- description --}}
                    <div class="mb-3">
                        <label class="form-label" for="description">Descrizione</label>
                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                    </div>

                    {{-- rooms --}}
                    <div class="mb-3">
                        <label class="form-label" for="rooms">Stanze *</label>
                        <input class="form-control" type="number" id="rooms" name="rooms" min="0" value="{{ old('rooms') }}" required>
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('rooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bedrooms --}}
                    <div class="mb-3">
                        <label class="form-label" for="bedrooms">Camere da letto *</label>
                        <input class="form-control" type="number" id="bedrooms" name="bedrooms" min="0" value="{{ old('bedrooms') }}" required>
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('bedrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bathrooms --}}
                    <div class="mb-3">
                        <label class="form-label" for="bathrooms">Bagni *</label>
                        <input class="form-control" type="number" id="bathrooms" name="bathrooms" min="0" value="{{ old('bathrooms') }}" required>
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('bathrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- square meters --}}
                    <div class="mb-3">
                        <label class="form-label" for="square_meters">Metri quadrati *</label>
                        <input class="form-control" type="number" id="square_meters" name="square_meters" min="0" value="{{ old('square_meters') }}" required>
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('square_meters')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address
                        esempio: Via... civico, 0001.. RM, Regione
                         --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo *</label>
                        <input list="datalistOptions" class="form-control" type="text" id="address" name="address" autocomplete="off" value="{{ old('address') }}" placeholder="Inserisci l'indirizzo..." required>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Inserisci un indirizzo valido!</div>
                        <datalist id="datalistOptions">                           
                            
                        </datalist>
                    </div>

                    {{-- visibility --}}
                    <div class="mb-3">
                        <label class="d-block" for="visibility">
                            Vuoi rendere visibile il tuo appartamento? *
                        </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="visibility" value="1">
                            <label class="form-check-label" for="visibility">
                                Si
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="visibility" value="0" checked>
                            <label class="form-check-label" for="visibility">
                                No
                            </label>
                        </div>
                    </div>

                    {{-- cover --}}
                    <div class="mb-3">
                        <label for="cover" class="form-label">Immagine principale dell'appartamento *</label>
                        <input type="file" class="form-control" id="cover" name="cover" required aria-label="file example" required>
                        {{-- error --}}
                        @error('cover')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- per inserire più immagini alla volta --}}
                    <div class="mb-3">
                        <label for="url" class="form-label">Inserire l'album immagini</label>
                        <input type="file" class="form-control" id="url" name="images[]" multiple>                     
                    </div>

                    {{-- servizi --}}
                    <div class="mb-3">
                        <label class="form-label" for="services">Servizi *</label>
                        <div id="checkbox-feedback" class="invalid-feedback"></div>
                        @foreach ($services as $element)
                            <div class="form-check">
                                <label for="check-service-{{ $element->id }}" class="form-check-label">
                                    {{ $element->name }}
                                    <i class="fa-solid {{ $element->icon }}"></i>
                                </label>
                                <input class="form-check-input" type="checkbox" name="services[]" id="check-service-{{ $element->id }}" value="{{ $element->id }}"  {{ in_array( $element->id, old( 'services', []) ) ? 'checked' : ''}} >
                            </div>
                        @endforeach
                    </div>

                    {{-- prezzo --}}
                    <div class="mb-3">
                        <label class="form-label" for="price">Prezzo</label>
                        <input class="form-control" type="number" id="price" name="price" min="0" value="{{ old('price') }}">
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
    @vite(['resources/js/validation.js']);
    @vite(['resources/js/tom.js']);
@endsection
