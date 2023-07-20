let password = document.getElementById('password');

console.log(password, password.value);

const form = document.querySelector('form');

let passwordConfirm = document.getElementById('password-confirm');


let bool = false;
console.log(form);

passwordConfirm.addEventListener('keyup', function () {

    if(passwordConfirm.value !== password.value) {
        passwordConfirm.classList.add('is-invalid');
        bool = false;
    } else {
        passwordConfirm.classList.remove('is-invalid');  
        passwordConfirm.classList.add('is-valid');  
        bool = true;
    }
})
console.log(bool);

form.addEventListener('submit', function (e) {
    if(bool) {
        
        form.submit();
    } else {
        e.preventDefault();
        
        console.log('error');
    }
});