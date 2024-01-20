import './bootstrap';

let togglePassword = document.getElementById("togglePassword");
let password = document.getElementById("password");
let togglePassword1 = document.getElementById("togglePassword1");
let password1 = document.getElementById("password1");


togglePassword.onclick = function () {
    if (password.type == "password") {
        password.type = "text";
        togglePassword.classList.remove("bi-eye-slash");
        togglePassword.classList.add("bi-eye");
    } else {
        password.type = "password";
        togglePassword.classList.remove("bi-eye");
        togglePassword.classList.add("bi-eye-slash");
    }
}

togglePassword1.onclick = function () {
    if (password1.type == "password") {
        password1.type = "text";
        togglePassword1.classList.remove("bi-eye-slash");
        togglePassword1.classList.add("bi-eye");
    } else {
        password1.type = "password";
        togglePassword1.classList.remove("bi-eye");
        togglePassword1.classList.add("bi-eye-slash");
    }
}