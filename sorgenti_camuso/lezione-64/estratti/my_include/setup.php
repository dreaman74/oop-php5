<?php
session_start();
$nl="<br />";
$cartella_ini = $_SERVER['DOCUMENT_ROOT']."\..\my_ini";
$messaggi_errore=parse_ini_file($cartella_ini.'\messaggi_errore.ini');
?>