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
    if (n > x.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = x.length }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex - 1].style.display = "block";
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

function validaAccedi() {

    var formAccedi = document.getElementById("formAccedi");

    // Variabili associate ai campi del modulo
    var email = formAccedi.email.value;
    var password = formAccedi.password.value;
    // Espressione regolare dell'email
    var email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;

    if (!email_valid.test(email) || (email == "") || (email == "undefined")) {
        alert("Devi inserire un indirizzo email corretto");
        formAccedi.email.focus();
        return false;
    } else if ((password == "") || (password == "undefined")) {
        alert("Inserisci una password");
        formAccedi.password.focus();
        return false;
    } else {
        //formAccedi.action = "../PHP/login.php";
        formAccedi.submit();
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


    if (!nome_valid.test(nome) || (nome == "") || (nome == "undefined")) {
        alert("Devi inserire un nome");
        formRegistrati.nome.focus();
        return false;
    } else if (!cognome_valid.test(cognome) || (cognome == "") || (cognome == "undefined")) {
        alert("Devi inserire un cognome");
        formRegistrati.cognome.focus();
        return false;
    } else if (!telefono_valid.test(telefono) || (isNaN(telefono)) || (telefono == "") || (telefono == "undefined")) {
        alert("Devi inserire il numero di telefono");
        formRegistrati.telefono.value = "";
        formRegistrati.telefono.focus();
        return false;
    } else if (!email_valid.test(email) || (email == "") || (email == "undefined")) {
        alert("Devi inserire un indirizzo email corretto");
        formRegistrati.email.focus();
        return false;
    } else if (password.length < 6 || (password == "") || (password == "undefined")) {
        alert("Scegli una password, minimo 6 caratteri");
        formRegistrati.password.focus();
        return false;
    } else if ((confermapassword == "") || (confermapassword == "undefined")) {
        //Effettua il controllo sul campo CONFERMA PASSWORD
        alert("Devi confermare la password");
        formRegistrati.confermapassword.focus();
        return false;
    } else if (password != confermapassword) {
        alert("La password inserita in conferma password e' diversa dalla password");
        formRegistrati.confermapassword.value = "";
        formRegistrati.confermapassword.focus();
        return false;
    } else {
        //formRegistrati.action = "../PHP/registrati.php";
        formRegistrati.submit();
    }
}

function setSubmitForJS() {
    document.getElementById("btnSubmit").setAttribute("type", "button");
}

function controllaDisponibilita() {
    document.getElementById("sceltaGiornoVisita").setAttribute("onChange", "nascondiOrari()")
    resetOrario();
    var formSceltaOrario = document.getElementById("sceltaOrario");
    var giorno = document.getElementById("giorno").value;
    var mese = document.getElementById("mese").value;
    var anno = document.getElementById("anno").value;
    var tipoVisita = document.getElementById("tipovisita").value;

    var request = new XMLHttpRequest();

    request.open('POST', "controllaDisponibilita.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var params = 'giorno=' + giorno + '&mese=' + mese + '&anno=' + anno + '&tipovisita=' + tipoVisita;
    request.onload = function () {
        //console.log(this.response);

        var orari = JSON.parse(this.response);

        try {
            orari.forEach(orario => {
                stampaOrario(orario['ora'], orario['disponibilita']);
                console.log(orario);
            });
        } catch (e) {
            // Se entra qua è perché da errore che non esiste la funzione "array.forEach()", 
            // il che è normale perché può essere che la pagina non restituisca niente se non ci sono visite prenotate. 
            // Non riesco a fare in alro modo se non con un try chatch. Ho provato con if(orari){ ... } ma non va

            console.log(e);
        }
    }

    // Send request
    request.send(params);
    formSceltaOrario.classList.remove("nascosto");
}

function resetOrario(orario, disponibilita) {
    var orari = document.getElementsByName("orario");
    orari.forEach(orario => {
        orario.checked = false;
        if (orario.hasAttribute("disabled")) {
            orario.removeAttribute("disabled");
        }
    })

}

function stampaOrario(orario, disponibilita) {
    if (disponibilita == false) {
        document.getElementById("ore" + orario).setAttribute("disabled", "disabled");
    }
}

function nascondiOrari(orario, disponibilita) {
    var formSceltaOrario = document.getElementById("sceltaOrario");
    formSceltaOrario.removeAttribute("onChange");
    formSceltaOrario.classList.add("nascosto");

}
