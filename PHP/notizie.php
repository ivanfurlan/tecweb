<?php
require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    header("location: 500.php?errore=connessione_db");
}

//elimminare una notizia
if (isset($_SESSION['isAdmin'], $_GET['azione'], $_GET['notizia']) && $_SESSION['isAdmin'] == true && $_GET['azione'] == 'elimina' && $_GET['notizia'] != '') {
    if (!$oggettoConnessione->eliminaNotizia($_GET['notizia'])) {
        header("location: 500.php?errore=elimina_notizia");
    } else {
        //reload per cancellare i parametri passati con GET
        header("location: notizie.php");
    }
}

//modificare una notizia
if (isset($_SESSION['isAdmin'], $_POST['azione'], $_GET['notizia'], $_POST['titolo'], $_POST['contenuto']) && $_SESSION['isAdmin'] == true && $_POST['azione'] == 'Modifica' && $_GET['notizia'] != '') {
    if (!$oggettoConnessione->modificaNotizia($_GET['notizia'], $_POST['titolo'], $_POST['contenuto'])) {
        header("location: 500.php?errore=modifica_notizia");
    } else {
        //reload per cancellare i parametri passati con POST e GET
        header("location: notizie.php");
    }
}

//aggiungi una notizia
if (isset($_SESSION['isAdmin'], $_POST['azione'], $_POST['titolo'], $_POST['contenuto']) && $_SESSION['isAdmin'] == true && $_POST['azione'] == 'Aggiungi') {
    if (!$oggettoConnessione->aggiungiNotizia($_POST['titolo'], $_POST['contenuto'])) {
        header("location: 500.php?errore=aggiungi_notizia");
    } else {
        //reload per cancellare i parametri passati con POST 
        header("location: notizie.php");
    }
}

/*
print_r($_POST);
print_r($_GET);
*/

if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true && isset($_GET['azione']) && ($_GET['azione'] == 'aggiungi' || ($_GET['azione'] == 'modifica' && isset($_GET['notizia']) && $_GET['notizia'] != ''))) {

    $azione = ucfirst($_GET['azione']);
    $titoloNotizia = '';
    $contenutoNotizia = '';
    if ($azione == "Modifica") {
        $result = $oggettoConnessione->getNotiziaDaModificare($_GET['notizia']);
        //print_r($result);
        $titoloNotizia = $result['Titolo'];
        $contenutoNotizia = $result['Contenuto'];
    }
    $stringaFormNotizia .= '<form action="notizie.php?notizia=' . $_GET['notizia'] . '" method="post">
                                <fieldset>
                                    <legend class="nascosto">' . $azione . ' notizia</legend>
                                    <label for="titolo">Titolo</label>
                                    <input type="text" name="titolo" id="titolo" value="' . htmlentities($titoloNotizia) . '"/>
                                    <label for="contenuto">Testo della notizia: </label>
                                    <textarea name="contenuto" id="contenuto" rows="7" cols="40" title="Contenuto della notizia">' . htmlentities($contenutoNotizia) . ' </textarea>
                                    <input type="submit" name="azione" value="' . $azione . '" />
                                </fieldset>
                            </form>';

    $paginaHTML = str_replace("<listaDelleNotizie />", $stringaFormNotizia, $paginaHTML);
} else {
    $notizie = $oggettoConnessione->getNotizie();
    if ($notizie != NULL) {

        $stringaNotizie = '';

        foreach ($notizie as $news) {
            $stringaNotizie .= '<div class="notizia">
            <h2>' . $news["Titolo"] . '</h2>
            <p>
                Postato il ' . $news['Data'] . ' dal <a href="dottore.php"><abbr title="Dottor">Dott.</abbr> Marco Donati&nbsp;</a>
            </p>
            <p>' . $news['Contenuto'] . '</p>';
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                $stringaNotizie .= '<p> <a href="notizie.php?azione=modifica&notizia=' . $news['id'] . '">Modifica</a> - <a href="notizie.php?azione=elimina&notizia=' . $news['id'] . '">Elimina</a>';
            }
            $stringaNotizie .= '</div>';
        }
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            $stringaNotizie .= '<p> <a href="notizie.php?azione=aggiungi">Nuova notizia</a> </p>';
        }
        $paginaHTML = str_replace("<listaDelleNotizie />", $stringaNotizie, $paginaHTML);
    } else {
        $stringaNotizie = "<p>Attualmente non sono presenti notizie. Riprova nei giorni seguenti.</p>";

        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            $stringaNotizie .= '<p> <a href="notizie.php?azione=aggiungi">Nuova notizia</a> </p>';
        }
        $paginaHTML = str_replace("<listaDelleNotizie />", $stringaNotizie, $paginaHTML);
    }
}

echo $paginaHTML;
