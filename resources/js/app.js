import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// Delete buttons modal Bootstrap
const deleteButtons = document.querySelectorAll(".ms_delete-btn");

deleteButtons.forEach((btn) => {
    btn.addEventListener("click", (event) => {
        event.preventDefault();
        const modalText = btn.getAttribute("delete-text");
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        document.getElementById("modal-text").innerText = modalText;
        document.getElementById("confirmDelete").addEventListener('click', () => {
            btn.parentElement.submit();
        });
        modal.show();
    });
});
