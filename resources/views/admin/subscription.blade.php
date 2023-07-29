@extends('layouts.app')

@section('content')

    {{-- braintree --}}
    <div class="container my-5 pt-5 d-flex justify-content-center align-items-center flex-column">
       <h1 class="mt-3">Pagamento avvenuto con successo!</h1>
       <h5>sarai reindirizzato ai tuoi appartamenti</h5>
       <h5>
           <a id="redirectLink" hidden href="{{route('admin.index')}}">Qui</a>
       </h5>
    </div>


@endsection

@section('script')
<script>

    function showRedirectLink() {
        document.getElementById('redirectLink').click();
    }

    setTimeout(showRedirectLink, 4000);

</script>
    
@endsection

@section('braintree')
    <script src="https://js.braintreegateway.com/web/dropin/1.39.0/js/dropin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection