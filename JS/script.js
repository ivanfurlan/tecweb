function openCloseMenu(menu) {
    var x = document.getElementById(menu);
    if (x.classList.contains("menuClose") === true) {
        x.classList.replace("menuClose", "menuOpen");
    } else {
        x.classList.replace("menuOpen", "menuClose");
    }
}

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

function changeFocusAccedi(event, campo) {
    if (event != null && event != undefined && event.which != 13 && event.keyCode != 13) {
        //se non è stato premuto invio non faccio niente
        return true;
    } else if (campo != null && campo != undefined && campo == "email") {
        //se premo invio nel campo email allora passo al campo password
        document.getElementById("formAccedi").password.focus();
        return true;
    } else
        return validaAccedi();//se premo invio nel campo password allora fa il submit
}

function mostraErroriPrimaDiElemento(listaErrori, elementoHTML) {
    var divErrori = document.getElementById("listaErroriForm");

    //se non ci sono errori elimino il div, e se già non esistesse non faccio niente
    if (!listaErrori) {
        if (divErrori) {
            divErrori.remove();
        }
        return;
    }

    //inserisce un div con la lista degli errori passata come paramentro appena prima all'elemento passato come parametro
    listaErrori = '<ul>' + listaErrori + '</ul>';

    //controllo se la lista esiste già. Se sì la aggiorno con la lista passata
    if (divErrori) {
        divErrori.innerHTML = listaErrori;
    } else {
        //non esiste la lista, quindi la creo dentro un div
        tempDivErrori = document.createElement("div");
        tempDivErrori.classList.add("erroreCampiForm");
        tempDivErrori.id = "listaErroriForm";

        tempDivErrori.innerHTML = listaErrori;
        elementoHTML.parentNode.insertBefore(tempDivErrori, elementoHTML);
    }
}

function validaConsultiOnline(){
    var formChat = document.getElementById("formConsultiOnline");
    var nuovomessaggio = formChat.nuovomessaggio.value.trim();
    formChat.nuovomessaggio.value=nuovomessaggio; //elimino eventuali spazi prima e dopo
    var erroriHTML = '';

    if ((nuovomessaggio == "") || (nuovomessaggio == "undefined")) {
        if (erroriHTML == "") {
            formChat.nuovomessaggio.focus();
        }
        erroriHTML += '<li>Devi inserire un messaggio non vuoto.</li>';
    }

    if (erroriHTML == "") {
        formChat.submit();
        return true;
    } else {
        mostraErroriPrimaDiElemento(erroriHTML, formChat);
        return false;
    }
}

function validaAccedi() {

    var formAccedi = document.getElementById("formAccedi");

    // Variabili associate ai campi del modulo
    var email = formAccedi.email.value;
    var password = formAccedi.password.value;
    // Espressione regolare dell'email
    var email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;

    var erroriHTML = "";

    if (!email_valid.test(email) || (email == "") || (email == "undefined")) {
        if (erroriHTML == "") {
            formAccedi.email.focus();
        }
        erroriHTML += '<li>Devi inserire un indirizzo email valido.</li>';
    }
    if ((password == "") || (password == "undefined")) {
        if (erroriHTML == "") {
            formAccedi.password.focus();
        }
        erroriHTML += '<li>Devi inserire una password.</li>';
    }

    if (erroriHTML == "") {
        formAccedi.submit();
        return true;
    } else {
        mostraErroriPrimaDiElemento(erroriHTML, formAccedi);
        return false;
    }
}

function validaRegistrati() {

    var formRegistrati = document.getElementById("formRegistrati");

    // Variabili associate ai campi del modulo
    var email = formRegistrati.email.value;
    var password = formRegistrati.password.value;
    var nome = formRegistrati.nome.value;
    var cognome = formRegistrati.cognome.value;
    var telefono = formRegistrati.telefono.value;
    var confermapassword = formRegistrati.confermapassword.value;
    // Espressioni regolari valide
    var nome_valid = /^[A-Za-z \'-]+$/i;
    var cognome_valid = /^[A-Za-z \'-]+$/i;
    var email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
    var telefono_valid = /^[0-9]{5,10}$/;

    var erroriHTML = "";

    if (!nome_valid.test(nome) || (nome == "") || (nome == "undefined")) {
        if (erroriHTML == "") {
            formRegistrati.nome.focus();
        }
        erroriHTML += '<li>Devi inserire un nome valido.</li>';
    }
    if (!cognome_valid.test(cognome) || (cognome == "") || (cognome == "undefined")) {
        if (erroriHTML == "") {
            formRegistrati.cognome.focus();
        }
        erroriHTML += '<li>Devi inserire un cognome valido.</li>';
    }
    if (!telefono_valid.test(telefono) || (isNaN(telefono)) || (telefono == "") || (telefono == "undefined")) {
        if (erroriHTML == "") {
            formRegistrati.telefono.focus();
        }
        erroriHTML += '<li>Devi inserire un numero di telefono valido.</li>';
    }
    if (!email_valid.test(email) || (email == "") || (email == "undefined")) {
        if (erroriHTML == "") {
            formRegistrati.email.focus();
        }
        erroriHTML += '<li>Devi inserire un indirizzo email valido.</li>';
    }
    if (password.length < 6 || (password == "") || (password == "undefined")) {
        if (erroriHTML == "") {
            formRegistrati.password.focus();
        }
        erroriHTML += '<li>Devi inserire una password lunga almeno 6 caratteri.</li>';
    }
    if ((confermapassword == "") || (confermapassword == "undefined")) {
        if (erroriHTML == "") {
            formRegistrati.confermapassword.focus();
        }
        //Effettua il controllo sul campo CONFERMA PASSWORD
        erroriHTML += '<li>Devi confermare la password riscrivendola uguale</li>';
    } else if (password != confermapassword) {
        if (erroriHTML == "") {
            formRegistrati.confermapassword.focus();
        }
        erroriHTML += '<li>La password inserita in conferma password è diversa dalla password</li>';
    }

    if (erroriHTML == "") {
        formRegistrati.submit();
        return true;
    } else {
        mostraErroriPrimaDiElemento(erroriHTML, formRegistrati);
        return false;
    }
}

function setSubmitForJS() {
    //viene eseguita solo se c'è javascript

    //questa funzione fa si che a chi ha js attivo vengano fatti i controlli sui campi prima di inviare la forma,
    //mentre chi non ha js attivo non viene eseguita questa funzoine e quindi gli viene lasciata la pagina così com'è, ma comunque utilizzabile
    var tmp = document.getElementById("btnSubmit");
    if (tmp)
        tmp.setAttribute("type", "button");
}

function setPrenotaVisitaForJS() {
    //viene eseguita solo se c'è javascript

    //questa funzione fa si che a chi ha js attivo venga visualizzata la pagina come dovrebbe essere (con tutti i controlli e le chiamate alla pagina php per controllare la disponibilità),
    //mentre chi non ha js attivo non viene eseguita questa funzoine e quindi gli viene lasciata la pagina così com'è impostata in html e quindi comunque utilizzabile.
    document.getElementById("btnControllaDisponibilita").classList.remove("nascosto");
    document.getElementById("sceltaOrario").classList.add("nascosto");
    document.getElementById("btnSubmit").setAttribute("type", "button");
}

// Expect input as d/m/y
function isValidDate(s) {
    //creo un aggari con giorno, mese e anno
    var bits = s.split('/');
    //creo una data con i valori dentro l'array
    var d = new Date(bits[2], bits[1] - 1, bits[0]);

    //controllo che la data non sia false, e soprattutto che il mese ricevuto come parametro sia uguale a quello della data creata. 
    //se per esempio la data passata è 31/09/2020 la data che in realtà verrà creata sarà 01/10/2020, quindi inserendo una data che non esiste i mesi non combacieranno e quindi restituirà false
    return d && (d.getMonth() + 1) == bits[1];
}


primaControlloDisponibilita = true;
function controllaDisponibilita() {
    //dopo la prima volta che controllo la disponibilità degli orari imposto che se si va a modificare la data allora mi torna nascondere gli orari disponibili, 
    //così da non rendere possibile che gli orari disponibili a schermo non si riferiscano alla data impostata
    if (primaControlloDisponibilita) {
        var idData = ['giorno', 'mese', 'anno'];
        idData.forEach(id => {
            //non chiamo la funzione controllaDisponibilita() per non dare l'illusione che il sito non funzionasse se gli orari disponibili non cambianno tra le due date inserite, quindi ho preferito nascondere gli orari
            document.getElementById('' + id).setAttribute("onChange", "nascondiOrari()");
        });
        primaControlloDisponibilita = false;
    }

    //metto tutti gli orari come disponibili prima di fare la richiesta di quelli non disponibili
    resetOrario();

    var formSceltaOrario = document.getElementById("sceltaOrario");
    var giorno = document.getElementById("giorno").value;
    var mese = document.getElementById("mese").value;
    var anno = document.getElementById("anno").value;
    var tipoVisita = document.getElementById("tipovisita").value;

    // controllo se la data scelta e' corretta o no 
    var check = isValidDate(giorno + '/' + mese + '/' + anno);
    var erroriHTML = "";

    // se check =false -> data non corretta 
    if (!check) {
        erroriHTML += '<li>La data scelta non è una data valida.</li>';
        mostraErroriPrimaDiElemento(erroriHTML, document.getElementById("formPrenotaVisita"));
        return false;
    }

    var dataCorrente = new Date();
    var dataScelta = new Date(anno + '/' + mese + '/' + giorno);

    // controllo se la data e' gia passato o no 
    if (dataScelta <= dataCorrente) {
        erroriHTML += '<li>La data scelta non può essere passata.</li>';
        mostraErroriPrimaDiElemento(erroriHTML, document.getElementById("formPrenotaVisita"));
        return false;
    }

    //elimino eventuali errori presenti
    mostraErroriPrimaDiElemento("", document.getElementById("formPrenotaVisita"));

    //preparo la richiesta
    var request = new XMLHttpRequest();

    request.open('POST', "controllaDisponibilita.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var params = 'giorno=' + giorno + '&mese=' + mese + '&anno=' + anno + '&tipovisita=' + tipoVisita;
    //funzione che viene chiamata una volta inviata la richiesta
    request.onload = function () {
        //console.log(this.response);

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

            //console.log(e);
        }
    }

    // Invio la richiesta alla pagina php
    request.send(params);

    //rendo visibile il secondo pezzo del form
    formSceltaOrario.classList.remove("nascosto");
}

function resetOrario(orario, disponibilita) {
    //tolgo l'attributo disabled a tutti gli orari che dovessero avercelo
    var orari = document.getElementsByName("orario");
    orari.forEach(orario => {
        orario.checked = false;
        if (orario.hasAttribute("disabled")) {
            orario.removeAttribute("disabled");
        }
    })

}

function impostaOrario(orario, disponibilita) {
    //imposto l'orario come non disponibile se disponibilita==false
    if (disponibilita == false) {
        document.getElementById("ore" + orario).setAttribute("disabled", "disabled");
    }
}

function nascondiOrari(orario, disponibilita) {
    //nascondo tutti gli orari
    var formSceltaOrario = document.getElementById("sceltaOrario");
    formSceltaOrario.classList.add("nascosto");

}
function controlloOrario() {
    var formPrenotaVisita = document.getElementById("formPrenotaVisita");
    var orario = document.getElementsByName('orario');
    var selezionato = 0;

    var erroriHTML = '';

    orario.forEach(x => {
        if (x.checked) {
            ++selezionato;
        }
    });

    if (selezionato == 0) {
        erroriHTML += '<li>Scegli un orario tra quelli disponibili.</li>';
        mostraErroriPrimaDiElemento(erroriHTML, formPrenotaVisita);
        return false;
    }
    formPrenotaVisita.submit();

}