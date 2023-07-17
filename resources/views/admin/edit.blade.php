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
                <form id="form-create" action="{{ route('admin.update',  ['admin' => $singolo_apartment->id]) }}" method="POST" enctype="multipart/form-data">
                    
                    {{-- token --}}
                    @csrf

                    @method('PUT')

                    {{-- title --}}
                    <div>
                        <label for="title">Titolo</label>
                        <input class="form-control" @error('title') is-invalid  @enderror type="text" id="title" name="title" value="{{old('title') ?? $singolo_apartment->title }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- description --}}
                    <div>
                        <label for="description">Content</label>
                        <textarea class="form-control" @error('description') is-invalid  @enderror name="description" id="description" rows="5" >{{old('description') ?? $singolo_apartment->description }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- rooms --}}
                    <div>
                        <label for="rooms">rooms</label>
                        <input class="form-control" @error('rooms') is-invalid  @enderror type="number" id="rooms" name="rooms" min="0" value="{{old('rooms') ?? $singolo_apartment->rooms }}">
                        @error('rooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bedrooms --}}
                    <div>
                        <label for="bedrooms">bedrooms</label>
                        <input class="form-control" @error('bedrooms') is-invalid  @enderror type="number" id="bedrooms" name="bedrooms" min="0" value="{{old('bedrooms') ?? $singolo_apartment->bedrooms }}">
                        @error('bedrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bathrooms --}}
                    <div>
                        <label for="bathrooms">bathrooms</label>
                        <input class="form-control" @error('bathrooms') is-invalid  @enderror type="number" id="bathrooms" name="bathrooms" min="0" value="{{old('bathrooms') ?? $singolo_apartment->bathrooms }}">
                        @error('bathrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- square meters --}}
                    <div>
                        <label for="square_meters">square_meters</label>
                        <input class="form-control" @error('square_meters') is-invalid  @enderror type="number" id="square_meters" name="square_meters" min="0" value="{{old('square_meters') ?? $singolo_apartment->square_meters }}">
                        @error('square_meters')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address --}}
                    <div>
                        <label for="address">address</label>
                        <input class="form-control" @error('address') is-invalid  @enderror type="text" id="address" name="address" value="{{old('address') ?? $singolo_apartment->address }}">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- visibility --}}
                    <div>
                        <label class="d-block" for="visibility">Vuoi rendere visibile il tuo appartamento?</label>
                        <input type="radio" name="visibility" value="1" {{ old('visibility', $singolo_apartment->visibility) == $singolo_apartment->visibility ? "checked" : '' }}>
                        <label for="visibility" >yes</label><br>
                        <input type="radio" name="visibility" value="0" {{ old('visibility', $singolo_apartment->visibility) == $singolo_apartment->visibility ? "checked" : '' }}>
                        <label for="visibility">no</label><br>

                        @error('visibility')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- cover --}}
                    <div class="mb-3">
                        <label for="cover" class="form-label">immagine principale dell'appartamento</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover">
                        {{-- error --}}
                        @error('cover')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <img class="mt-1" style="width: 100px" src="{{asset('storage/' . $singolo_apartment->cover)}}" alt="">
                    </div>

                    {{-- send more images togheter --}}
                    <div class="mb-3">
                        <label for="url" class="form-label">inserire l'album immagini</label>
                        <input type="file" class="form-control @error('url') is-invalid @enderror" id="url" name="images[]" multiple>
                        {{-- error --}}
                        @error('url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- services --}}
                    <div class="mb-3">
                        @foreach ($services as $element)
                        <div>
                            <label for="check-service-{{ $element->id }}" class="form-label">
                                {{ $element->name }}
                                <i class="fa-solid {{ $element->icon }}"></i>
                            </label>
                            
                            <input type="checkbox" name="services[]" id="check-service-{{ $element->id }}" value="{{ $element->id }}" {{ $singolo_apartment->services->contains($element) ? "checked" : '' }}> 
                             
                            @error('services')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        @endforeach
                    </div>

                    {{-- price --}}
                    <div>
                        <label for="price">Prezzo</label>
                        <input class="form-control" @error('price') is-invalid  @enderror type="number" id="price" name="price" value="{{old('price') ?? $singolo_apartment->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
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
