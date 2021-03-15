<?php
// questa pagina stampa solo un file in formato JSON che viene utilizzata come API da javascript in prenotavisita.php

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    // se la connessione al db non va a buon fine
    header("location: 500.php?errore=connessione_db");
}

// se non ci sono variabili impostate ritorno un 404 (per esempio se uno prova ad acedere alla pagina da browser)
if (!isset($_POST['giorno'], $_POST['mese'], $_POST['anno'])) {
    header("location: 404.php");
}

// non serve controllare che la data sia corretta, perché questa pagina viene chiamata SOLTANTO da javascript,
// quindi se viene chiamata vuol dire che javascript è attivo ed ha già fatto i controlli

// Anche venisse chiamata con una data non corretta in altri modi, non ci sarebbero problemi, verrebbero solo date informazioni vecchie, o nessuna informazione se la data è semanticamente sbagliata (al massimo un errore)

$result = $oggettoConnessione->controllaDisponibilita($_POST['giorno'], $_POST['mese'], $_POST['anno']);

header('Content-type: text/javascript');
if ($result !== NULL) {
    // c'e' qualche orario gia' prenotato nel giorno selezionato
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    // non c'e' nessuna prenotazione per il giorno selezionato
    echo "{}";
}
