// Funzione che apre e chiude i menu da mobile
function openCloseMenu(menu) {
    var x = document.getElementById(menu);
    if (x.classList.contains("menuClose") === true) {
        x.classList.replace("menuClose", "menuOpen");
    } else {
        x.classList.replace("menuOpen", "menuClose");
    }
}

// INIZIO Codice per slider immagini index
var slideIndex = 1;

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("imgSlider");

    if (n > x.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = x.length
    }
    for (i = 0; i < x.length; i++) {
        x[i].classList.add("nascosto");
    }
    x[slideIndex - 1].classList.remove("nascosto");
}
// FINE Codice per slider immagini index

// In accedi se si preme invio nell'email il focus va alla password, se si preme invio sulla password fa il submit
function changeFocusAccedi(event, campo) {
    if (event != null && event != undefined && event.which != 13 && event.keyCode != 13) {
        // se non è stato premuto invio non faccio niente
        return true;
    } else if (campo != null && campo != undefined && campo == "email") {
        // se premo invio nel campo email allora passo al campo password
        document.getElementById("formAccedi").password.focus();
        return true;
    } else
        return validaAccedi();// se premo invio nel campo password allora fa il submit
}

// Se messaggioDopoElementoDiInput è false, vuol dire che il messaggio di errore da togliere dovrebbe essere appena prima l'elemento inpupt passato, e non dopo
function togliErrore(input, messaggioDopoElementoDiInput = true) {
    // Elimina eventuale messaggio di errore se presente appena dopo (o prima) un campo input
    var er = ((messaggioDopoElementoDiInput) ? input.nextElementSibling : input.previousElementSibling);

    if (er && er.nodeName == "STRONG" && er.className == "erroreCampiForm") {
        er.remove();
    }
}

// Se messaggioDopoElementoDiInput è false, vuol dire che il messaggio di errore deve essere visualizzato appena prima l'elemento inpupt passato, e non dopo
function mostraErrore(input, testoErrore, messaggioDopoElementoDiInput = true) {
    togliErrore(input, messaggioDopoElementoDiInput);
    // Mostra un messaggio di errore per un determinato input
    var strong = document.createElement("strong");
    strong.className = "erroreCampiForm";
    strong.appendChild(document.createTextNode(testoErrore)); // No usare innerHTML perche' puo averer comportamenti diversi e considera i tag passati come stringa, cosa che non si vuole per non permettere di eseguire script
    input.parentNode.insertBefore(strong, ((messaggioDopoElementoDiInput) ? input.nextElementSibling : input));
}

// variabile per mettere il focus sul primo errore trovato, e non sui successivi nel caso ce ne fossero più di uno
isPrimoErrore = true;
// controlla che il valore dell'input soddisfi l'espressione regolare, e nel caso mostra il messaggio di errore
function checkInputUtente(input, regExp, messaggioErrore) {
    if (regExp.test(input.value)) {
        togliErrore(input);
        return true;
    } else {
        mostraErrore(input, messaggioErrore);
        if (isPrimoErrore) {
            input.focus();
            isPrimoErrore = false;
        }
        return false;
    }
}

function checkNome(input, messaggioErrore = "") {
    var patt = new RegExp('^[A-Za-z \'-]{2,}$');
    var mess = (messaggioErrore == "") ? "Devi inserire un nome valido." : messaggioErrore;
    input.value = input.value.trim(); // Elimino eventuali spazi prima e dopo
    return checkInputUtente(input, patt, mess);
}

function checkTestoLibero(input, messaggioErrore = "") {
    var patt = new RegExp('^[A-Za-z \'-]{2,}$');
    var mess = (messaggioErrore == "") ? "Devi inserire un testo valido." : messaggioErrore;
    input.value = input.value.trim(); // Elimino eventuali spazi prima e dopo
    return checkInputUtente(input, patt, mess);
}

function checkPassword(input, messaggioErrore = "") {
    var patt = new RegExp('.{6,}$'); // qualsiasi carattere, ma almeno 6 caratteri
    var mess = (messaggioErrore == "") ? "Devi inserire una password valida, lunga almeno 6 caratteri." : messaggioErrore;
    return checkInputUtente(input, patt, mess);
}

function checkEmail(input, messaggioErrore = "") {
    var patt = new RegExp('^([a-zA-Z0-9_.-])+@([a-zA-Z0-9-]{2,}[\.]{1})+([a-zA-Z0-9]{2,})+$');
    var mess = (messaggioErrore == "") ? "Devi inserire un indirizzo email valido." : messaggioErrore;
    input.value = input.value.trim(); // Elimino eventuali spazi prima e dopo
    return checkInputUtente(input, patt, mess);
}

function checkTelefono(input, messaggioErrore = "") {
    var patt = new RegExp('^([+]{1}[0-9]{1,3})?([0-9]{5,10})$');
    var mess = (messaggioErrore == "") ? "Devi inserire un numero di telefono valido." : messaggioErrore;
    input.value = input.value.replace(/ /g, '');; // Elimino eventuali spazi
    return checkInputUtente(input, patt, mess);
}

function validaNotizia() {
    isPrimoErrore = true;
    var formNotizia = document.getElementById("formNotizia");

    var titolo = checkTestoLibero(formNotizia.titolo, "Devi inserire un titolo non vuoto.");
    var contenuto = checkTestoLibero(formNotizia.contenuto, "Devi inserire un contenuto non vuoto.");

    return titolo && contenuto;

}

function validaConsultiOnline() {
    isPrimoErrore = true;
    var formChat = document.getElementById("formConsultiOnline");

    return checkTestoLibero(formChat.nuovomessaggio, "Devi inserire un messaggio non vuoto.");
}

function validaAccedi() {
    isPrimoErrore = true;
    var formAccedi = document.getElementById("formAccedi");

    // Variabili booleane associate ai campi del modulo, indicanti se il relativo campo ha un valore accettabile
    var email = checkEmail(formAccedi.email);
    var password;

    // Controllo semplicemente che il campo password non sia vuoto
    if ((formAccedi.password.value == "") || (formAccedi.password.value == "undefined")) {
        console.log("ASA");

        if (isPrimoErrore) {
            formAccedi.password.focus();
            isPrimoErrore = false;
        }
        mostraErrore(formAccedi.password, 'Inserire una password.');
        password = false;
    } else {
        togliErrore(formAccedi.password);
        password = true;
    }

    return email && password;
}

function validaRegistrati() {
    isPrimoErrore = true;
    var formRegistrati = document.getElementById("formRegistrati");

    // Variabili booleane associate ai campi del modulo, indicanti se il relativo campo ha un valore accettabile
    var nome = checkNome(formRegistrati.nome);
    var cognome = checkNome(formRegistrati.cognome, 'Devi inserire un cognome valido.');
    var telefono = checkTelefono(formRegistrati.telefono);
    var email = checkEmail(formRegistrati.email);
    var password = checkPassword(formRegistrati.password);
    var confermapassword;

    // Controllo che le due password combacino
    if (formRegistrati.password.value != formRegistrati.confermapassword.value) {
        if (isPrimoErrore) {
            formRegistrati.confermapassword.focus();
            isPrimoErrore = false;
        }
        mostraErrore(formRegistrati.confermapassword, 'La password inserita in conferma password è diversa dalla password.');
        confermapassword = false;
    } else {
        togliErrore(formRegistrati.confermapassword);
        confermapassword = true;
    }

    return nome && cognome && telefono && email && password && confermapassword;
}

function setPrenotaVisitaForJS() {
    // viene eseguita solo se c'è javascript

    // questa funzione fa si che a chi ha js attivo venga visualizzata la pagina come dovrebbe essere (con tutti i controlli e le chiamate alla pagina php per controllare la disponibilità),
    // mentre chi non ha js attivo non viene eseguita questa funzoine e quindi gli viene lasciata la pagina così com'è impostata in html e quindi comunque utilizzabile.
    document.getElementById("btnControllaDisponibilita").classList.remove("nascosto"); // Mostro il pulsante per controllare la disponibilità
    document.getElementById("sceltaOrario").classList.add("nascosto"); // Nascondo la parte del form per scegliere l'orario (Verrà visualizzata una volta premuto il tasto "Mostra orari disponibili")
}

function resetOrario() {
    // tolgo l'attributo disabled a tutti gli orari che dovessero avercelo, così da non aver nessun orario selezionato ed tutti gli orari momentaneamente disponibili
    var orari = document.getElementsByName("orario");
    orari.forEach(orario => {
        orario.checked = false; // deseleziono l'orario se fosse selezionato
        if (orario.hasAttribute("disabled")) {
            orario.removeAttribute("disabled"); // rendo l'orario disponibile, poi nel caso larà la funzione impostaorario() o renderlo di nuovo non disponibile
        }
    })

}

function impostaOrario(orario, disponibilita) {
    // imposto l'orario come non disponibile se disponibilita==false
    if (disponibilita == false) {
        document.getElementById("ore" + orario).setAttribute("disabled", "disabled");
    }
}

function nascondiOrari() {
    // nascondo tutti gli orari
    var sectionForm_SceltaOrario = document.getElementById("sceltaOrario");
    sectionForm_SceltaOrario.classList.add("nascosto");

    // elimino eventuali errori presenti
    togliErrore(document.getElementById("formPrenotaVisita"), false);

}

// Input nel formato dd/mm/yyyy
function dataValida(s) {
    // creo un array con giorno, mese e anno
    var bits = s.split('/');
    // creo una data con i valori dentro l'array
    var d = new Date(bits[2], bits[1] - 1, bits[0]);

    // controllo che la data non sia false, e soprattutto che il mese ricevuto come parametro sia uguale a quello della data creata. 
    // se per esempio la data passata è 31/09/2020 la data che in realtà verrà creata sarà 01/10/2020, quindi inserendo una data che non esiste i mesi non combacieranno e quindi restituirà false
    return d && (d.getMonth() + 1) == bits[1];
}

// Ritorna true se la data è valida e futura, altrimenti false
function checkData(giorno, mese, anno) {
    // controllo se la data scelta e' corretta o no 
    var formPrenotaVisita = document.getElementById("formPrenotaVisita");
    var check = dataValida(giorno + '/' + mese + '/' + anno);

    // se check =false -> data non corretta 
    if (!check) {
        mostraErrore(formPrenotaVisita, 'La data scelta non è una data valida.', false);
        return false;
    } else {
        togliErrore(formPrenotaVisita, false)
    }

    var dataCorrente = new Date();
    var dataScelta = new Date(anno + '/' + mese + '/' + giorno);

    // controllo se la data e' gia passato o no 
    if (dataScelta <= dataCorrente) {
        mostraErrore(formPrenotaVisita, 'La data scelta non può essere passata.', false);
        return false;
    } else {
        togliErrore(formPrenotaVisita, false)
    }
    return true;
}

primaControlloDisponibilita = true;
function controllaDisponibilita() {
    // dopo la prima volta che controllo la disponibilità degli orari imposto che se si va a modificare la data allora mi torna nascondere gli orari disponibili, 
    // così da non rendere possibile che gli orari disponibili a schermo non si riferiscano alla data impostata
    if (primaControlloDisponibilita) {
        var idData = ['giorno', 'mese', 'anno'];
        idData.forEach(id => {
            // Non chiamo la funzione controllaDisponibilita() per non dare l'illusione che il sito non funzionasse se gli orari disponibili non cambianno tra le due date inserite, quindi ho preferito nascondere gli orari
            document.getElementById('' + id).setAttribute("onChange", "nascondiOrari()");
        });
        primaControlloDisponibilita = false;
    }

    // Metto tutti gli orari come disponibili prima di fare la richiesta di quelli non disponibili
    resetOrario();

    var sectionForm_SceltaOrario = document.getElementById("sceltaOrario");

    var giorno = document.getElementById("giorno").value;
    var mese = document.getElementById("mese").value;
    var anno = document.getElementById("anno").value;
    var tipoVisita = document.getElementById("tipovisita").value;

    // Se la data inserita non è valida allora non controllo la disponibilità
    if (!checkData(giorno, mese, anno)) {
        // Gli errori si occupa checkData a mostrarli
        return false;
    }

    // Preparo la richiesta al server PHP
    var request = new XMLHttpRequest();

    request.open('POST', "controllaDisponibilita.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var params = 'giorno=' + giorno + '&mese=' + mese + '&anno=' + anno + '&tipovisita=' + tipoVisita;
    // funzione che viene chiamata una volta inviata la richiesta
    request.onload = function () {
        // console.log(this.response);

        var orari = JSON.parse(this.response);
        try {
            orari.forEach(orario => {
                impostaOrario(orario['ora'], orario['disponibilita']);
                console.log(orario);
            });
        } catch (e) {
            // Se entra qua è perché da errore che non esiste la funzione "array.forEach()", 
            // il che è normale perché può essere che la pagina non restituisca niente se non ci sono visite prenotate. 
            // Non riesco a fare in alro modo se non con un try chatch. Ho provato con if(orari){ ... } ma non va

            // console.log(e);
        }
    }

    // Invio la richiesta alla pagina php
    request.send(params);

    // rendo visibile il secondo pezzo del form
    sectionForm_SceltaOrario.classList.remove("nascosto");
}

function controlloOrario() { // funzione di validazione del form PrenotaVisita
    var formPrenotaVisita = document.getElementById("formPrenotaVisita");
    var orario = document.getElementsByName('orario');
    var selezionato = 0;

    orario.forEach(x => {
        if (x.checked) {
            ++selezionato;
        }
    });

    if (selezionato == 0) {
        mostraErrore(formPrenotaVisita, 'Scegli un orario tra quelli disponibili.', false);
        return false;
    }

    // non controllo la data in questa funzione (cioè quando viene fatto il submit) perché se javascript è attivo è già stata controllata una volta premuto il tasto "Mostra orari disponibili" con la funzione controlloDisponibilità(), mentre se javascript è disattivato ovviamente non verrà mai chiamata questa funzione
    return true;
}