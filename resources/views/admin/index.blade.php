@extends('layouts.app')

@section('content')

<h1>sono la index</h1>
@foreach($apartments as $elem)
<div>
    <li>
        {{ $elem->title }}
    </li>
</div>
    
@endforeach

@endsection