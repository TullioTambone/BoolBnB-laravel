@extends('layouts.app')

@section('content')

<div id="dashboard-container">

    <div id="nav-intro" class="container px-0">

        <div class="row pb-3">
            <h4 class="col-12 fw-bold">
                Benvenuto {{Auth::user()->name}}!
            </h4>
            <p class="col-12 fs-6">
                Benvenuto nella tua area personale! Qui potrai gestire facilmente i tuoi appartamenti con pieno controllo.
            </p>
        </div>

        {{-- navbar dashboard --}}
        <nav id="navbarDashboard" class="mt-4">
            <div class="container p-0">
                <ul class="row m-0 p-0 text-center">

                    {{-- appartamenti --}}
                    <li class="col-4 p-0 link" data-target="appartamenti" id="link-apart">
                        {{ __('Appartamenti') }}                        
                    </li>

                    {{-- sponsorizzati --}}
                    <li class="col-4 p-0 link" data-target="sponsorizzati">
                        {{ __('Sponsorizzati') }} 
                    </li>

                    {{-- messaggi --}}
                    <li class="col-4 p-0 link" data-target="messaggi">
                        {{ __('Messaggi') }} 
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container dashboard pt-4 pb-5 px-0">

        {{-- appartamenti --}}
        <div class="dashboard-table" id="appartamenti">
            
            <div class="table-responsive">
                <table class="table table-hover-dash table-borderless align-middle">

                    {{-- t-head --}}
                    <thead class="table-light">

                        {{-- t-titles --}}
                        <tr class="border-bottom">
                            <th>Appartamento</th>
                            <th class="prezzoNotte">Prezzo/notte</th>
                            <th class="azioni">Azioni</th>                            
                        </tr>
                    </thead>

                    {{-- t-body --}}
                    <tbody class="table-group-divider">
                        @if ($apartments->isNotEmpty())
                            @foreach ($apartments->take(10)  as $e)

                                {{-- table row --}}
                                <tr class="" >

                                    {{-- title - image --}}
                                    <td class="my-1">
                                        <a class="text-decoration-none apartment" href="{{route('admin.show', $e)}}">
                                            <div class="d-flex">

                                                {{-- image --}}
                                                <div class="img me-3">
                                                    @if($e->cover)
                                                        @if(str_contains($e->cover, 'apartment_cover_img'))
                                                            <img class="border rounded" src="{{ asset('storage/'. $e->cover) }}" alt="{{ $e->title }}">
                                                        @else
                                                            <img class="border rounded" src="{{$e->cover}}" alt="{{ $e->title }}">
                                                        @endif
                                                    @endif
                                                </div>

                                                {{-- title --}}
                                                <div class="d-flex flex-column title">
                                                    <span class="pb-2">
                                                        {{$e->title}}
                                                    </span>
                                                    <span class="address">
                                                        {{$e->address}}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>

                                    {{-- price --}}
                                    <td class="my-1">
                                        <span data-price="{{ $e->price }}">{{ $e->price }}&euro;</span>
                                    </td>

                                    {{-- azioni --}}
                                    <td class="my-1 azioni">
                                        <div class="d-flex gap-3">
                                            {{-- edit --}}
                                            <a href="{{ route('admin.edit', $e ) }}" class="text-decoration-none" title="Modifica">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                        
                                            {{-- delete --}}
                                            <form action="{{ route('admin.destroy', $e) }}" method="POST">
                        
                                                @csrf
                                                @method('DELETE')
                
                                                <button 
                                                    type="submit" 
                                                    class="text-danger border-0 border bg-transparent"
                                                    title="Elimina Appartamento"
                                                    onclick="return confirm('Sicuro di volere eliminare questo elemento?')"    
                                                >
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
        </div>

        {{-- sponsored apartments --}}
        <div class="dashboard-table" id="sponsorizzati">
            <div class="table-responsive">

                {{-- table --}}
                <table class="table table-hover-dash table-borderless align-middle">

                    {{-- t-head --}}
                    <thead class="table-light">

                        {{-- t-titles --}}
                        <tr class="border-bottom">
                            <th>Appartamento</th>
                            <th>Abbonamento</th>
                            <th>Scadenza</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>

                    {{-- t-body --}}
                    <tbody class="table-group-divider">

                        @if ($apartments->isNotEmpty())
                            @php $shownSubscriptions = 0; @endphp
                            @foreach($apartments as $apartment)
                                @foreach($apartment->subscriptions as $subscription)
                                    @if ($shownSubscriptions >= 10)
                                        @php break; @endphp
                                    @endif
                                    @php
                                        $lastSubscription = $apartment->subscriptions->last();
                                        $originalData = $lastSubscription->getOriginal();
                                    @endphp
                                    <tr class="">
                                        
                                        {{-- title - image --}}
                                        <td class="my-1">
                                            <a class="text-decoration-none apartment" href="{{route('admin.show', $apartment)}}">
                                                <div class="d-flex">

                                                    {{-- image --}}
                                                    <div class="img me-3">
                                                        @if($apartment->cover)
                                                            @if(str_contains($apartment->cover, 'apartment_cover_img'))
                                                                <img class="border rounded" src="{{ asset('storage/'. $apartment->cover) }}" alt="{{ $apartment->title }}">
                                                            @else
                                                                <img class="border rounded" src="{{$apartment->cover}}" alt="{{ $apartment->title }}">
                                                            @endif
                                                        @endif
                                                    </div>

                                                    {{-- title --}}
                                                    <div class="d-flex flex-column title">
                                                        <span class="pb-2">
                                                            {{$apartment->title}}
                                                        </span>
                                                        <span class="address">
                                                            {{$apartment->address}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>

                                        {{-- nome sponsorizzazione --}}
                                        <td class="my-1">
                                            {{$subscription->name}}
                                        </td>

                                        {{-- fine sponsorizzazione --}}
                                        <td class="my-1">
                                            {{ \Illuminate\Support\Carbon::parse($subscription->pivot->end_subscription)->format('Y-m-d') }}
                                        </td>

                                        {{-- azioni --}}
                                        <td class="my-1 azioni">

                                            {{-- cancella sponsorizzazione --}}
                                            <form action="{{ route('admin.subscription.destroy') }}" onclick="showConfirmModal2();" method="POST" id="my-sub-form" class="ms-3">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                                                <input type="hidden" name="subscription_id" value="{{ $originalData['pivot_subscription_id'] }}">

                                                {{-- button --}}
                                                <button 
                                                    type="submit" 
                                                    class="text-danger border-0 border bg-transparent"
                                                    title="Annulla Sponsorizzazione"
                                                >                    
                                                    <i class="fa-solid fa-square-xmark fs-5"></i>
                                                </button>
            
                                            </form>

                                             {{-- confirm modal subscription --}}                                
                                            <div id="my-modal">
                                                <div id="confirm-modal" class="modal">
                                                    <div class="modal-content">
                                                        <h2>Conferma l'operazione</h2>
                                                        <p>Sei sicuro di voler annullare la sottoscrizione?</p>
                                                        <div class="modal-buttons">
                                                            <button id="confirm-yes" class="btn btn-danger">Sì</button>
                                                            <button id="confirm-no" class="btn btn-secondary">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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
        </div>

        {{-- messages --}}
        <div class="dashboard-table" id="messaggi">
            <div class="table-responsive">

                {{-- table --}}
                <table class="table table-hover-dash table-borderless align-middle">

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

                        @if ($apartments->isNotEmpty())
                            @php $shownMessages = 0; @endphp
                            @foreach($apartments as $apartment)
                                @foreach($apartment->leads as $lead)
                                    @if ($shownMessages >= 10)
                                        @php break; @endphp
                                    @endif
                                    <tr>
                                        <td>
                                            <a class="text-decoration-none apartment" href="{{route('admin.show', $apartment)}}">
                                                <div class="d-flex">

                                                    {{-- image --}}
                                                    <div class="img me-3">
                                                        @if($apartment->cover)
                                                            @if(str_contains($apartment->cover, 'apartment_cover_img'))
                                                                <img class="border rounded" src="{{ asset('storage/'. $apartment->cover) }}" alt="{{ $apartment->title }}">
                                                            @else
                                                                <img class="border rounded" src="{{$apartment->cover}}" alt="{{ $apartment->title }}">
                                                            @endif
                                                        @endif
                                                    </div>

                                                    {{-- title --}}
                                                    <div class="d-flex flex-column title">
                                                        <span class="pb-2">
                                                            {{$apartment->title}}
                                                        </span>
                                                        <span class="address">
                                                            {{$apartment->address}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>    
                                        </td>
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
    <script>

        function showConfirmModal2() {
            event.preventDefault();
            var modal = document.getElementById("confirm-modal");
            modal.style.display = "block";

            var confirmYes = document.getElementById("confirm-yes");
            confirmYes.onclick = function () {
                modal.style.display = "none";
                document.querySelector("#my-sub-form").submit();
            };

            var confirmNo = document.getElementById("confirm-no");
            confirmNo.onclick = function () {
                modal.style.display = "none";
            };
        }
    </script>
    @vite(['resources/js/dashboard.js'])
@endsection