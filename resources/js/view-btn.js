// Prelevo gli elementi dal DOM
const viewBtns = document.querySelectorAll('[id^="view-btn-"]');
const text = document.querySelectorAll('[id^="text-"]');
const maxLength = 150;

const longText = text.textContent;

const preview = document.getElementById('preview-window');

// console.log(viewBtns);
// console.log("text", text.length);
console.log("text", text[0]);


for (let i = 0; i < viewBtns.length; i++) {
    viewBtns[i].addEventListener("mouseover", (event) => {
        const longText = text[i].textContent;
        console.log("textcontrollo lunghezza", text[i].textContent.length);
        const shortText = limitText(longText, maxLength);
        // console.log("shorttext", longText);
        // console.log("longtext", longText); // currentMessage = i;
        text[i].textContent = shortText;
        text[i].classList.remove("d-none");
    });
    viewBtns[i].addEventListener("mouseleave", (event) => {
        // currentMessage = i;
        text[i].classList.add("d-none");
    });
}

function limitText(text, maxLength) {
    if (text.length > maxLength) {
        text = text.substr(0, maxLength);
        text = text.substr(0, Math.min(text.length, text.lastIndexOf(" ")));
        text += "...";
    }
    return text;
}