<?php
// prendo la pagina HTML
require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

// Mi collego al db
require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    // connessione al db fallita
    header("location: 500.php?errore=connessione_db");
}

// elimminare una notizia
if (isset($_SESSION['isAdmin'], $_GET['azione'], $_GET['notizia']) && $_SESSION['isAdmin'] == true && $_GET['azione'] == 'elimina' && $_GET['notizia'] != '') {
    if (!$oggettoConnessione->eliminaNotizia($_GET['notizia'])) {
        // si è verificato un errore
        header("location: 500.php?errore=elimina_notizia");
    } else {
        // notizia eliminata
        // reload per cancellare i parametri passati con GET
        header("location: notizie.php");
    }
}

$erroriDaMostrare="";

// modificare una notizia
if (isset($_SESSION['isAdmin'], $_POST['azione'], $_GET['notizia'], $_POST['titolo'], $_POST['contenuto']) && $_SESSION['isAdmin'] == true && $_POST['azione'] == 'Modifica' && $_GET['notizia'] != '') {
    $notizia = $_GET['notizia'];
    $titolo = trim($_POST['titolo']);
    $contenuto = trim($_POST['contenuto']);
    if ($titolo != "" && $contenuto != "") {
        if (!$oggettoConnessione->modificaNotizia($notizia, $titolo, $contenuto)) {
            // si è verificato un errore
            header("location: 500.php?errore=modifica_notizia");
        } else {
            // notizia modificata
            // reload per cancellare i parametri passati con POST e GET
            header("location: notizie.php");
        }
    } else {
        $erroriDaMostrare.="Il titolo e/o il contenuto della notizia non possono essere vuoti";
        $_GET['azione']="modifica"; // Creo questa variabile così poi entra nell'if e tornerà mostrare il form
    }
}

// aggiungi una notizia
if (isset($_SESSION['isAdmin'], $_POST['azione'], $_POST['titolo'], $_POST['contenuto']) && $_SESSION['isAdmin'] == true && $_POST['azione'] == 'Aggiungi') {
    $titolo = trim($_POST['titolo']);
    $contenuto = trim($_POST['contenuto']);
    if ($titolo != "" && $contenuto != "") {
        if (!$oggettoConnessione->aggiungiNotizia($titolo, $contenuto)) {
            // si è verificato un errore
            header("location: 500.php?errore=aggiungi_notizia");
        } else {
            // notizia aggiunta correttamente
            // reload per cancellare i parametri passati con POST 
            header("location: notizie.php");
        }
    } else {
        $erroriDaMostrare.="Il titolo e/o il contenuto della notizia non possono essere vuoti";
        $_GET['azione']="aggiungi"; // Creo questa variabile così poi entra nell'if e tornerà mostrare il form
    }
}

// controllo se si è ricevuto la richiesta di modificare o aggiungere una notizia. Se sì mostro il form per svolgere l'operazione
if (isset($_SESSION['isAdmin'], $_GET['azione']) && $_SESSION['isAdmin'] == true && ($_GET['azione'] == 'aggiungi' || ($_GET['azione'] == 'modifica' && isset($_GET['notizia']) && $_GET['notizia'] != ''))) {
    // si vuole modificare o aggiungere una notizia
    $azione = ucfirst($_GET['azione']);
    $titoloNotizia = '';
    $contenutoNotizia = '';
    if ($azione == "Modifica") {
        // se si vuole modificare una notizia prendo dal database le informazioni già presenti da modificare
        $result = $oggettoConnessione->getNotiziaDaModificare($_GET['notizia']);
        // print_r($result);
        $titoloNotizia = $result['Titolo'];
        $contenutoNotizia = $result['Contenuto'];
    }

    $stringaFormNotizia='';
    if($erroriDaMostrare!=''){
        $stringaFormNotizia.='<strong class="erroreCampiForm">'.$erroriDaMostrare.'</strong>';
    }

    // inserisco il form, preimpostando i value se si sta effettuando una modifica (altrimenti le varibili essendo vuote non inseriranno niente)
    $stringaFormNotizia .= '<form action="notizie.php' . (($azione == "Modifica") ? '?notizia=' . $_GET['notizia'] : '') . '" method="post" onsubmit="return validaNotizia()" id="formNotizia">
                                <fieldset>
                                    <legend class="nascosto">' . $azione . ' notizia</legend>
                                    <label for="titolo">Titolo</label>
                                    <input type="text" name="titolo" id="titolo" value="' . htmlentities($titoloNotizia) . '"/>
                                    <label for="contenuto">Testo della notizia: </label>
                                    <textarea name="contenuto" id="contenuto" rows="7" cols="40" title="Contenuto della notizia">' . htmlentities($contenutoNotizia) . '</textarea>
                                    <input type="submit" name="azione" value="' . $azione . '" />
                                </fieldset>
                            </form>';

    $paginaHTML = str_replace("<listaDelleNotizie />", $stringaFormNotizia, $paginaHTML);
} else {
    // Devo mostrare l'elenco delle notizie
    $notizie = $oggettoConnessione->getNotizie();
    if ($notizie != NULL) {
        // ci sono notizie da mostrare
        $stringaNotizie = '';

        foreach ($notizie as $news) {
            // inserisco tutte le notizie
            $stringaNotizie .= '<div class="notizia">
            <h2>' . $news["Titolo"] . '</h2>
            <p>
                Postato il ' . $news['Data'] . ' dal <a href="dottore.php"><abbr title="Dottor">Dott.</abbr> Marco Donati&nbsp;</a>
            </p>
            <p>' . $news['Contenuto'] . '</p>';

            // se è l'admin mostro i pulsanti per modificare o eliminare una notizia
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                $stringaNotizie .= '<p> <a href="notizie.php?azione=modifica&notizia=' . $news['id'] . '">Modifica</a> - <a href="notizie.php?azione=elimina&notizia=' . $news['id'] . '">Elimina</a></p>';
            }
            $stringaNotizie .= '</div>';
        }

        // se è l'admin mostro il pulsante per aggiungere una notizia
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            $stringaNotizie .= '<p> <a href="notizie.php?azione=aggiungi">Nuova notizia</a> </p>';
        }
        $paginaHTML = str_replace("<listaDelleNotizie />", $stringaNotizie, $paginaHTML);
    } else {
        // non ci sono notizie
        $stringaNotizie = "<p>Attualmente non sono presenti notizie. Riprova nei giorni seguenti.</p>";

        // se è l'admin mostro il pulsante per aggiungere una notizia
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            $stringaNotizie .= '<p> <a href="notizie.php?azione=aggiungi">Nuova notizia</a> </p>';
        }
        $paginaHTML = str_replace("<listaDelleNotizie />", $stringaNotizie, $paginaHTML);
    }
}

// stampo la pagina
echo $paginaHTML;
