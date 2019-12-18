<?php

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$erroriDaMostrare = ''; //variabile a cui concatenare tutti gli errori
if (isset($_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['telefono'], $_POST['password'], $_POST['confermapassword'])) {
    //se l'utente ha gia' compilato la form
    $email = trim($_POST['email']);
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $telefono = trim($_POST['telefono']);
    $password = $_POST['password'];
    $confermaPassword = $_POST['confermapassword'];

    $controlloDati = controlloCampiDatiRegistrati($nome, $cognome, $telefono, $email, $password, $confermaPassword);
    if ($controlloDati === true) {
        //se i dati inseriti sono corretti
        require_once("dbaccess.php");
        $oggettoConnessione = new DBAccess();
        $connessioneOK = $oggettoConnessione->openDBConnection();

        if (!$connessioneOK) {
            //se la connessione non va a buon fine
            header("location: 500.php?errore=connessione_db");
        }

        if ($oggettoConnessione->emailGiaEsistente($email)) {
            //se l'email esiste gia', aggiungo il relativo errore
            $erroriDaMostrare .= '<li>L\'<span xml:lang="en">email</span> è già esistente</li>';
        } else {
            //email non esiste, quindi provo ad inserire il nuovo utente
            $result = $oggettoConnessione->registrazioneUtente($email, $nome, $cognome, $telefono, $password);
            if ($result) {
                //se la registrazione va a buon fine faccio gia' il login
                session_start();
                $_SESSION['emailUtente'] = $email;
                $_SESSIOM['isAdmin'] = false;
                header("location: index.php");
            } else {
                //la registrazione non e' andata a buon fine. Si e' verificato un errore
                header("location: 500.php?errore=registrazione_utente");
            }
        }
    } else {
        //ci sono degli errori nel form compilato dall'utente
        //li inserisco nella varibile che poi stamperò
        $erroriDaMostrare .= $controlloDati;
    }
}

if ($erroriDaMostrare !== '') {
    //se ci sono degli errori da stampare, preparo la stringa dentro ad un div
    $erroriDaMostrare = '<div class="erroreCampiForm"><ul>' . $erroriDaMostrare . '</ul></div>';
    
    //torno inserire nel form i dati dell'utente
    //ho la certezza ogni comando farà un unica sostituzione perché l'id deve esere unico in una pagina HTML
    $paginaHTML = str_replace('id="nome"', 'id="nome" value="' . $nome . '"', $paginaHTML);
    $paginaHTML = str_replace('id="cognome"', 'id="conome" value="' . $cognome . '"', $paginaHTML);
    $paginaHTML = str_replace('id="telefono"', 'id="telefono" value="' . $telefono . '"', $paginaHTML);
    $paginaHTML = str_replace('id="email"', 'id="email" value="' . $email . '"', $paginaHTML);
}

//inserisco gli errori. Se non ce ne fossero elimina semplicemente il tag <erroriDaMostrare />
$paginaHTML = str_replace("<erroriDaMostrare />", $erroriDaMostrare, $paginaHTML);

//stampo la pagina
echo $paginaHTML;
