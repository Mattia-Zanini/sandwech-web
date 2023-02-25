$(document).ready(function () {
    document.cookie = "name=oeschger; SameSite=None; Secure; expires=Thu, 18 Dec 2025 12:00:00 UTC";
    document.cookie = "favorite_food=tripe; SameSite=None; Secure; expires=Thu, 18 Dec 2025 12:00:00 UTC";
});

$(window).on('load', function () {
    console.log(document.cookie);
});

function showCookies() {
    const output = document.getElementById('cookies');
    output.textContent = `> ${document.cookie}`;
}

// (ESEMPIO) Questa funzione si occupa di eliminare i cookie presenti nella pagina
function clearOutputCookies() {
    // Crea una costante chiamata "output" che seleziona l'elemento HTML con id "cookies"
    const output = document.getElementById('cookies');
    // Svuota il contenuto dell'elemento selezionato in precedenza
    output.textContent = '';
    // Crea un cookie chiamato "name" con una data di scadenza antecedente alla data attuale
    document.cookie = "name=; expires=Thu, 18 Dec 1970 12:00:00 UTC";
    // Crea un cookie chiamato "favorite_food" con una data di scadenza antecedente alla data attuale
    document.cookie = "favorite_food=; expires=Thu, 18 Dec 1970 12:00:00 UTC";
}