document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const recoverPasswordForm = document.getElementById("recoverPassword");
    const showRegisterButton = document.getElementById("show-register");
    const showLoginButton = document.getElementById("show-login");
    const showLoginFromRecoverButton = document.getElementById("show-login-recover");
    const showRecoverPasswordButton = document.getElementById("show-recoverPassword");
    const sendMailButton = document.getElementById("send-mail-button"); // Agregamos una referencia al botón "Send Mail"

    showRegisterButton.addEventListener("click", function () {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        recoverPasswordForm.style.display = "none"; 
    });

    showLoginButton.addEventListener("click", function () {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
        recoverPasswordForm.style.display = "none"; 
    });

    showLoginFromRecoverButton.addEventListener("click", function () {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
        recoverPasswordForm.style.display = "none"; 
    });

    showRecoverPasswordButton.addEventListener("click", function () {
        loginForm.style.display = "none";
        registerForm.style.display = "none";
        recoverPasswordForm.style.display = "block";
    });

});
