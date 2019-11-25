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
        formAccedi.action = "accedi.php";
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
    // Espressione regolare dell'email
    var email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
    var telefono_valid = /^[0-9]{5,10}$/;

    if ((nome == "") || (nome == "undefined")) {
        alert("Devi inserire un nome");
        formRegistrati.nome.focus();
        return false;
    } else if ((cognome == "") || (cognome == "undefined")) {
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
        formRegistrati.action = "registrati.php";
        formRegistrati.submit();
    }
}

function setSubmitForJS() {
    document.getElementById("btnSubmit").setAttribute("type", "button");
}
