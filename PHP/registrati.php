<?php

//DA AGGIORNARE CON LA CLASSE DEL DATABASE

$campiErrati = false;
if (isset($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['telefono'], $_POST['password'], $_POST['confermapassword'])) {
    $email = trim($_POST['email']);
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $telefono = trim($_POST['telefono']);
    $password = $_POST['password'];
    $confermaPassword = $_POST['confermapassword'];

    //PRIMA BISOGNA FARE I CONTROLLI SU TUTTI I CAMPI 

    include("databaseconnection.php");
    $query = "INSERT INTO `Utenti` (`Email`, `Nome`, `Cognome`, `Telefono`, `Password`) VALUES ('$email', '$nome', '$cognome', '$telefono', '$password');";
    //echo $query;
    $result = $mysqli->query($query);

    if ($result === true) {
        session_start();
        $_SESSION['emailUtente'] = $email;
        $_SESSIOM['isAdmin'] = false;
        header("location: index.php");
    } else {
        if (strpos($mysqli->error, "Duplicate entry") !== false) {
            //email già esistente
            $campiErrati = true;
        } else {
            header("location: 500.php?errore=registrazione_utente");
        }
    }
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$campiErrati = ($campiErrati) ? '<span class="erroreCampiForm">Alcuni campi inseriti non rispettano le sintassi corretta o sono vuoti </ span>' : "";
$paginaHTML = str_replace("<campiErrati />", $campiErrati, $paginaHTML);

echo $paginaHTML;
