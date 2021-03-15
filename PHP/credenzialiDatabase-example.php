<?php
    // file esempio con le credenziali del database
    // Bisogna duplicare il file e mettergli come nome credenzialiDatabase.php (senza "-example")
    // e successivamente modificare le credenziali secondo il proprio database

    if (strpos($_SERVER['PHP_SELF'], 'credenzialiDatabase') !== false) {
        // se uno prova ad accedere a questa pagina da browser ritorno un 404, come se la pagina non esistesse
        header("location: 404.php");
    }
    const servername_db = "localhost";
	const username_db = "";
	const password_db = "";
    const dbname_db="dbDottMarcoDonati";
?>