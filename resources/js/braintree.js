const form = document.getElementById('payment-form');

braintree.dropin.create({
    authorization: 'sandbox_hcbkfbtr_h6fcm68ztg8r4hv9',
    container: '#dropin-container'
    }, (error, dropinInstance) => {
    if (error) console.error(error);
    
    
    form.addEventListener('submit', event => {
        event.preventDefault();
        
        event.preventDefault();
        let radioButtons = document.querySelectorAll("input[type='radio']");
        let isChecked = false;
        
        for (const elem of radioButtons) {
            
            // Interrompi il ciclo se trovi una corrispondenza
            if (elem.checked) {
                isChecked = true;
                elem.setAttribute('class', 'btn-check is-valid');
                break; 
    
            } else {
                isChecked = false;
                elem.setAttribute('class', 'btn-check is-invalid');
            }
        }

        if (isChecked) {     
            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);
    
    
                // Step four: when the user is ready to complete their
                //   transaction, use the dropinInstance to get a payment
                //   method nonce for the user's selected payment method, then add
                //   it a the hidden field before submitting the complete form to
                //   a server-side integration
                document.getElementById('nonce').value = payload.nonce;
                form.submit();
            });
        }
    });
});