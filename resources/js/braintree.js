// let button = document.querySelector('#submit-button');

// braintree.dropin.create({
//     authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
//     selector: '#dropin-container'

// }, function (err, instance) {
//     button.addEventListener('click', function () {
//         instance.requestPaymentMethod(function (err, payload) {
//         // Submit payload.nonce to your server
//         });
//     })
// });

let button = document.querySelector('#submit-button');

braintree.dropin.create({
    authorization: "sandbox_g42y39zw_348pk9cgf3bgyw2b",
    container: '#dropin-container'
}, function (createErr, instance) {
    button.addEventListener('click', function () {

        instance.requestPaymentMethod(function (err, payload) {
            axios.get("http://127.0.0.1:8000/api/subscription/process", {params: payload})
            .then( function (response) {

                console.log(response);
                if (response.success) {
                alert('Payment successfull!');
                } else {
                alert('Payment failed');
                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        });
    });
});

// 5333 1711 5883 9726