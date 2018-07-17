<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 25 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 25</strong>
	</p>
	
	<h1>[25] Funzioni - parte 1 di 4</h1>
	<p style="font-size:18px;">
	Paragoniamole ad un box dove racchiudere il codice comune da utilizzare più volte in un'applicazione. Le funzioni rappresentano quindi una valido strumento correttivo - esempio correzione di errori - e manutentivo - ottimizzazione e/o aggiornamento -, in quanto una modifica al codice in esse contenuto si riflette su tutto il nostro codice.
	</p>
	<p style="font-size:18px;margin:10px 0px;">
	Con l'utilizzo delle Funzioni, si semplifica il codice e si isolano gli errori, questo metodo di analisi viene definito <b>Modalità TOP - DOWN</b> ovvero dividere un grande problema in tanti sottoproblemi, a loro volta semplificati in altri sottoproblemi da risolvere.
	</p>
	<p style="font-size:18px;">	
	<b>SCOPE - Ambito di visibilità delle variabili.</b> Le variabili esterne alle funzioni - se non dichiarate per riferimento - non sono visibili dalle istruzioni interne alle stesse.
	</p>
	
	<h2>Sintassi</h2>
	<h3>Come invocare e dichiarare le funzioni.</h3>
	<p style="border:red 1px solid;margin:10px 0px 0px 0px;padding:5px;">La Funzione viene invocata:</p>
	<pre>
p("primo paragrafo");
p("Secondo paragrafo", "background-color: pink; height: 30px;");
</pre>
	<p style="background-color:yellow;padding:5px;">
	Quando si invoca una funzione, bisogna passare lo stesso numero di argomenti riportati nella definizione, salvo quando a uno o più di essi viene assegnato un valore di default in fase di definizione.
	</p>
	<p style="border:red 1px solid;margin:10px 0px 0px 0px;padding:5px;">La Funzione viene definita:</p>
	<?php
	# CODICE PHP
	$codice=<<<'NOWDOC'
function p($testo, $stili=''){
	echo "<p style=\"$stili\">$testo</p>\n";
}
NOWDOC;
	echo "<pre>".htmlspecialchars($codice)."</pre>";
	?>
	<p>
	<ol>
		<li>la parola <b>function</b> è una <b>keyword</b></li>
		<li><b>p</b> è il <b>nome della funzione</b></li>
		<li><b>Tra parentesi tonde, divisi dalla virgola</b>, sono indicati <b>gli argomenti</b> [opzionali]</li>
	</ol>
	</p>
	<p style="background-color:yellow;padding:5px;">
	Nella definizione di una funzione l'operatore di assegnazione (=), assegna al relativo argomento il valore di default, nel caso in cui sia omesso quando essa viene invocata.
	</p>
	
	<hr />
	
	<h2>Esempio 1</h2>
	<p><b>Creare un paragrafo &lt;p&gt;</b> passando uno o più argomenti ad una funzione.</p>
	
	<h3>Codice Sorgente</h3>
	<h4>HTML</h4>
	<?php echo visualizza_codice();?>
	
	<h4>PHP</h4>
	<?php echo visualizza_codice('php');?>
	
	<h3>Risultato nel Browser</h3>
	<h4>HTML</h4>
	<p>Primo paragrafo</p>
	<p style="background-color: pink; height: 30px;">Secondo paragrafo</p>
	<h4>PHP</h4>
	<?php
	p("Primo paragrafo");
	p("Secondo paragrafo", "background-color: pink; height: 30px;");
		
	function p($testo, $stili=''){
		echo "<p style=\"$stili\">$testo</p>\n";	
	}
	?>
</body>
</html>
<?php
function visualizza_codice($tipo=''){
if($tipo!='php'){
# CODICE HTML
$codice=<<<'NOWDOC'
<p>Primo paragrafo</p>
<p style="background-color: pink, height: 30px;">Secondo paragrafo</p>
NOWDOC;
}else{
# CODICE PHP
$codice=<<<'NOWDOC'
p("Primo paragrafo");
p("Secondo paragrafo", "background-color: pink; height: 30px;");

function p($testo, $stili=''){
	echo "<p style=\"$stili\">$testo</p>\n";
}
NOWDOC;
}

return "<pre>".htmlspecialchars($codice)."</pre>";
}
?>