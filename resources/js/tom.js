// importazione tom tom
import tt from "@tomtom-international/web-sdk-maps";

import ttServices from "@tomtom-international/web-sdk-services"
import { includes } from "lodash";

console.log('ciaone');
         

// Ottenimento del riferimento al form
const form = document.querySelector('#form-create');
console.log(form);
const formAddress = document.querySelector('#address');
// Aggiunta di un gestore di eventi al submit del form
formAddress.addEventListener('keyup', async (e) => {
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
                console.log(results)                

                results.forEach((elem) => {

                    document.getElementById('data').innerHTML += `<option value="${elem.address.freeformAddress}">${elem.address.freeformAddress}</option>`;

                    if (elem.address.freeformAddress !== formAddress.value) {
                        formAddress.setAttribute('class', 'form-control is-invalid');
                    } else {
                        formAddress.setAttribute('class', 'form-control is-valid');
                        
                    //    PROVE PER INTEGRAZIONE MAPPA E PUNTATORE MAPPA
                        
                        // document.getElementById('mappa').innerHTML = `<div id="map" class="map" style="width=250px; height=250px"></div>`

                        // let center = [elem.position.lng, elem.position.lat]
                        
                        
                        // tt.map({
                        //     key: "74CVsbN34KoIljJqOriAYN2ZMEYU1cwO",
                        //     center: center,
                        //     container: "map",
                        //     zoom: '15',
                            
                        // });
                        // // let marker = new tt.Marker().setLngLat(center).addTo('map');
                        // let marker = new tt.Marker().setLngLat([elem.position.lat, elem.position.lng]).addTo(map);
                    }
                })    
    
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
                    form.addEventListener('submit', (e) =>{
                        // e.preventDefault();
                        form.submit();
                    })
                    // form.submit();
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
