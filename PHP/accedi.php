<?php
session_start();

if (isset($_SESSION['emailUtente'])) {
    //l'utente e' gia' loggato
    header("location: index.php");
}

$credenzialiErrate = false;
if (isset($_POST['email'], $_POST['password']) && $_POST['email'] != "" && $_POST['password'] != "") {
    //l'utente ha compilato il form e sta facendo il login
    $email = $_POST['email'];
    $password = $_POST['password'];

    //inserisco il file per connettermi al db solo qua, in quanto in questa pagina serve solo in questo punto, ed evito di includelo se non serve
    require_once("dbaccess.php");
    $oggettoConnessione = new DBAccess();
    $connessioneOK = $oggettoConnessione->openDBConnection();

    if (!$connessioneOK) {
        //connessione al db non e' andata a buon fine
        header("location: 500.php?errore=connessione_db");
    }
    $emailUtente = $oggettoConnessione->login($email, $password);
    if ($emailUtente !== false) {
        // loggatto corettamente
        $_SESSION['emailUtente'] = $emailUtente;
        //echo $_SESSION['emailUtente'];

        //salvo se si e' l'admin
        if ($_SESSION['emailUtente'] == "admin@admin.com") {
            $_SESSION['isAdmin'] = true;
        } else {
            $_SESSION['isAdmin'] = false;
        }
        header("location: index.php");
    } else {
        // credenziali errate
        $credenzialiErrate = true;
    }
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

//se credenziali errate inserisco il messaggio di errore altrimenti elimino il tag <credenzialiErrate />
$credenzialiErrate = ($credenzialiErrate) ? '<span class="erroreCampiForm">Email o password non corrette </span>' : "";
$paginaHTML = str_replace("<credenzialiErrate />", $credenzialiErrate, $paginaHTML);

echo $paginaHTML;
