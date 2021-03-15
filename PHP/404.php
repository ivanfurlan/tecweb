<?php
header("HTTP/1.1 404 Not Found");
require_once("funzioni.php");
$paginaHTML = getPaginaHTML($_SERVER["PHP_SELF"]);
echo $paginaHTML;