// Selezione di tutti gli input type number del form create
const inputNumber = document.querySelectorAll('input[type=number]');

// per ogni input creo una funzione con evento input
inputNumber.forEach(elem => {

    if (elem.getAttribute('name') !== 'price') {
        
        elem.addEventListener('input', function() {           
            
            if(elem.value < 0) {    
                elem.setAttribute('class', 'form-control is-invalid');
            }else if(elem.value === ''){
                elem.setAttribute('class', 'form-control');
            } else {
                elem.setAttribute('class', 'form-control is-valid');
            }
        } )

    } else if (elem.getAttribute('name') === 'price') {

        elem.addEventListener('input', function() {

            if(elem.value < 0) {
                elem.setAttribute('class', 'form-control is-invalid');
            } else {
                elem.setAttribute('class', 'form-control');
            }
        } )
    }
});

// Selezione di tutti gli input type number del form create
const input = document.querySelectorAll('input:not([type=number])');

// per ogni input creo una funzione con evento input
input.forEach(elem => {

    if (elem.getAttribute('type') === 'text') {

        elem.addEventListener('input', function() {

            if(elem.value === '' ) {
                elem.setAttribute('class', 'form-control is-invalid');
            } else {
                elem.setAttribute('class', 'form-control is-valid');
            }

        } )
    } else if (elem.getAttribute('type') === 'checkbox') {

        elem.addEventListener('change', function() {

            if(!elem.checked ) {
                elem.setAttribute('class', 'form-check-input ps-0 ms-0 is-invalid');
            } else {
                elem.setAttribute('class', 'form-check-input ps-0 ms-0 is-valid');
            }

        } )
    } else if (elem.getAttribute('type') === 'radio') {

        elem.addEventListener('change', function() {

            if(!elem.checked ) {
                elem.setAttribute('class', 'form-check-input is-invalid');
            } else {
                elem.setAttribute('class', 'form-check-input is-valid');
            }

        } )
    } else if (elem.getAttribute('name') === 'cover') {

        elem.addEventListener('change', function() {

            if(elem.files.length <= 0 ) {
                elem.setAttribute('class', 'form-control is-invalid');
            } else {
                elem.setAttribute('class', 'form-control is-valid');
            }

        } )
    }
});

