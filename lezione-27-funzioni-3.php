<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 27 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 27</strong>
	</p>
	
	<h1>[27] Funzioni - parte 3 di 4</h1>
	
	<p><b>Le variabili, definite all'interno delle funzioni sono dette variabili locali</b>. 
	Esse sono utilizzabili e muoiono all'interno nella definizione della funzione stessa. Non è possibile 
	invocare nuovamente la stessa funzione - ritornando una seconda, terza, quarta volta.. - pensando di ritrovare 
	la variabile locale con lo stesso valore precedentemente asseganto.
	</p>
	
	<h2>Ambito di visibilità delle variabili</h2>
	<p>
	Date 2 variabili aventi stesso identificatore, una esterna (dichiarata nella ROOT dello script) e l'altra all'interno della funzione,  
	i loro valori sono diversi e indipendenti: la modifica che si effettua su una non si riflette sull'altra. 
	</p>
	<h3>Esempio 1</h3>
	<h4>Codice</h4>
	<?php
$codice=<<<'CODICE'
$nl="<br />";

// Richiama 10 volte la funzione che stampa il saluto 'Ciao' 
for(i=0;i<10;i++)
	echo piu_saluto_e_meglio_e();

function piu_saluto_e_meglio_e()
{
	global $nl;
		
	// In questo costrutto condizionale uso un'istruzione per condizione
	// non ho bisogno di parentesi graffe
	if(!isset($saluto))
		$saluto = "Ciao";
	else
		$saluto = $saluto." - Ciao"; // Questa istruzione non verrà mai eseguita
		
	return $saluto.$nl;
}
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
	?>
	<h4>Risultato nel browser</h4>
	<?php 
	$nl="<br />";
	
	// Richiama 10 volte la funzione che stampa il saluto 'Ciao'
	echo '<pre>';
	for($i=0;$i<10;$i++)
		echo "$i > ".piu_saluto_e_meglio_e();
	echo '</pre>';
	
	function piu_saluto_e_meglio_e()
	{
		global $nl;
	
		// In questo costrutto condizionale uso un'istruzione per condizione
		// non ho bisogno di parentesi graffe
		if(!isset($saluto))
			$saluto = "Ciao";
		else
			$saluto = $saluto." - Ciao";
	
		return $saluto.$nl;
	}
	?>
	
	<hr />
	
	<h2>Variabili Static</h2>
	<p>Le variabili di tipo Static, dichiarate all'interno delle funzioni, <b>mantengono in memoria i valori precedentemente assegnati</b> 
	dalle precedenti invocazioni della funzione che le contiene. <b>&Egrave; possibile assegnare anche un valore di partenza</b>, alla 
	variabile di tipo Static, che verrà assegnato solo quando la funzione viene invocata per la prima volta (<b>vedi esempio 3</b>).
	
	<h3>Esempio 2</h3>
	<h4>Codice</h4>
	<?php
$codice=<<<'CODICE'
$nl="<br />";

// Richiama 10 volte la funzione che stampa il saluto 'Ciao' 
$contatore=0;
while ($contatore<10)
{
	piu_saluto_e_meglio_e();
	$contatore++;
}

function piu_saluto_e_meglio_e()
{
	// Rendo la variabile esterna visibile alle istruzioni della funzione
	global $nl;
	
	// Dichiaro una variabile di tipo Static
	static = $saluto;
		
	// In questo costrutto condizionale uso un'istruzione per condizione
	// non ho bisogno di parentesi graffe
	if(!isset($saluto))
		$saluto = "Ciao";
	else
		$saluto = $saluto." - Ciao"; // eseguita dalla seconda invocazione in poi
		
	return $saluto.$nl;
}
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
	?>
	
	<h4>Risultato nel browser</h4>
	<?php 
	$nl="<br />";
	
	// Richiama 10 volte la funzione che stampa il saluto 'Ciao' 
	$contatore=0;
	echo '<pre>';
	while ($contatore<10)
	{
		echo "$contatore > ".piu_saluto_e_meglio_e_static();
		$contatore++;
	}
	echo '</pre>';
	
	function piu_saluto_e_meglio_e_static()
	{
		// Rendo la variabile esterna visibile alle istruzioni della funzione
		global $nl;
	
		// Dichiaro una variabile di tipo Static
		static $saluto;
	
		// In questo costrutto condizionale uso un'istruzione per condizione
		// non ho bisogno di parentesi graffe
		if(!isset($saluto))
			$saluto = "Ciao";
		else
			$saluto = $saluto." - Ciao";
	
		return $saluto.$nl;
	}
	?>
	
	<hr />
	
	<h2>Variabili Static e valore di partenza</h2>
	<p>In una funzione, in fase di dichiarazione, è possibile assegnare un valore ad una variabile 
	di tipo Static. Il valore sarà assegnato alla variabile solo nel momento in cui si invoca la funzione 
	la prima volta.</p>
	
	<p style="margin-top:10px;">Modificando la dichiarazione della variabile static <b>$saluto</b> nel codice dell'esempio 2,
	in questo modo:</p>
	
	<h3>Esempio 3</h3>
	
	<h4>Codice</h4>
<pre>
function piu_saluto_e_meglio_e()
{
	// Rendo la variabile esterna visibile alle istruzioni della funzione
	global $nl;
	
	// Dichiaro una variabile di tipo Static assegnando un valore di partenza
	static $saluto = "Topolino";

	...
}
</pre>

	<h4>Risultato nel browser</h4>
	<?php 
	$nl="<br />";
	
	// Richiama 10 volte la funzione che stampa il saluto 'Ciao' 
	$contatore=0;
	echo '<pre>';
	while ($contatore<10)
	{
		echo "$contatore > ".piu_saluto_e_meglio_e_static_valore();
		$contatore++;
	}
	echo '</pre>';
	
	function piu_saluto_e_meglio_e_static_valore()
	{
		// Rendo la variabile esterna visibile alle istruzioni della funzione
		global $nl;
	
		// Dichiaro una variabile di tipo Static assegnando un valore di partenza
		static $saluto = "Topolino";
	
		// In questo costrutto condizionale uso un'istruzione per condizione
		// non ho bisogno di parentesi graffe
		if(!isset($saluto))
			$saluto = "Ciao";
		else
			$saluto = $saluto." - Ciao";
	
		return $saluto.$nl;
	}
	?>
	
	<hr />
	
	<h2>Numero di argomenti fissi o variabili</h2>
	<p>Quando si definisce una funzione <b>non è obbligatorio dichiarare un numero fisso di argomenti</b>, 
	esso può essere anche variabile. Una funzione automaticamente può estrarre il numero di argomenti 
	passati.</p>
	
	<p style="margin-top:10px;">Abbiamo tre funzioni Built-in che gestiscono gli argomenti nelle funzioni, esse sono:
		<ul>
			<li><b>func_get_arg()</b> - Restituisce il valore relativo contenuto nell'Array
			<br /><a href="http://php.net/manual/en/function.func-get-arg.php">php.net - func_get_arg</a></li>
			<li><b>func_get_args()</b> - Restituisce un Array di Valori, con indice numerico
			<br /><a href="http://php.net/manual/en/function.func-get-args.php">php.net - func_get_args</a></li>
			<li><b>func_num_args()</b> - Restituisce il numero di Argomenti in entrata
			<br /><a href="http://php.net/manual/en/function.func-num-args.php">php.net - func_num_args</a></li>
		</ul>
	
	<h3>Esempio 4</h3>
	<p>Creiamo una funzione che visualizza tanti checkbox quanti sono gli argomenti passati.</p>
	
	<p style="background-color:yellow;margin-top:10px;padding:5px;"><b>Con la proprietà 'name="gustiGelato[]"'</b> creiamo un <b>elenco di checkbox</b> 
	appartenenti allo stesso gruppo che, al submit del form, <b>sarà passato come vettore (elementi in un Array)</b>.</p>
	<h4>Codice</h4>
	<?php
$codice=<<<'CODICE'
$nl = "<br />";
generaCheckbox("menta","limone");
	
function generaCheckbox()
{
	global $nl;
		
	$listaParametri = func_get_args();
	$numeroParametri = func_num_args();
		
	for ($parametro=0; $parametro<$numeroParametri; $parametro++)
	{
		echo $listaParametri[$parametro].
			 '<input type="checkbox" name="gustiGelato[]"'.
			 ' value="'.$listaParametri[$parametro].'" />'.$nl;
	}
}
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
	?>
	
	<h4>Risultato nel browser</h4>
	<pre>generaCheckbox("menta","limone");</pre>
	<?php generaCheckbox("menta","limone");?>
	<pre>generaCheckbox("menta","limone","fragola","anguria","melone");</pre>
	<?php generaCheckbox("menta","limone","fragola","anguria","melone");?>
	
	<?php
	$nl = "<br />";
	
	function generaCheckbox()
	{
		global $nl;
		
		$listaParametri = func_get_args();
		$numeroParametri = func_num_args();
	
		echo '<pre>';
		for ($parametro=0; $parametro<$numeroParametri; $parametro++)
		{
			echo $listaParametri[$parametro].
			'<input type="checkbox" name="gustiGelato[]"'.
			' value="'.$listaParametri[$parametro].'" />'.$nl;
		}
		echo '</pre>';
	}
	?>
</body>
</html>