<?php
session_start();

if (isset($_SESSION['emailUtente'])) {
    header("location: index.php");
}

$credenzialiErrate = false;
if (isset($_POST['email'], $_POST['password']) && $_POST['email'] != "" && $_POST['password'] != "") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once("dbaccess.php");
    $oggettoConnessione = new DBAccess();
    $connessioneOK = $oggettoConnessione->openDBConnection();

    if (!$connessioneOK) {
        header("location: 500.php?errore=connessione_db");
    }
    $emailUtente = $oggettoConnessione->login($email, $password);
    if ($emailUtente !== false) {
        // loggatto corettamente
        $_SESSION['emailUtente'] = $emailUtente;
        //echo $_SESSION['emailUtente'];
        if ($_SESSION['emailUtente'] == "admin@admin.com")
            $_SESSION['isAdmin'] = true;
        else
            $_SESSION['isAdmin'] = false;
        header("location: index.php");
    } else {
        // credenziali errate
        $credenzialiErrate = true;
    }
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$credenzialiErrate = ($credenzialiErrate) ? '<span class="erroreCampiForm">Email o password non corrette </ span>' : "";
$paginaHTML = str_replace("<credenzialiErrate />", $credenzialiErrate, $paginaHTML);

echo $paginaHTML;
