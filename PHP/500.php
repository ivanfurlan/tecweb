<?php
require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);

$descrizioneErrore=(isset($_GET['errore']))? $_GET['errore'] : '';
$paginaHTML = str_replace("<descrizioneErrore />", $descrizioneErrore, $paginaHTML);

echo $paginaHTML;