@extends('layouts.app')

@section('content')
<div class="container">
    <h2>create apartment</h2>
    
        <div class="row justify-content-center">
            <div class="col-7">
                <form action="{{ route('apartment.store') }}" method="POST" enctype="multipart/form-data">
                    
                    @csrf

                    <div>
                        <label for="title">Titolo</label>
                        <input class="form-control" @error('title') is-invalid  @enderror type="text" id="title" name="title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description">Content</label>
                        <textarea class="form-control" @error('description') is-invalid  @enderror name="description" id="description" rows="10"></textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="rooms">rooms</label>
                        <input class="form-control" @error('rooms') is-invalid  @enderror type="number" id="rooms" name="rooms">
                        @error('rooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="bedrooms">bedrooms</label>
                        <input class="form-control" @error('bedrooms') is-invalid  @enderror type="number" id="bedrooms" name="bedrooms">
                        @error('bedrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="bathrooms">bathrooms</label>
                        <input class="form-control" @error('bathrooms') is-invalid  @enderror type="number" id="bathrooms" name="bathrooms">
                        @error('bathrooms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="square_meters">square_meters</label>
                        <input class="form-control" @error('square_meters') is-invalid  @enderror type="number" id="square_meters" name="square_meters">
                        @error('square_meters')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="address">address</label>
                        <input class="form-control" @error('address') is-invalid  @enderror type="text" id="address" name="address">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="radio" name="visibility" value="true">
                        <label for="visibility">yes</label><br>
                        <input type="radio" name="visibility" value="false" selected >
                        <label for="visibility">no</label><br>
                      
                    </div>
                    <div class="mb-3">
                        <label for="cover" class="form-label">cover</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover">
                        {{-- error --}}
                        @error('cover')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <button class="btn btn-success" type="submit">Salva</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
