function openCloseMenu(menu) {
    var x = document.getElementById(menu);
    if (x.classList.contains("menuClose") === true) {
        x.classList.replace("menuClose","menuOpen");
    } else {
        x.classList.replace("menuOpen","menuClose");
    }
}



var slideIndex = 1;

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("imgSlider");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}



function validaAccedi() {
// Variabili associate ai campi del modulo
var email = document.myForm.email.value;
var password = document.myForm.password.value;
var email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;

// Espressione regolare dell'email
if (!email_valid.test(email) || (email == "") || (email == "undefined")) {
alert("Devi inserire un indirizzo email corretto");
document.myForm.email.focus();
return false;
}

else if (password.length<6 || (password == "") || (password == "undefined") ) {
alert("Scegli una password, minimo 6 caratteri");
document.myForm.password.focus();
return false;
}
else {
document.myForm.action = "accedi.php";
document.myForm.submit();
}
}



function validaRegistrati() {
// Variabili associate ai campi del modulo
var email = document.myForm.email.value;
var password = document.myForm.password.value;
var nome = document.myForm.nome.value;
var cognome = document.myForm.cognome.value;
var telefono = document.myForm.telefono.value;
var confermapassword= document.myForm.confermapassword.value;
var email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;

if ((nome == "") || (nome == "undefined")) {
alert("Devi inserire un nome");
document.myForm.nome.focus();
return false;
}

else if ((cognome == "") || (cognome == "undefined")) {
alert("Devi inserire un cognome");
document.myForm.cognome.focus();
return false;
}

else if ((isNaN(telefono)) || (telefono == "") || (telefono == "undefined")) {
alert("Devi inserire il numero di telefono");
document.myForm.telefono.value = "";
document.myForm.telefono.focus();
return false;
}

// Espressione regolare dell'email

else if (!email_valid.test(email) || (email == "") || (email == "undefined")) {
alert("Devi inserire un indirizzo email corretto");
document.myForm.email.focus();
return false;
}

else if (password.length<6 || (password == "") || (password == "undefined") ) {
alert("Scegli una password, minimo 6 caratteri");
document.myForm.password.focus();
return false;
}

//Effettua il controllo sul campo CONFERMA PASSWORD
else if ((confermapassword == "") || (confermapassword == "undefined")) {
alert("Devi confermare la password");
document.myForm.confermapassword.focus();
return false;
}

else if (password != confermapassword) {
alert("La password inserita in conferma password e' diversa dalla password");
document.myForm.confermapassword.value = "";
document.myForm.confermapassword.focus();
return false;
}

else {
document.myForm.action = "registrati.php";
document.myForm.submit();
}
}
