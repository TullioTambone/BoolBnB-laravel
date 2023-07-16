@extends('layouts.app')

@section('content')

<h1>sono la index</h1>
@foreach($apartments as $elem)
<div>
    <li>

        {{-- show --}}
        <a href="{{route('admin.show', $elem)}}"> {{ $elem->title }} </a>
        <span> - </span>

        {{-- edit --}}
        <a href="{{route('admin.edit', $elem)}}">edit</a>
        <span> - </span>

        {{-- delete --}}
        <form action="{{ route('admin.destroy', $elem) }}" method="POST" class="ms-3">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">elimina</button>
        </form>
    </li>
</div>
    
@endforeach

@endsection