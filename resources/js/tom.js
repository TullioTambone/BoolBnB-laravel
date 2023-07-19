// importazione tom tom
import tt from "@tomtom-international/web-sdk-maps";

import ttServices from "@tomtom-international/web-sdk-services"
import { includes } from "lodash";

console.log('ciaone');

let map;
let marker = null;
let point = null;
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
                        
                        document.getElementById('mappa').innerHTML = `<div id="map" class="map position-relative" style="width=500px; height=500px;"></div>`;
                        //document.querySelector('.mapboxgl-marker').classList.add("position-absolute");
                        point =  [elem.position.lng, elem.position.lat];
                        if (!map) {
                            // Inizializza la mappa solo se non è stata già creata
                            map = tt.map({
                                key: "74CVsbN34KoIljJqOriAYN2ZMEYU1cwO",
                                center: point, // Inverti la latitudine e longitudine per la posizione corretta
                                container: "map",
                                zoom: 15,
                            });
                        }
        
                        // Aggiorna la posizione del marker se esiste
                        if (marker) {
                            marker.setLngLat([elem.position.lng, elem.position.lat]);
                        } else {
                            // Crea il marker solo se non esiste
                            marker = new tt.Marker().setLngLat([elem.position.lng, elem.position.lat]).addTo(map);
                        }
        
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
