@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5" id="forms">
    <h2>Modifica il tuo appartmento<span id="controllo">* campi obbligatori</span></h2>
    
        <div class="row justify-content-center container"  id="content-form">
            <div class="col-12 col-lg-9 col-xl-7">

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
                <form class="edit" id="form" action="{{ route('admin.update',  $apartment) }}" method="POST" enctype="multipart/form-data">
                    
                    {{-- token --}}
                    @csrf

                    @method('PUT')
                    <div class="row">

                        {{-- title --}}
                        <div class="mb-3 col-12">
                            <label for="title"><strong>Titolo *</strong> </label>
                            <input required class="form-control" type="text" id="title" name="title" value="{{old('title') ?? $apartment->title }}" autocomplete="off">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- description --}}
                        <div class="mb-3 col-12">
                            <label for="description"><strong>Descrizione</strong> </label>
                            <textarea class="form-control"  name="description" id="description" rows="5">{{old('description') ?? $apartment->description }}</textarea>
                        </div>
    
                        {{-- rooms --}}
                        <div class="mb-3 col-12 col-md-3">
                            <label for="rooms"><strong>Stanze *</strong></label>
                            <input required class="form-control" type="number" id="rooms" name="rooms" min="0" value="{{old('rooms') ?? $apartment->rooms }}">
                            <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                            @error('rooms')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        {{-- bedrooms --}}
                        <div class="mb-3 col-12 col-md-3">
                            <label for="bedrooms"><strong>Camere da letto *</strong></label>
                            <input required class="form-control" type="number" id="bedrooms" name="bedrooms" min="0" value="{{old('bedrooms') ?? $apartment->bedrooms }}">
                            <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                            @error('bedrooms')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        {{-- bathrooms --}}
                        <div class="mb-3 col-12 col-md-3">
                            <label for="bathrooms"><strong>Bagni *</strong></label>
                            <input required class="form-control" type="number" id="bathrooms" name="bathrooms" min="0" value="{{old('bathrooms') ?? $apartment->bathrooms }}">
                            <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                            @error('bathrooms')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        {{-- square meters --}}
                        <div class="mb-3 col-12 col-md-3">
                            <label for="square_meters"><strong>Metri Quadrati *</strong></label>
                            <input required class="form-control" type="number" id="square_meters" name="square_meters" min="0" value="{{old('square_meters') ?? $apartment->square_meters }}">
                            <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                            @error('square_meters')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        {{-- address --}}
                        <div class="mb-3 col-12">
                            <label for="address"><strong>Indirizzo *</strong></label>
                            <input required list="datalistOptions" class="form-control" type="text" id="address" name="address" value="{{old('address') ?? $apartment->address }}" autocomplete="off">
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="invalid-feedback">Inserisci un indirizzo valido!</div>
                            <datalist id="datalistOptions">                            
                            </datalist>
                        </div>
    
                        {{-- visibility --}}
                        <div class="mb-3 col-12">
                            <label class="d-block" for="visibility"><strong>Vuoi rendere visibile il tuo appartamento? *</strong></label>
                            <input type="radio" name="visibility" value="1" {{ old('visibility', $apartment->visibility) === 1 ? "checked" : '' }}>
                            <label for="visibility" >Si</label><br>
                            <input type="radio" name="visibility" value="0" {{ old('visibility', $apartment->visibility) === 0 ? "checked" : '' }}>
                            <label for="visibility">No</label><br>
    
                            @error('visibility')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        {{-- cover --}}
                        <div class="mb-3 col-12">
                            <div class="row">
                                <label for="cover" class="form-label col-12"><strong>Immagine principale dell'appartamento *</strong></label>
                                <div class="col-6">
                                    <input type="file" class="form-control" id="cover" name="cover">
                                    {{-- error --}}
                                    @error('cover')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">

                                    @if($apartment->cover)

                                        @if(str_contains($apartment->cover, 'apartment_cover_img'))
                                            <img style="width: 250px; aspect-ration: 1; border-radius: 20px" class="img-fluid" src="{{ asset('storage/'. $apartment->cover) }}" alt="{{ $apartment->title }}">
                                        @else
                                            <img style="width: 250px; aspect-ration: 1; border-radius: 20px" class="img-fluid" src="{{$apartment->cover}}" alt="{{ $apartment->title }}">
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
    
                        {{-- send more images togheter --}}
                        <div class="mb-3 col-12">
                            <label for="url" class="form-label"><strong>Inserire l'album immagini</strong></label>
                            <input type="file" class="form-control" id="url" name="images[]" multiple>
    
                            @if ($apartment->images)
                                <div class="my-3 d-flex flex-wrap">
                                    @forelse($apartment->images as $image)

                                        @if(str_contains($image->url, 'images'))
                                            <img class="w-25" src="{{ asset('storage/'. $image->url) }}" alt="{{ $apartment->title }}">
                                        @else
                                            <img class="w-25" src="{{$image->url}}" alt="{{ $apartment->title }}">
                                        @endif
                                    @empty
                                        <span>
                                            Non ci sono immagini
                                        </span>
                                    @endforelse
                                </div>
                            @endif
                        </div>
    
                        {{-- services --}}
                        <div class="mb-3 col-12">
                            <label class="form-label" for="services"><strong>Servizi *</strong></label>
                            <div id="checkbox-feedback" class="invalid-feedback"></div>
                            <div class="row ps-2">
                                @foreach ($services as $element)
                                    <div class="form-check col-12 col-md-6 ps-0">
                                        <div class="d-flex">
                                            <input class="form-check-input ps-0 ms-0" type="checkbox" name="services[]" id="check-service-{{ $element->id }}" value="{{ $element->id }}" {{ $apartment->services->contains($element) ? "checked" : '' }}>
    
                                            <label for="check-service-{{ $element->id }}" class="form-check-label">
                                                <i class="mx-2 fa-solid {{ $element->icon }}"></i>
                                                <span>
                                                    {{ $element->name }}
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
    
                        {{-- price --}}
                        <div class="mb-3 col-12">
                            <label for="price"><strong>Prezzo &euro;/notte</strong></label>
                            <input class="form-control"  type="number" id="price" name="price" min="0" max= "999999" value="{{old('price') ?? $apartment->price }}">
                            <div class="invalid-feedback">Non puoi inserire un numero negativo!</div>
                        </div>
                        
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="latitude" id="latitude" value="">
                        <input type="hidden" name="longitude" id="longitude" value="">
    
                        <button id="submit" class="btn btn-success my-3 w-25 col-12 m-auto" type="submit">Salva</button>
                    </div>
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