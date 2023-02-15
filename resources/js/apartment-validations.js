const title = document.getElementById("title");
const roomNumber = document.getElementById("room_number");
const bedNumber = document.getElementById("bed_number");
const bathroomNumber = document.getElementById("bathroom_number");
const surface = document.getElementById("surface_sqm");
const fullAddress = document.getElementById("full_address");
const addressBox = document.getElementById("address-box");
const image = document.getElementById("image");
const services = document.querySelectorAll('[id^="service-"]');
const submitBtn = document.getElementById("submit-btn");

submitBtn.addEventListener("click", (event) => {
    let validated = true;

    if (title.value.length > 4) {
        title.classList.remove("ms_is-invalid");
    } else {
        title.classList.add("ms_is-invalid");
        validated = false;
    }

    if (roomNumber.value > 0 && Number.isInteger(Number(roomNumber.value))) {
        roomNumber.classList.remove("ms_is-invalid");
    } else {
        roomNumber.classList.add("ms_is-invalid");
        validated = false;
    }

    if (bedNumber.value > 0 && Number.isInteger(Number(roomNumber.value))) {
        bedNumber.classList.remove("ms_is-invalid");
    } else {
        bedNumber.classList.add("ms_is-invalid");
        validated = false;
    }

    if (bathroomNumber.value > 0 && Number.isInteger(Number(roomNumber.value))) {
        bathroomNumber.classList.remove("ms_is-invalid");
    } else {
        bathroomNumber.classList.add("ms_is-invalid");
        validated = false;
    }

    if (surface.value > 10 && Number.isInteger(Number(roomNumber.value))) {
        surface.classList.remove("ms_is-invalid");
    } else {
        surface.classList.add("ms_is-invalid");
        validated = false;
    }

    if (fullAddress.value.length > 5) {
        addressBox.classList.remove("ms_is-invalid");
    } else {
        addressBox.classList.add("ms_is-invalid");
        validated = false;
    }

    if (image.value.length > 0) {
        image.classList.remove("ms_is-invalid");
    } else {
        image.classList.add("ms_is-invalid");
        validated = false;
    }

    let serviceValidation = false;
    for (let i = 0; i < services.length - 1; i++) {
        if (services[i].checked) {
            serviceValidation = true;
        }
    }
    if (!serviceValidation) {
        validated = false;
    }

    if (!validated) {
        event.preventDefault();
    }
});