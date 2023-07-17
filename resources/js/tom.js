// importazione tom tom
import tt from "@tomtom-international/web-sdk-maps";

import ttServices from "@tomtom-international/web-sdk-services"

console.log('ciaone');

// tt.map({
//     key: "74CVsbN34KoIljJqOriAYN2ZMEYU1cwO",
//     center: [0, 0],
//     container: "map",
//     zoom: '2'
// });

// Ottenimento del riferimento al form
const form = document.querySelector('#form-create');
console.log(form);

// Aggiunta di un gestore di eventi al submit del form
form.addEventListener('submit', async (e) => {
    e.preventDefault(); // Previeni il comportamento di default del submit

    // Ottenimento dell'indirizzo dal campo input
    const address = document.querySelector('#address').value;

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
                console.log(results )
    
    
                // Verifica se ci sono risultati validi
                if (results && results.length > 0) {
                    // Ottenimento delle coordinate di latitudine e longitudine
                    const latitude = results[0].position.lat;
                    const longitude = results[0].position.lng;
            
                    // Assegna le coordinate ai campi nascosti nel form
                    document.querySelector('#latitude').value = latitude;
                    document.querySelector('#longitude').value = longitude;
            
                    console.log(latitude,longitude)
            
                    // Invia il form
                    form.submit();
                } else {
                    console.error('Nessun risultato trovato per l\'indirizzo fornito.');
                }
            }
        );
    } else {
        // Invia il form comunque ma senza indirizzo
        form.submit();
    }

});