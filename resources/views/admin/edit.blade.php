@extends('layouts.app')

@section('content')
<div class="container">
    <h2>edit apartment</h2>
    
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

                {{-- form update --}}
                <form id="form" action="{{ route('admin.update',  $apartment) }}" method="POST" enctype="multipart/form-data">
                    
                    {{-- token --}}
                    @csrf

                    @method('PUT')

                    {{-- title --}}
                    <div>
                        <label for="title">Titolo *</label>
                        <input required class="form-control" type="text" id="title" name="title" value="{{old('title') ?? $apartment->title }}" autocomplete="off">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- description --}}
                    <div>
                        <label for="description">Descrizione</label>
                        <textarea class="form-control"  name="description" id="description" rows="5" >{{old('description') ?? $apartment->description }}</textarea>
                    </div>

                    {{-- rooms --}}
                    <div>
                        <label for="rooms">Stanze *</label>
                        <input required class="form-control" type="number" id="rooms" name="rooms" min="0" value="{{old('rooms') ?? $apartment->rooms }}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('rooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bedrooms --}}
                    <div>
                        <label for="bedrooms">Camere da letto *</label>
                        <input required class="form-control" type="number" id="bedrooms" name="bedrooms" min="0" value="{{old('bedrooms') ?? $apartment->bedrooms }}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('bedrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bathrooms --}}
                    <div>
                        <label for="bathrooms">Bagni *</label>
                        <input required class="form-control" type="number" id="bathrooms" name="bathrooms" min="0" value="{{old('bathrooms') ?? $apartment->bathrooms }}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('bathrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- square meters --}}
                    <div>
                        <label for="square_meters">Metri Quadrati *</label>
                        <input required class="form-control" type="number" id="square_meters" name="square_meters" min="0" value="{{old('square_meters') ?? $apartment->square_meters }}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        @error('square_meters')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address --}}
                    <div>
                        <label for="address">Indirizzo *</label>
                        <input required list="data" class="form-control" type="text" id="address" name="address" value="{{old('address') ?? $apartment->address }}" autocomplete="off">
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
                        <input type="radio" name="visibility" value="1" {{ old('visibility', $apartment->visibility) == $apartment->visibility ? "checked" : '' }}>
                        <label for="visibility" >Si</label><br>
                        <input type="radio" name="visibility" value="0" {{ old('visibility', $apartment->visibility) == $apartment->visibility ? "checked" : '' }}>
                        <label for="visibility">No</label><br>

                        @error('visibility')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- cover --}}
                    <div class="mb-3">
                        <label for="cover" class="form-label">Immagine principale dell'appartamento *</label>
                        <input type="file" class="form-control" id="cover" name="cover">
                        {{-- error --}}
                        @error('cover')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @if($apartment->cover)
                            <img class="mt-1" style="width: 100px" src="{{asset('storage/' . $apartment->cover)}}" alt="">
                        @endif
                    </div>

                    {{-- send more images togheter --}}
                    <div class="mb-3">
                        <label for="url" class="form-label">Inserire l'album immagini</label>
                        <input type="file" class="form-control" id="url" name="images[]" multiple>

                        @if ($apartment->images)
                            <div class="my-3">
                                @forelse($apartment->images as $image)
                                    <img class="mt-1" style="width: 100px" src="{{asset('storage/' . $image->url)}}" alt="">
                                @empty
                                    <span>
                                        No images available.
                                    </span>
                                @endforelse
                            </div>
                        @endif
                    </div>

                    {{-- services --}}
                    <div class="mb-3">
                        <label class="mb-2" for="services">Servizi *</label>
                        <div id="checkbox-feedback" class="invalid-feedback"></div>
                        @foreach ($services as $element)
                        <div>
                            <label for="check-service-{{ $element->id }}" class="form-label">
                                {{ $element->name }}
                                <i class="fa-solid {{ $element->icon }}"></i>
                            </label>
                            
                            <input type="checkbox" name="services[]" id="check-service-{{ $element->id }}" value="{{ $element->id }}" {{ $apartment->services->contains($element) ? "checked" : '' }}> 
                        </div>
                        @endforeach
                    </div>

                    {{-- price --}}
                    <div>
                        <label for="price">Prezzo</label>
                        <input class="form-control"  type="number" id="price" name="price" min="0" value="{{old('price') ?? $apartment->price }}">
                        <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                    </div>
                    
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
    @vite(['resources/js/tom.js'])

@endsection