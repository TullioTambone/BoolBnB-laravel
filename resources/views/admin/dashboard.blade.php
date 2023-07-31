@extends('layouts.app')

@section('style')
@vite(['resources/scss/pages/_dashboard.scss'])
@endsection

@section('content')


<div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif


    <div class="container-fluid mt-5 py-5 dashboard-fluid">

        <div class="container dashboard">
            <h3>I Tuoi Appartamenti</h3>
            
            <div class="table-responsive">
                <table class="table table-striped
                table-hover	
                table-borderless
                align-middle">
                    <thead class="table-light">
                        <tr class="border-bottom">
                            <th>Titolo <span style="font-size: 10px; color:gray;">*clicca il titolo per accedere all'appartamento</span></th>
                            <th>Indirizzo</th>
                            <th>Prezzo &euro;</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @for ($i = 0; $i < 10; $i++)
                                <tr class="" >
                                    <td class="my-1"><a href="{{route('admin.show', $apartments[$i])}}" style="color:black; text-decoration: none;">{{$apartments[$i]->title}}</a></td>
                                    <td class="my-1">{{$apartments[$i]->address}}</td>
                                    <td class="my-1">{{$apartments[$i]->price}}</td>
                                </tr>
                            @endfor
                        </tbody>
                </table>
            </div>
            <hr>
            <h3>Appartamenti Sponsorizzati</h3>
            <div class="table-responsive">
                <table class="table table-striped
                table-hover	
                table-borderless
                align-middle">
                    <thead class="table-light">
                        <tr class="border-bottom">
                            <th>Titolo</th>
                            <th>Abbonamento</th>
                            <th>Fine Abbonamento</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($apartments as $apartment)
                                @foreach($apartment->subscriptions as $subscription)
                                    <tr class="" >
                                        <td class="my-1">{{$apartment->title}}</td>
                                        <td class="my-1">{{$subscription->name}}</td>
                                        <td class="my-1"> {{ $subscription->pivot->end_subscription }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                </table>
            </div>

            <hr>
            <h3>Messaggi </h3>
            <div class="table-responsive">
                <table class="table table-striped
                table-hover	
                table-borderless
                align-middle">
                    <thead class="table-light">
                        <tr class="border-bottom">
                            <th>Appartamento</th>
                            <th>nome</th>
                            <th>email</th>
                            <th>messaggio</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                             @foreach($apartments as $apartment)
                                @foreach($apartment->leads as $lead)
                                    <tr>
                                        <td>{{ $apartment->title }}</td>
                                        <td>{{ $lead->name }}</td>
                                        <td>{{ $lead->email }}</td>
                                        <td>{{ $lead->message }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
