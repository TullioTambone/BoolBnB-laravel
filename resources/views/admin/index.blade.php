@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center my-2">I TUOI APPARTAMENTI</h1>
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
                            {{$elem->address}}
                        </span>
                    </a>
                
                    <div class="d-flex column-gap-2 col-12 col-md-6 col-lg-6 justify-content-center">
                        {{-- edit --}}
                        <div>
                            <a href="{{route('admin.edit', $elem)}}" class="btn btn-primary">
                                edit
                            </a>
                        </div>
        
                        {{-- delete --}}
                        <form action="{{ route('admin.destroy', $elem) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">elimina</button>
                        </form>
                    </div>
                </div>
            </li>        
        @endforeach
    </ul>
</div>

@endsection