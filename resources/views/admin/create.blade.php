@extends('layouts.app')

@section('content')
<div class="container">
    <h2>create apartment</h2>
    
        <div class="row justify-content-center">
            <div class="col-7">
                <form id="form-create" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    
                    @csrf

                    {{-- title --}}
                    <div>
                        <label for="title">Titolo</label>
                        <input class="form-control" @error('title') is-invalid  @enderror type="text" id="title" name="title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- description --}}
                    <div>
                        <label for="description">Content</label>
                        <textarea class="form-control" @error('description') is-invalid  @enderror name="description" id="description" rows="10"></textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- rooms --}}
                    <div>
                        <label for="rooms">rooms</label>
                        <input class="form-control" @error('rooms') is-invalid  @enderror type="number" id="rooms" name="rooms" min="0">
                        @error('rooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bedrooms --}}
                    <div>
                        <label for="bedrooms">bedrooms</label>
                        <input class="form-control" @error('bedrooms') is-invalid  @enderror type="number" id="bedrooms" name="bedrooms" min="0">
                        @error('bedrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bathrooms --}}
                    <div>
                        <label for="bathrooms">bathrooms</label>
                        <input class="form-control" @error('bathrooms') is-invalid  @enderror type="number" id="bathrooms" name="bathrooms" min="0">
                        @error('bathrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- square meters --}}
                    <div>
                        <label for="square_meters">square_meters</label>
                        <input class="form-control" @error('square_meters') is-invalid  @enderror type="number" id="square_meters" name="square_meters" min="0">
                        @error('square_meters')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address
                        esempio: Via... civico, 0001.. RM, Regione
                         --}}
                    <div>
                        <label for="address">address</label>
                        <input class="form-control" @error('address') is-invalid  @enderror type="text" id="address" name="address">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- visibility --}}
                    <div>
                        <input type="radio" name="visibility" value="1">
                        <label for="visibility">yes</label><br>
                        <input type="radio" name="visibility" value="0" checked>
                        <label for="visibility">no</label><br>
                    </div>

                    {{-- cover --}}
                    <div class="mb-3">
                        <label for="cover" class="form-label">immagine principale dell'appartamento</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover">
                        {{-- error --}}
                        @error('cover')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- per inserire più immagini alla volta --}}
                    <div class="mb-3">
                        <label for="url" class="form-label">inserire l'album immagini</label>
                        <input type="file" class="form-control @error('url') is-invalid @enderror" id="url" name="images[]" multiple>
                        {{-- error --}}
                        @error('url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- servizi --}}
                    <div class="mb-3">
                        @foreach ($services as $element)
                        <div>
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
                        <input class="form-control" @error('price') is-invalid  @enderror type="number" id="price" name="price">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- inputs hidden --}}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="latitude" id="latitude" value="">
                    <input type="hidden" name="longitude" id="longitude" value="">

                    <button class="btn btn-success" type="submit">Salva</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
