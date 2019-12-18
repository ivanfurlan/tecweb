<?php
//pagina acessibile solo dall'amministratore
session_start();

if ((isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == false) || !isset($_SESSION['isAdmin'])) {
    //se non si è admin si viene mandati alla pagina prenotavisita.php
    header('location: prenotavisita.php');
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();
if (!$connessioneOK) {
    //connessione db fallita
    header("location: 500.php?errore=connessione_db");
}

$result = $oggettoConnessione->ciSonoVisitePrenotate();

$pageContent = '';
if ($result) {
    //ci sono visite prenotate

    //DA FARE
    $pageContent .=  '<p>Oh, qualcuno ha prenotato una visita, ma ancora non sono in grado di dirchi chi è e quando verrà</p>';
} else {
    //non ci sono visite prenotate
    $pageContent .=  '<p>Al momento nessuno ha prenotato una visita</p>';
}
$paginaHTML = str_replace("<pageContent />", $pageContent, $paginaHTML);


echo $paginaHTML;
