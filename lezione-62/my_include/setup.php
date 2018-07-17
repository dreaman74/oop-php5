<?php
session_start();

$nl="<br />";

//Percorso della cartella contenente i file .ini ESTERNA alla cartella pubblica del sito
//$cartella_ini=$_SERVER['DOCUMENT_ROOT'].'/../../../my_ini';
$cartella_ini=$_SERVER['DOCUMENT_ROOT'].'/miei_test/fcamuso/lezione-62/my_ini';

//recupero messaggi di errore da File .INI
$messaggi_errore=parse_ini_file($cartella_ini.'/messaggi_errore.ini');
?>