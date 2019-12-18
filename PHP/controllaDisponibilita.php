<?php
//questa pagina stampa solo un file in formato JSON che viene utilizzata come API da javascript in prenotavisita.php

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    //se la connessione al db non va a buon fine
    header("location: 500.php?errore=connessione_db");
}

$result = $oggettoConnessione->controllaDisponibilita($_POST['giorno'], $_POST['mese'], $_POST['anno'], $_POST['tipovisita']);

header('Content-type: text/javascript');
if ($result !== NULL) {
    //c'e' qualche orario gia' prenotato nel giorno selezionato
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    //non c'e' nessuna prenotazione per il giorno selezionato
    echo "{}";
}
