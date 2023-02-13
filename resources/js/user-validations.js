
const registerBtn = document.getElementById("register-submit-btn");
const inputMail = document.getElementById("email");
const inputPassword = document.getElementById("password");
const inputPasswordConfirm = document.getElementById("password-confirm");

let mailIsOk = false;
let passwordIsOk = false;

registerBtn.addEventListener('click', (event) => {
    console.log("clicca dai su", inputMail, inputPassword, inputPasswordConfirm);
    console.log(inputMail.value.search("@"));

    if (inputMail.value.match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    )) {
        inputMail.classList.remove("is-invalid");
        mailIsOk = true;
    } else {
        inputMail.classList.add("is-invalid");
        mailIsOk = false;
    };

    if (inputPasswordConfirm.value === inputPassword.value) {
        inputPasswordConfirm.classList.remove("is-invalid");
        inputPassword.classList.remove("is-invalid");
        passwordIsOk = true;

        console.log(inputPasswordConfirm, inputPassword)
    } else {
        inputPasswordConfirm.classList.add("is-invalid");
        inputPassword.classList.add("is-invalid");
        passwordIsOk = false;
    }

    if (mailIsOk === true && passwordIsOk === true) {
        registerBtn.classList.add("btn-primary");
        registerBtn.classList.remove("btn-secondary");
        console.log(mailIsOk);
    } else {
        event.preventDefault();
        registerBtn.classList.add("btn-secondary");
        registerBtn.classList.remove("btn-primary");
        console.log(passwordIsOk)
    }
})