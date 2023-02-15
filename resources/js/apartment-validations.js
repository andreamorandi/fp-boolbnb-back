console.log("validazio");

const createForm = document.getElementById("create-apartment");
const title = document.getElementById("title");
const roomNumber = document.getElementById("room_number");
const bedNumber = document.getElementById("bed_number");
const bathroomNumber = document.getElementById("bathroom_number");
const surface = document.getElementById("surface_sqm");
const fullAddress = document.getElementById("full_address");
const image = document.getElementById("image");
const services = document.querySelectorAll('[id^="service-"]');
const submitBtn = document.getElementById("submit-btn");
// const form = event.target.form;

console.log(createForm);
console.log(createForm.id);

console.log(title);

submitBtn.addEventListener("click", (event) => {
    let validated = true;
    // event.preventDefault();
    console.log("servizi", services);
    console.log("servizi", services[0]);

    if (title.value.length > 4) {
        title.classList.remove("is-invalid");
    } else {
        title.classList.add("is-invalid");
        console.log("eccallà");
        validated = false;
    }

    if (roomNumber.value > 0 && Number.isInteger(Number(roomNumber.value))) {
        roomNumber.classList.remove("is-invalid");
    } else {
        roomNumber.classList.add("is-invalid");
        console.log("eccallà le stanze");
        validated = false;
    }

    if (bedNumber.value > 0 && Number.isInteger(Number(roomNumber.value))) {
        bedNumber.classList.remove("is-invalid");
    } else {
        bedNumber.classList.add("is-invalid");
        console.log("eccallà almeno un letto");
        validated = false;
    }

    if (bathroomNumber.value > 0 && Number.isInteger(Number(roomNumber.value))) {
        bathroomNumber.classList.remove("is-invalid");
    } else {
        bathroomNumber.classList.add("is-invalid");
        console.log("eccallà alemno un cesso");
        validated = false;
    }

    if (surface.value > 10 && Number.isInteger(Number(roomNumber.value))) {
        surface.classList.remove("is-invalid");
    } else {
        surface.classList.add("is-invalid");
        console.log("eccallà superficie troppo piccola");
        validated = false;
    }

    if (fullAddress.value.length > 5) {
        fullAddress.classList.remove("is-invalid");
    } else {
        fullAddress.classList.add("is-invalid");
        console.log("eccallà indirizzo troppo corto");
        validated = false;
    }

    if (image.value.length > 0) {
        image.classList.remove("is-invalid");
    } else {
        image.classList.add("is-invalid");
        console.log("manca l'immagine");
        validated = false;
    }

    let serviceValidation = false;
    for (let i = 0; i < services.length - 1; i++) {
        if (services[i].checked) {
            serviceValidation = true;
        }
    }
    if (!serviceValidation) {
        console.log("no servizi ceccahti");
        validated = false;
    } else {
        console.log("almeno un servizio c'è");
    }

    console.log(!validated)
    if (!validated) {
        event.preventDefault();
    }
});