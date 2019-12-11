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
    if(strrpos($pageName, "/")!==FALSE){
        $pageName = substr($pageName, 1 + strrpos($pageName, "/"));
    }
    $PATH_HTML = "HTML/";

    $paginaHTML = file_get_contents($PATH_HTML . str_replace(".php", ".html", $pageName));
    $footerHTML = file_get_contents($PATH_HTML . 'footer.html');
    $headerHTML = file_get_contents($PATH_HTML . 'header.html');

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
            $pageTitle = "Elenco Chat";
            break;
        default:
            $pageTitle = $pageName; //di default nome uguale al nome della pagina
            break;
    }

    //Inserisco i breadcrumbs
    if ($pageName == "index.php") { //se index.php non ha nessun link
        $breadcrumbs = '<span xml:lang="en">' . $pageTitle . '</span>';
    } else if ($pageName == "404.php" || $pageName == "500.php") {
        $breadcrumbs .= $pageTitle;
    } else {
        $breadcrumbs = '<a href="index.php"><span xml:lang="en">Home</span></a> &gt;&gt; ';
        if ($pageName == "consultionline.php") {
            //se consultionline.php e sono il dottore devo mostrare l'email della chat
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                $breadcrumbs .= '<a href="elencoconsultionline.php">Elenco Chat</a> &gt;&gt; ';
                $breadcrumbs .= $_GET['email'];
            } else {
                $breadcrumbs .= $pageTitle;
            }
        } else {
            //se e' una pagina dell'area medica aggiungo il link alla pagina areamedica.php
            switch ($pageName) {
                case "citologianasale.php":
                case "impedenzometria.php":
                case "otomicroscopia.php":
                case "posturografia.php":
                    $breadcrumbs .= '<a href="areamedica.php">Area medica</a> &gt;&gt; ';
                    break;
                default:
                    break;
            }
            $breadcrumbs .= $pageTitle;
        }
    }
    $headerHTML = str_replace('<pageBreadcrumbs />', $breadcrumbs, $headerHTML);

    //Tolgo i link ricorsivi e imposto il currentLink
    if ($pageName == "index.php") {
        $headerHTML = str_replace('<li xml:lang="en"><a href="' . $pageName . '">' . $pageTitle . '</a></li>', '<li class="currentLink">' . $pageTitle . '</li>', $headerHTML);
    } else {
        $headerHTML = str_replace('<li><a href="' . $pageName . '">' . $pageTitle . '</a></li>', '<li class="currentLink">' . $pageTitle . '</li>', $headerHTML);
    }
    $paginaHTML = str_replace("<pageFooter />", $footerHTML, $paginaHTML);
    $paginaHTML = str_replace("<pageHeader />", $headerHTML, $paginaHTML);

    return $paginaHTML;
}
