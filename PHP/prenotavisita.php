<?php
session_start();
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
    //se è l'admin lo indirizzo alla pagina con l'elenco delle visite prenotate
    header('location: visiteprenotate.php');
}

require_once("dbaccess.php");
$oggettoConnessione = new DBAccess();
$connessioneOK = $oggettoConnessione->openDBConnection();

if (!$connessioneOK) {
    //connessione al db fallita
    header("location: 500.php?errore=connessione_db");
}

require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);
$erroriDaMostrare = '';

//se si sono ricevuti i parametri per inserire una nuova visita
if (isset($_SESSION['emailUtente'], $_POST['giorno'], $_POST['mese'], $_POST['anno'], $_POST['tipovisita'], $_POST['orario']) && $_POST['orario'] != '') {
    //devo inserire una nuova visita come prenotata
    $giorno = $_POST['giorno'];
    $mese = $_POST['mese'];
    $anno = $_POST['anno'];

    //faccio dei controlli sulla data inserita
    if (!checkdate($mese, $giorno, $anno)) {
        //la data non è valida
        $erroriDaMostrare .= "<li>La data scelta non può essere già passata. Selezionare una data futura.</li>";
    } elseif (dataGiaPassata($giorno, $mese, $anno)) {
        //la data è antecedente alla data corrente
        $erroriDaMostrare .= "<li>La data scelta non può essere già passata. Selezionare una data futura.</li>";
    } elseif (!$oggettoConnessione->dataOraVisitaDisponibile($giorno, $mese, $anno, $_POST['orario'])) {
        ///data e ora selezionati non sono disponibili
        $erroriDaMostrare .= "<li>La data e l'orario scelti non sono disponibili.</li>";
    } else {
        //la data è corretta e disponibile
        //procedo con l'inserimento
        $result = $oggettoConnessione->prenotaVisita($_SESSION['emailUtente'], $giorno, $mese, $anno, $_POST['orario'], $_POST['tipovisita']);
        if (!$result) {
            //la prenotazione ha generato un errore
            header("location: 500.php?errore=inserimento_nuova_visita");
        } else {
            //prenotazione effettuata
            //per cancellare variabili post così l'utente può aggiornre la pagina senza ricevere errori tentando di riprenotare l'appuntamento
            header("location: prenotavisita.php");
        }
    }
}

$pageContent = "";
$visitePrenotate = "";
//controllo se è stato fatto il login

if (isset($_SESSION['emailUtente'])) {
    //utente loggato. Do la possibilità di prenotare una visita e di visualizzzare quelle già prenotate
    $pageContent .= file_get_contents('HTML/prenotavisita_form.html');

    $visitePrenotate .= '<h2>Le mie visite future</h2>';
    $temp = preparaHTMLListaVisite($oggettoConnessione->getListaVisitePrenotatePeriodo("of",$_SESSION['emailUtente']));
    $visitePrenotate.= ($temp)?$temp:"<li>Non sono presenti visite prenotate per oggi o nei giorni futuri</li>";
    $visitePrenotate .= '</ul>';

    $visitePrenotate .= '<h2>Le mie ultiime 20 visite passate</h2>';
    $temp = preparaHTMLListaVisite($oggettoConnessione->getListaVisitePrenotatePeriodo("p",$_SESSION['emailUtente']));
    $visitePrenotate.= ($temp)?$temp:"<li>Non sono presenti visite passate</li>";
    $visitePrenotate .= '</ul>';
} else {
    //Non è stato effettuato l'acecsso
    $pageContent .= '
                <p><a href="accedi.php" title="Pagina per accedere">Effettua il login</a>, oppure <a href="registrati.php" title="Pagina per registrarsi">registrati</a>, per poter prenotare una visita con il Dottor Marco Donati in uno degli orari ancora disponibili.
                </p>
        ';
}

if ($erroriDaMostrare !== '') {
    //se ci sono degli errori da stampare, preparo la stringa dentro ad un div
    $erroriDaMostrare = '<div class="erroreCampiForm"><ul>' . $erroriDaMostrare . '</ul></div>';
}

$paginaHTML = str_replace("<erroriDaMostrare />", $erroriDaMostrare, $paginaHTML);
$paginaHTML = str_replace("<pageContent />", $pageContent, $paginaHTML);
$paginaHTML = str_replace("<visitePrenotate />", $visitePrenotate, $paginaHTML);

echo $paginaHTML;
