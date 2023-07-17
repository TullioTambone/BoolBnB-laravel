@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo Indirizzo Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Ti abbiamo inviato una Email di verifica') }}
                    </div>
                    @endif

                    {{ __('Prima di continuare verifica la tua Email') }}
                    {{ __('Se non hai ricevuto l\' Email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Clicca qua per richiederne un\' altra') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
