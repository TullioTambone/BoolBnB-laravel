let password = document.getElementById('password');

console.log(password, password.value);

let passwordConfirm = document.getElementById('password-confirm');

console.log(passwordConfirm, passwordConfirm.value);

passwordConfirm.addEventListener('keyup', function () {

    if(passwordConfirm.value !== password.value) {

        passwordConfirm.classList.add('is-invalid');
    } else {
        passwordConfirm.classList.remove('is-invalid');  
        passwordConfirm.classList.add('is-valid');  
    }
})