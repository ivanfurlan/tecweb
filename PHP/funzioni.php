<?php

/* Funzione che ricevuto in ingresso la pagina corrente recupera il file HTML e successivamente:
    - ci inserisce HEADER e FOOTER
    - mostra il pulsante esci se si è loggati
    - elimina i link ricorsivi

    Ritorna una stringa contenente la pagina HTML senza eventuale contenuto dinamico all'interno del main (che sarà da gestine nella relativa pagina)
    */
function getPaginaHTML($pageName)
{
    //prende solo il nome del file corrente se viene passato tutto il path dalla cartella di root (per esempio con $_SERVER['PHP_SELF'])
    if (strrpos($pageName, "/") !== FALSE) {
        $pageName = substr($pageName, 1 + strrpos($pageName, "/"));
    }
    $PATH_HTML = "HTML/";

    $paginaHTML = file_get_contents($PATH_HTML . str_replace(".php", ".html", $pageName));
    $footerHTML = file_get_contents($PATH_HTML . 'footer.html');
    $headerHTML = file_get_contents($PATH_HTML . 'header.html');

    //se la sessione non è aperta la apro
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //Se loggato mostro il pulsante esci
    if (isset($_SESSION['emailUtente'])) {
        $headerHTML = str_replace('<li><a href="registrati.php">Registrati</a></li>', '', $headerHTML);
        $headerHTML = str_replace('<li><a href="accedi.php">Accedi</a></li>', '<li><a href="logout.php">Esci</a></li>', $headerHTML);
    }

    //Setto il titolo della pagina
    $pageTitle = "";
    switch ($pageName) {
        case "404.php":
            $pageTitle = "Un buco nero";
            break;
        case "500.php":
            $pageTitle = "Un errore del server";
            break;
        case "index.php":
            $pageTitle = "Home";
            break;
        case "contatti.php":
            $pageTitle = "Contatti";
            break;
        case "dottore.php":
            $pageTitle = "Dottore";
            break;
        case "areamedica.php":
            $pageTitle = "Area medica";
            break;
        case "citologianasale.php":
            $pageTitle = "Citologia nasale";
            break;
        case "impedenzometria.php":
            $pageTitle = "Impedenzometria";
            break;
        case "otomicroscopia.php":
            $pageTitle = "Otomicroscopia";
            break;
        case "posturografia.php":
            $pageTitle = "Posturografia";
            break;
        case "notizie.php":
            $pageTitle = "Notizie";
            break;
        case "prenotavisita.php":
            $pageTitle = "Prenota visita";
            break;
        case "consultionline.php":
            $pageTitle = 'Consulti <span xml:lang="en">online</span>';
            break;
        case "registrati.php":
            $pageTitle = "Registrati";
            break;
        case "accedi.php":
            $pageTitle = "Accedi";
            break;
        case "elencoconsultionline.php":
            $pageTitle = 'Elenco <span xml:lang="en">chat</span>';
            break;
        case "visiteprenotate.php":
            $pageTitle = "Visite prenotate";
            break;
        default:
            $pageTitle = $pageName; //di default nome uguale al nome della pagina
            break;
    }

    //Inserisco i breadcrumbs
    $breadcrumbs = '';
    if ($pageName == "index.php") { //se index.php il breadcrumbs non ha nessun link
        $breadcrumbs .= '<span xml:lang="en">' . $pageTitle . '</span>';
    } else {
        if ($pageName != "404.php" && $pageName != "500.php") { //se sono pagine di errore non mostro il link ad HOME
            $breadcrumbs .= '<a href="index.php"><span xml:lang="en">Home</span></a> &gt;&gt; ';
        }
        //se e' una pagina dell'area medica aggiungo il link alla pagina areamedica.php, o se sono admine sono sui consultionline
        switch ($pageName) {
            case "citologianasale.php":
            case "impedenzometria.php":
            case "otomicroscopia.php":
            case "posturografia.php":
                $breadcrumbs .= '<a href="areamedica.php">Area medica</a> &gt;&gt; ';
                break;
            case "consultionline.php":
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                    $breadcrumbs .= '<a href="elencoconsultionline.php">Elenco <span xml:lang="en">Chat</span></a> &gt;&gt; ';
                    $breadcrumbs .= $_GET['email'];
                }
                break;
            default:
                break;
        }
        $breadcrumbs .= $pageTitle;
    }
    $headerHTML = str_replace('<pageBreadcrumbs />', $breadcrumbs, $headerHTML);

    //se si è loggati come admin il menù sarà diverso
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
        //Elenco chat al posto di Consulti online
        $headerHTML = str_replace('<li><a href="consultionline.php">Consulti <span xml:lang="en">online</span></a></li>', '<li><a href="elencoconsultionline.php">Elenco <span xml:lang="en">chat</span></a></li>', $headerHTML);
        //Visite prenotate al posto di Prenota visita
        $headerHTML = str_replace('<li><a href="prenotavisita.php">Prenota visita</a></li>', '<li><a href="visiteprenotate.php">Visite prenotate</a></li>', $headerHTML);
    }

    //Tolgo i link ricorsivi e imposto il currentLink
    if ($pageName == "index.php") {
        $headerHTML = str_replace('<a href="index.php" id="logo">', '<a href="#" id="logo">', $headerHTML);
        $headerHTML = str_replace('<h1><a href="index.php"><abbr title="Dottor">Dott.</abbr> Marco Donati</a></h1>', '<h1><abbr title="Dottor">Dott.</abbr> Marco Donati</h1>', $headerHTML);

        $headerHTML = str_replace('<li xml:lang="en"><a href="' . $pageName . '">' . $pageTitle . '</a></li>', '<li class="currentLink">' . $pageTitle . '</li>', $headerHTML);
    } else {
        $headerHTML = str_replace('<li><a href="' . $pageName . '">' . $pageTitle . '</a></li>', '<li class="currentLink">' . $pageTitle . '</li>', $headerHTML);
    }
    $paginaHTML = str_replace("<pageFooter />", $footerHTML, $paginaHTML);
    $paginaHTML = str_replace("<pageHeader />", $headerHTML, $paginaHTML);

    return $paginaHTML;
}
