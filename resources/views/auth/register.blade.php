@extends('layouts.app')

@section('content')
<div id="forms">
    <div class="container mt-5 py-5">
        <div class="row justify-content-center" id="content-form">
            <div class="col-md-8">
                <div class="">
                    <h3 class="mb-5">
                        {{ __('Registrati') }}
                        <span id="controllo">* campi obbligatori</span>
                    </h3>
    
                    <div class="card-body" >
    
                        <form method="POST" action="{{ route('register') }}" class="login">
                            @csrf
    
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                </div>
                            </div>
    
                            {{-- aggiungo cognome --}}
                            <div class="mb-4 row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>
    
                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" autocomplete="surname" autofocus>
    
                                </div>
                            </div>
    
                            {{-- aggiungo data di nascita --}}
                            <div class="mb-4 row">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Data di Nascita') }}</label>
    
                                <div class="col-md-6">
                                    <input id="birthday" type="date" class="form-control  @error('birthday') is-invalid @enderror" min='1923-01-01' max='2006-01-01' name="birthday" value="{{ old('birthday') }}" autocomplete="birthday" autofocus>
                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }} *</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            {{-- PASSWORD --}}
                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} *</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            {{-- PASSWORD CONFIRM --}}
                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }} *</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <div class="invalid-feedback">Le password non corrispondono!</div>
                                </div>
                            </div>
    
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @vite(['resources/js/register.js'])
@endsection

@section('style')
    @vite(['resources/scss/pages/_create.scss'])
@endsection