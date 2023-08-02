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
                <table class="table table-striped table-hover table-borderless align-middle">

                    {{-- t-head --}}
                    <thead class="table-light">

                        {{-- t-titles --}}
                        <tr class="border-bottom">
                            <th>Titolo <span style="font-size: 10px; color:gray;">*clicca il titolo per accedere all'appartamento</span></th>
                            <th>Indirizzo</th>
                            <th>Prezzo/notte</th>
                        </tr>
                    </thead>

                    {{-- t-body --}}
                    <tbody class="table-group-divider">

                        {{-- apartments --}}
                        @if ($apartments->isNotEmpty())
                            @foreach ($apartments->take(10)  as $e)
                                <tr class="" >
                                    <td class="my-1">
                                        <a id="overlink" href="{{route('admin.show', $e)}}">
                                            {{$e->title}}
                                        </a>
                                    </td>
                                    <td class="my-1">
                                        {{$e->address}}
                                    </td>
                                    <td class="my-1">
                                        <span data-price="{{ $e->price }}">{{ $e->price }}&euro;</span>
                                    </td>
                                </tr>
                            @endforeach      
                        @else

                        {{-- no apartments --}}
                            <tr>
                                <td>
                                    Non ci sono appartamenti 
                                </td>
                            </tr>  
                        @endif
                        
                    </tbody>
                </table>
            </div>
            <hr>

            {{-- sponsored apartments --}}
            <h3>Appartamenti Sponsorizzati</h3>
            <div class="table-responsive">

                {{-- table --}}
                <table class="table table-striped table-hover table-borderless align-middle">

                    {{-- t-head --}}
                    <thead class="table-light">

                        {{-- t-titles --}}
                        <tr class="border-bottom">
                            <th>Titolo</th>
                            <th>Abbonamento</th>
                            <th>Fine Abbonamento</th>
                        </tr>
                    </thead>

                    {{-- t-body --}}
                    <tbody class="table-group-divider">

                        {{-- subscriptions --}}
                        {{-- @if ($apartments->isNotEmpty())
                            @php $shownSubscriptions = 0; @endphp
                            @foreach($apartments as $apartment)
                                @foreach($apartment->subscriptions as $subscription)
                                    @if ($shownSubscriptions >= 10)
                                        @php break; @endphp
                                    @endif
                                    <tr class="">
                                        <td class="my-1">{{$apartment->title}}</td>
                                        <td class="my-1">{{$subscription->name}}</td>
                                        <td class="my-1"> {{ $subscription->pivot->end_subscription }}</td>
                                    </tr>
                                    @php $shownSubscriptions++; @endphp
                                @endforeach
                            @endforeach
                        @else --}}
                        {{-- no apartments --}}
                            {{-- <tr>
                                <td colspan="3">
                                    Non ci sono appartamenti sponsorizzati
                                </td>
                            </tr>  
                        @endif
                         --}}
                        @if ($apartments->isNotEmpty())
                            @php $shownSubscriptions = 0; @endphp
                            @foreach($apartments as $apartment)
                                @foreach($apartment->subscriptions as $subscription)
                                    @if ($shownSubscriptions >= 10)
                                        @php break; @endphp
                                    @endif
                                    <tr class="">
                                        <td class="my-1">{{$apartment->title}}</td>
                                        <td class="my-1">{{$subscription->name}}</td>
                                        <td class="my-1"> {{ $subscription->pivot->end_subscription }}</td>
                                    </tr>
                                    @php $shownSubscriptions++; @endphp
                                @endforeach
                            @endforeach

                            @if ($shownSubscriptions === 0)
                                {{-- no sponsored apartments --}}
                                <tr>
                                    <td colspan="3">
                                        Non ci sono appartamenti sponsorizzati
                                    </td>
                                </tr>
                            @endif
                        @else
                            {{-- no apartments --}}
                            <tr>
                                <td colspan="3">
                                    Non ci sono appartamenti
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <hr>

            {{-- messages --}}
            <h3>Messaggi </h3>
            <div class="table-responsive">

                {{-- table --}}
                <table class="table table-striped table-hover table-borderless align-middle">

                    {{-- t-head --}}
                    <thead class="table-light">

                        {{-- t-titles --}}
                        <tr class="border-bottom">
                            <th>Appartamento</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Messaggio</th>
                        </tr>
                    </thead>

                    {{-- t-body --}}
                    <tbody class="table-group-divider">
                        {{-- @foreach($apartments as $apartment)
                            @foreach($apartment->leads as $lead)
                                <tr>
                                    <td>{{ $apartment->title }}</td>
                                    <td>{{ $lead->name }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->message }}</td>
                                </tr>
                            @endforeach
                        @endforeach --}}

                        @if ($apartments->isNotEmpty())
                            @php $shownMessages = 0; @endphp
                            @foreach($apartments as $apartment)
                                @foreach($apartment->leads as $lead)
                                    @if ($shownMessages >= 10)
                                        @php break; @endphp
                                    @endif
                                    <tr>
                                        <td>{{ $apartment->title }}</td>
                                        <td>{{ $lead->name }}</td>
                                        <td>{{ $lead->email }}</td>
                                        <td>{{ $lead->message }}</td>
                                    </tr>
                                    @php $shownMessages++; @endphp
                                @endforeach
                            @endforeach
                            @if ($shownMessages === 0)
                                {{-- no messages --}}
                                <tr>
                                    <td colspan="4">
                                        Non ci sono messaggi
                                    </td>
                                </tr>
                            @endif
                        @else
                            {{-- no apartments --}}
                            <tr>
                                <td colspan="3">
                                    Non ci sono appartamenti
                                </td>
                            </tr>
                        @endif   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @vite(['resources/js/dashboard.js'])
@endsection

@section('style')
@vite(['resources/scss/_dashboard.scss'])

@endsection