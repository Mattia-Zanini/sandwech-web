$(window).on('load', function () {
    var cookies = CookiesToObject(document.cookie);

    document.cookie = CreateCookie("userLoginData", {
        "userName": "Pietro",
        "password": "123456",
    }, addDaysToDate(1));
    console.log(cookies);

    if (cookies.hasOwnProperty('userLoginData') == false) {
        window.location.replace("http://localhost/sandwech-web/login");
    }
});

// Questa funzione accetta una stringa di cookie come input
function CookiesToObject(cookies) {
    // Dichiariamo una variabile "str" che è uguale all'input "cookies"
    var str = cookies;
    // Dividiamo la stringa di cookie sui caratteri "; " in un array
    str = str.split('; ');
    // Dichiariamo un oggetto vuoto chiamato "result" che useremo per immagazzinare i singoli cookie
    const result = {};
    // Iniziamo un ciclo for-in per iterare attraverso ciascun elemento dell'array "str"
    for (let i in str) {
        // Dividiamo l'elemento corrente sui caratteri "=" in un array
        const cur = str[i].split('=');
        // Assegniamo il valore del primo elemento dell'array come chiave dell'oggetto "result" e il valore del secondo elemento come valore
        try {
            result[cur[0]] = JSON.parse(cur[1]);
        } catch (error) {
            result[cur[0]] = cur[1];
        }
    }
    // Restituiamo l'oggetto "result" che contiene i singoli cookie come coppie chiave-valore
    return result;
}

// Questa funzione crea un cookie in javascript.
// Prende tre parametri:
// 1. Il nome del cookie (cookieName)
// 2. I dati da memorizzare nel cookie (data)
// 3. La data di scadenza del cookie (expires)
function CreateCookie(cookieName, data, expires) {
    /*
    Creiamo una variabile (strCookie) che conterrà il valore del cookie
    Concateniamo il nome del cookie con i dati (convertiti in formato JSON)
    Impostiamo il percorso del cookie su "/",
    Impostiamo la stessa origine per il cookie su "None",
    Impostiamo che il cookie sia sicuro
    E infine impostiamo la data di scadenza del cookie
    */

    var strCookie = cookieName + "=" + JSON.stringify(data) + "; path=/; SameSite=None; Secure; expires=" + expires;
    // Restituiamo il valore del cookie
    return strCookie;
}

function addDaysToDate(daysToAdd) {
    // Crea una variabile "currentDate" che contiene la data corrente
    let currentDate = new Date();
    // Utilizza il metodo "setDate" per aggiungere "daysToAdd" giorni alla data corrente
    currentDate.setDate(currentDate.getDate() + daysToAdd);
    // Crea una variabile "options" che contiene le opzioni per il formato della data
    let options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false, timeZone: 'UTC' };
    // Utilizza il metodo "toLocaleString" per formattare la data in base alle opzioni definite
    let formattedDate = currentDate.toLocaleString('en-US', options);
    // Stampa la data formattata
    return formattedDate + " UTC";
}