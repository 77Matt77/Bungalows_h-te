// modal.js

function showModal(bungalowName) {
    var modalId = 'staticBackdrop1'; // ID de la première modal
    var myModal = new bootstrap.Modal(document.getElementById(modalId));
    
    // Mettre à jour le titre de la modal avec le nom du bungalow
    var modalTitleElement = document.querySelector('#' + modalId + ' .modal-title');
    modalTitleElement.innerText = bungalowName;

    myModal.show();
}
