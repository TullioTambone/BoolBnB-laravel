//import tt from "@tomtom-international/web-sdk-maps";

let longitude = document.getElementById('longitude').value;
let latitude = document.getElementById('latitude').value;

console.log(latitude, longitude);

const point =  [longitude, latitude];

console.log(point);
try {
    let map = tt.map({
        key: "74CVsbN34KoIljJqOriAYN2ZMEYU1cwO",
        container: 'map',
        //dragPan: !isMobileOrTablet(),
        center: point,
        zoom: 15
    });
    
    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
    
    map.on('load', () => {    
            new tt.Marker().setLngLat(point).addTo(map);
    })
    
} catch (error) {
    console.error('Si è verificato un errore nella richiesta al servizio di geocodifica di TomTom:', error);
}