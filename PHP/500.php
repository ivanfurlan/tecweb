<?php
header("HTTP/1.1 500 Server error");
require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

//se viene passato con get il tipo di errore che si e' verificato, lo inserisco nella pagina da stampare, altrimenti elimino il tag <descrizioneErrore />
$descrizioneErrore=(isset($_GET['errore']))? $_GET['errore'] : '';
$paginaHTML = str_replace("<descrizioneErrore />", $descrizioneErrore, $paginaHTML);

echo $paginaHTML;