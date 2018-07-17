<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 28 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	ol,ul{line-height:1.5em;}
	p {margin:0px;padding:0px;}
	pre {
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
</style>
</head>
<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 28</strong>
	</p>
	
	<h1>[28] Funzioni - parte 4 di 4</h1>
	
	<p>Argomenti di questa lezione:
		<ul>
			<li>Funzioni che restituiscono un valore;</li>
			<li>Funzioni che restituiscono più valori;</li>
			<li>Variabili che contengono nel valore il nome di una funzione.</li>
		</ul>
	</p>
	
	<hr />
	
	<h2>Lanciare un dado</h2>
	<p>Creare una funzione che restituisce un numero randomico da 1 a 6.</p> 
	
	<h3>Esempio 1</h3>
	
	<h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$nl = "<br />";
	
for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
	echo rand(1,6).$nl;
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h4>Visualizzato nel browser</h4>
	<?php
	$nl = "<br />";
	
	echo '<pre>';
	for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
		echo rand(1,6).$nl;
	echo '</pre>';
	?>
	
	<hr />
	
	<h2>Lanciare un dado tarocco</h2>
	
	<h3>Esempio 2</h3>
	
	<h4>Codice</h4>
	<p style="background-color:yellow;margin-top:10px;padding:5px;">Quando si invoca il 'return' l'esecuzione della funzione 
	termina immediatamente, uscendo dalla stessa.</p>
<?php
$codice=<<<'CODICE'
$nl = "<br />";

function dado_tarocco($faccia_taroccata)
{
	$estratto = rand(1,10);
	
	if $estratto<=6
		return $estratto; // Termina esecuzione della funzione;
	else
		return $faccia_taroccata; // Termina esecuzione della funzione;
		
	// Queste istruzioni non vengono eseguite
}
		
for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
	echo dado_tarocco(3).$nl;
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h4>Visualizzato nel browser</h4>
	<?php
	$nl = "<br />";
	
	function dado_tarocco($faccia_taroccata)
	{
		$estratto = rand(1,10);
	
		if ($estratto<=6)
			return $estratto; // Termina esecuzione della funzione;
		else
			return $faccia_taroccata; // Termina esecuzione della funzione;
	}	

	echo '<pre>';
	for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
		echo dado_tarocco(3).$nl;
	echo '</pre>';
	?>
	
	<hr />
	
	<h2>Lanciare due dadi</h2>
	<p>Funzione che restituisce più valori. Creazione di una funzione che restituisce un Array con 2 elementi con valori randomici.</p>
	
	<h3>Esempio 3</h3>
	
	<h4>Codice</h4>
<?php 
$codice=<<<'CODICE'
$nl = "<br />";

function coppia_dadi()
{
	return array(rand(1,6), rand(1,6));
}

for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
{
	$due_dadi = coppia_dadi();
	echo $due_dadi[0].' - '.$due_dadi[1].$nl;
}
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h4>Visualizzato nel browser</h4>
	<?php 
	$nl = "<br />";

	function coppia_dadi()
	{
		return array(rand(1,6), rand(1,6));
	}
	
	echo '<pre>';
	for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
	{
		$due_dadi = coppia_dadi();
		echo $due_dadi[0].' - '.$due_dadi[1].$nl;
	}
	echo '</pre>';
	?>
	
	<hr />
	
	<h2>Variabili con nomi funzione</h2>
	<p>&Egrave; possibile assegnare ad una variabile il nome di una funzione, da richiamare in un secondo momento nel codice.</p>
	
	<h3>Esempio 4</h3>
	<p>Lanciare un dado tarocco, il mercoledì lancia un dado molto tarocco.</p>
	<p style="background-color:yellow;margin:10px 0px;padding:5px;">Utilizzo della funzione built-in <b>getdate()</b>. 
	<b>Essa restituisce un array associativo.</b> L'Argomento [opzionale] da passare, 
	quando si invoca la funzione, deve essere un Timestamp,	omettendolo, la funzione, recupera la data del Server Locale.
	</p>
	
	<p>Link utili di approfondimento della funzione getdate():
		<ul>
			<li><a href="http://php.net/manual/it/function.getdate.php" title="php.net getdate()">php.net getdate()</a></li>
			<li><a href="http://www.w3schools.com/php/func_date_getdate.asp" title="w3schools.com getdate()">w3schools.com getdate()</a></li>
		</ul>
	
	<h4>Codice</h4>
	<?php
$codice=<<<'CODICE'
$nl = "<br />";
	
function dado_taroccato($faccia_taroccata)
{
	$estratto = rand(1,10);
	
	if ($estratto<=6)
		return $estratto; // Termina esecuzione della funzione;
	else
		return $faccia_taroccata; // Termina esecuzione della funzione;
}
	
function dado_molto_taroccato($faccia_taroccata)
{
	$estratto = rand(1,13);
	
	if ($estratto<=6)
		return $estratto; // Termina esecuzione della funzione;
	else
		return $faccia_taroccata; // Termina esecuzione della funzione;
}
	
// La funzione getdate() restituisce un array associativo
// L'Argomento [opzionale] da passare, quando si invoca la funzione, deve essere un Timestamp
// Omettendolo, la funzione, recupera la data del Server Locale
$arrDate = getdate();
if($arrDate['wday']==3) // 0=domenica, 1=lunedì, 2, 3=mercoledì, 4, 5, 6=sabato
	$usa_questa="dado_molto_taroccato";
else
	$usa_questa="dado_taroccato";

for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
{
	echo $usa_questa(3).$nl;
}
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
	?>
	
	<h4>Visualizzato nel browser</h4>
	<?php
	$nl = "<br />";
	
	function dado_taroccato($faccia_taroccata)
	{
		$estratto = rand(1,10);
	
		if ($estratto<=6)
			return $estratto; // Termina esecuzione della funzione;
		else
			return $faccia_taroccata; // Termina esecuzione della funzione;
	}
	
	function dado_molto_taroccato($faccia_taroccata)
	{
		$estratto = rand(1,13);
	
		if ($estratto<=6)
			return $estratto; // Termina esecuzione della funzione;
		else
			return $faccia_taroccata; // Termina esecuzione della funzione;
	}
	
	// La funzione getdate() restituisce un array associativo
	// L'Argomento [opzionale] da passare, quando si invoca la funzione, deve essere un Timestamp
	// Omettendolo, la funzione, recupera la data del Server Locale
	$arrData = getdate();
	if($arrData['wday']==3) // 0=domenica, 1=lunedì, 2, 3=mercoledì, 4, 5, 6=sabato
	{
		echo "Funzione richiamata 'dado_molto_taroccato'";
		$usa_questa="dado_molto_taroccato";
	}
	else
	{
		echo "Funzione invocata 'dado_taroccato'";
		$usa_questa="dado_taroccato";
	}
	echo "{$nl}Numero Giorno della settimana: {$arrData['wday']}";
	
	echo '<pre>';
	for ($numero_lanci=1; $numero_lanci<=20; $numero_lanci++)
	{
		echo $usa_questa(3).$nl;
	}
	echo '</pre>';
	?>
</body>
</html>