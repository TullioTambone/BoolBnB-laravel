@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h1>sono la index</h1>

    <ul>
        @foreach($apartments as $elem)
            <li class="my-2">            
                {{-- show --}}
                <a href="{{route('admin.show', $elem)}}"
                    class="fs-4"
                >
                    {{ $elem->title }}
                </a>
                
    
                <div class="d-flex column-gap-3 mt-1">
    
                    {{-- edit --}}
                    <a href="{{route('admin.edit', $elem)}}"
                        class="btn btn-primary"
                    >
                        edit
                    </a>
    
                    {{-- delete --}}
                    <form action="{{ route('admin.destroy', $elem) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">elimina</button>
                    </form>
                </div>
            </li>        
        @endforeach
    </ul>
</div>

@endsection