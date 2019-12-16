<?php

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$erroriDaMostrare = ''; //variabile a cui concatenare tutti gli errori
if (isset($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['telefono'], $_POST['password'], $_POST['confermapassword'])) {
    $email = trim($_POST['email']);
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $telefono = trim($_POST['telefono']);
    $password = $_POST['password'];
    $confermaPassword = $_POST['confermapassword'];

    $controlloDati = controlloCampiDati($nome, $cognome, $telefono, $email, $password, $confermaPassword);
    if ($controlloDati === true) {

        require_once("dbaccess.php");
        $oggettoConnessione = new DBAccess();
        $connessioneOK = $oggettoConnessione->openDBConnection();

        if (!$connessioneOK) {
            header("location: 500.php?errore=connessione_db");
        }

        if ($oggettoConnessione->emailGiaEsistente($email)) {
            $erroriDaMostrare .= '<li>L\'<span xml:lang="en">email</span> è già esistente</li>';
        } else {
            $result = $oggettoConnessione->registrazioneUtente($email, $nome, $cognome, $telefono, $password);
            if ($result) {
                session_start();
                $_SESSION['emailUtente'] = $email;
                $_SESSIOM['isAdmin'] = false;
                header("location: index.php");
            } else {
                header("location: 500.php?errore=registrazione_utente");
            }
        }
    } else {
        //ci sono degli errori
        //li inserisco nella varibile che poi stamperò
        $erroriDaMostrare .= $controlloDati;
    }
}

if ($erroriDaMostrare !== '') {
    $erroriDaMostrare = '<div class="erroreCampiForm"><ul>' . $erroriDaMostrare . '</ul></div>';
    
    //torno inserire nel form i dati dell'utente
    //ho la certezza ogni comando farà un unica sostituzione perché l'id deve esere unico in una pagina HTML
    $paginaHTML = str_replace('id="nome"', 'id="nome" value="' . $nome . '"', $paginaHTML);
    $paginaHTML = str_replace('id="cognome"', 'id="conome" value="' . $cognome . '"', $paginaHTML);
    $paginaHTML = str_replace('id="telefono"', 'id="telefono" value="' . $telefono . '"', $paginaHTML);
    $paginaHTML = str_replace('id="email"', 'id="email" value="' . $email . '"', $paginaHTML);
}
$paginaHTML = str_replace("<erroriDaMostrare />", $erroriDaMostrare, $paginaHTML);

echo $paginaHTML;
