document.addEventListener('DOMContentLoaded', function () {
    const showMoreButton = document.getElementById('showMoreButton');
    const hiddenInstruments = document.getElementById('hiddenInstruments');

    // Maneja el clic en el botón "Ver más"
    showMoreButton.addEventListener('click', function () {
        hiddenInstruments.style.display = 'block';
        showMoreButton.style.display = 'none'; // Oculta el botón después de hacer clic
    });
});