@extends('layouts.app')

@section('content')
{{ $token }}
    {{-- braintree --}}
    <div class="container my-5 py-12">
        <div class="row justify-content-center">
            <div class="col-6">

                @csrf
                <div id="dropin-container"></div>
            
                <button id="submit-button" class="button button--small button--green">Submit payment</button>
            </div>
        </div>
    </div>

    <script>
        
        let button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: sandbox_{{ $token }} ,
            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err,payload){
                    
                    axios.post('{{ route("token") }}', {
                        nonce: payload.nonce
                    }, {
                        headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(function (response) {
                        console.log('success', payload.nonce);
                    })
                    .catch(function (error) {
                        console.log('error', payload.nonce);
                    });
                });
            });
        });
    </script>

@endsection

@section('script')
    {{-- @vite('resources/js/braintree.js') --}}
    
@endsection

@section('braintree')
    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.39.0/js/dropin.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script> --}}

    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
@endsection