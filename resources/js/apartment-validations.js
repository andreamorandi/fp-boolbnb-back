console.log("validazio");

const createForm = document.getElementById("create-apartment");
const title = document.getElementById("title");
const submitBtn = document.getElementById("submit-btn");
// const form = event.target.form;

console.log(createForm);
console.log(createForm.id);

console.log(title);

submitBtn.addEventListener("click", (event) => {
    event.preventDefault();
    if (title.value.length < 4) {
        console.log("eccallà");
    }
})