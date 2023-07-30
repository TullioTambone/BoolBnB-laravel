const form = document.getElementById('payment-form');

braintree.dropin.create({
        authorization: clientToken,
        container: '#dropin-container'
    }).then((dropinInstance) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            let radioButtons = document.querySelectorAll("input[type='radio']");
            let isChecked = false;
            
            for (const elem of radioButtons) {
                
                // Interrompi il ciclo se trovi una corrispondenza
                if (elem.checked) {
                    isChecked = true;
                    elem.setAttribute('class', 'btn-check is-valid');
                    break; 
        
                } 
            }
        
            if (isChecked) {  
                dropinInstance.requestPaymentMethod().then((payload) => {
                                        
                    document.getElementById('nonce').value = payload.nonce;
                    hideContent(form);
                }).catch((error) => { throw error; });
            } else {
                // Nessun pulsante selezionato, quindi aggiungi la classe is-invalid a tutti i pulsanti
                radioButtons.forEach(elem => elem.setAttribute('class', 'btn-check is-invalid'));
                return;
            }
        });
    }).catch((error) => {
        // handle errors
    }
)

function hideContent(form){
            
    // creo un nuovo oggetto per copiare tutte le chiavi valore
    const formData = new FormData(form);
    const submit = document.getElementById('submit-payment');

    if (formData.get('subscription_id') === null && formData.get('subscription_id') === null) {
        alert('Seleziona almeno un\'opzione di sponsorizzazione prima di procedere.');
        return;
    }

    submit.style.display = 'none';
    document.getElementById('loading').innerHTML = `
        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
        <span role="status">Loading...</span>
    `;
    form.submit();
}