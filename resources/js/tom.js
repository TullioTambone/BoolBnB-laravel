// //    PROVE PER INTEGRAZIONE MAPPA E PUNTATORE MAPPA
    
//     document.getElementById('mappa').innerHTML = `<div id="map" class="map position-relative" style="width=500px; height=500px;"></div>`;
//     //document.querySelector('.mapboxgl-marker').classList.add("position-absolute");
//     point =  [elem.position.lng, elem.position.lat];
//     if (!map) {
//         // Inizializza la mappa solo se non è stata già creata
//         map = tt.map({
//             key: "74CVsbN34KoIljJqOriAYN2ZMEYU1cwO",
//             center: point, // Inverti la latitudine e longitudine per la posizione corretta
//             container: "map",
//             zoom: 15,
//         });
//     }

//     // Aggiorna la posizione del marker se esiste
//     if (marker) {
//         marker.setLngLat([elem.position.lng, elem.position.lat]);
//     } else {
//         // Crea il marker solo se non esiste
//         marker = new tt.Marker().setLngLat([elem.position.lng, elem.position.lat]).addTo(map);
//     }
// importazione tom tom

// import tt from "@tomtom-international/web-sdk-maps";

import ttServices from "@tomtom-international/web-sdk-services"

// let map;
// let marker = null;
// let point = null;
// Ottenimento del riferimento al form

// form create
const form = document.querySelector('#form');
// chekboxes
const checkboxes = form.querySelectorAll('input[type="checkbox"]');
// input address
const formAddress = document.querySelector('#address');
// checkbox-feedback
const checkFeed = document.getElementById('checkbox-feedback')
// booleans
let isAddressOk = false;
let isAnyCheckboxChecked = false;

// address
const addressEdit = document.querySelector('#address').value;

// se address ha già un valore
if(addressEdit ) {
    addressCheck(addressEdit) 
}

// Aggiunta di un gestore di eventi al submit del form
formAddress.addEventListener('keyup', async () => {
    
    // Ottenimento dell'indirizzo dal campo input
    const address = document.querySelector('#address').value;

    // se address esiste
    addressCheck(address) 
});

// Gestore di eventi per il submit del form 
form.addEventListener('submit', function (e) {

    // Controlla se almeno un checkbox è stato selezionato
    isAnyCheckboxChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

    checkboxes.forEach(checkbox => {
        // Aggiungi le classi di validità o invalidità in base allo stato del checkbox
        checkbox.setAttribute('class', checkbox.checked ? 'form-check-input is-valid' : 'form-check-input is-invalid');
    });

    if (!isAnyCheckboxChecked) {
        // Mostra il messaggio di errore se nessun checkbox è selezionato
        checkFeed.style.display = 'block';
        checkFeed.innerHTML = `Seleziona almeno un campo dei Servizi`;
    } else {
        // Nascondi il messaggio di errore se almeno un checkbox è selezionato
        checkFeed.style.display = 'none';
    }

    if (isAnyCheckboxChecked && isAddressOk) {
        
        form.submit();
    } else {
        e.preventDefault()
    }
});


function addressCheck(address) {
    // se address esiste
    if( address ) {

        ttServices.services.geocode({
            batchMode: 'async',
            key: "74CVsbN34KoIljJqOriAYN2ZMEYU1cwO",
            query: address,
            countrySet: 'IT',
            language: 'it-IT',
        }).then(
            function (response) {
                
                const results = response.results;
                console.log(results)                

                // se abbiamo dei risultati ottenuti
                if (results.length)  {   

                    for (const elem of results) {
                        document.getElementById('data').innerHTML += `<option value="${elem.address.freeformAddress}">${elem.address.freeformAddress}</option>`;
                        
                        // Interrompi il ciclo se trovi una corrispondenza
                        if (elem.address.freeformAddress === address) {
                            formAddress.setAttribute('class', 'form-control is-valid');
                            isAddressOk = true;
                            break; 
                        } else {
                            formAddress.setAttribute('class', 'form-control is-invalid');
                        }
                    }
                } else {
                    formAddress.setAttribute('class', 'form-control is-invalid');
                }
                
                console.log(isAddressOk);

                // Verifica se ci sono risultati validi
                if (isAddressOk) {
                    // Ottenimento delle coordinate di latitudine e longitudine
                    const latitude = results[0].position.lat;
                    const longitude = results[0].position.lng;

                    // Assegna le coordinate ai campi nascosti nel form
                    document.querySelector('#latitude').value = latitude;
                    document.querySelector('#longitude').value = longitude;
            
                    console.log(latitude,longitude)

                } else {
                    console.error('Nessun risultato trovato per l\'indirizzo fornito.');
                }
            }
        );
    } 
}