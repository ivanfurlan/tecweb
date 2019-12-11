<?php
require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    header("location: 500.php?errore=connessione_db");
}
$notizie = $oggettoConnessione->getNotizie();

if ($notizie != NULL) {

    $stringaNotizie = '';

    foreach ($notizie as $news) {
        $stringaNotizie .= '<div class="notizia">
            <h2>' . $news["Titolo"] . '</h2>
            <p>
                Postato il ' . $news['Data'] . ' dal <a href="dottore.php"><abbr title="Dottor">Dott.</abbr> Marco Donati&nbsp;</a>
            </p>
            <p>' . $news['Contenuto'] . '</p>
            </div>';
    }

    $paginaHTML = str_replace("<listaDelleNotizie />", $stringaNotizie, $paginaHTML);
} else {
    $stringaNotizie = "<p>Attualmente non sono presenti notizie. Riprova nei giorni seguenti.</p>";
    $paginaHTML = str_replace("<listaDelleNotizie />", $stringaNotizie, $paginaHTML);
}


echo $paginaHTML;
