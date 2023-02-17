// Prelevo gli elementi dal DOM
const viewBtns = document.querySelectorAll('[id^="view-btn-"]');
const text = document.querySelectorAll('[id^="text-"]');
const Stext = document.getElementById('text-6')
const maxLength = 150;

const preview = document.getElementById('preview-window');

console.log("text", Stext);
console.log("text", text[6]);


for (let i = 0; i < viewBtns.length; i++) {
    viewBtns[i].addEventListener("mouseover", (event) => {
        const longText = text[i].textContent;
        console.log("textcontrollo lunghezza", text[i].textContent.length, text[i].textContent);
        const shortText = limitText(longText, maxLength);
        text[i].textContent = shortText;
        text[i].classList.remove("d-none");
    });
    viewBtns[i].addEventListener("mouseleave", (event) => {
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