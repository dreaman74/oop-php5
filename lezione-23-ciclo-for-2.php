<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 23 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	ol {line-height:1.5em;}
	p {margin:0px;}
	pre {
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
	table, th, td {border-collapse:collapse;}
	td {border: 1px solid red;text-align:center;}
</style>
</head>
<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 23</strong>
	</p>
	
	<h1>ciclo for - parte 2 di 2</h1>
	
	<p style="margin-bottom:20px;">
	Una COSTANTE LETTERALE, variabile stringa istanziata con un'espressione che non deve essere valutata, è al tempo stesso un ARRAY: Ogni Lettera, numero o simbolo, in essa contenuto, può essere iterato con un ciclo.
	</p>
	<p style="margin-bottom:20px;">Mediante il ciclo for, scorriamo l'Array <b>$parola</b> [COSTANTE LETTERALE].
	</p>
	<p>Come funziona il <strong>ciclo for</strong>
		<ol>
			<li>Inizializza il contatore '$i=0';</li>
			<li>Espressione Logica, esegue le istruzioni se True '<?php echo htmlspecialchars('$i<strlen($parola)');?>';</li>
			<li>Esegue le istruzioni;</li>
			<li>Incrementa il contatore '$i++'.</li>
		</ol>
	</p>
	
<?php
$nl="<br />"; // ANDARE A CAPO NELL VIEW del BROWSER

$codice=<<<'CODICE'
$parola="FANTASTICO";
for ($i=0; $i<strlen($parola); $i++)
	echo"<tr><td>$parola[$i]</td></tr>\n";
CODICE;

	echo'<div style="float:left;width:50%;">';
		echo "<p>codice di esempio</p>";
		echo "<pre>";
		echo htmlspecialchars($codice);
		echo "</pre>";
	echo '</div>';
	
	$parola="FANTASTICO";
	
	echo'<div style="float:left;width:50%;">';
		echo('<p style="margin: 0px 0px 10px 50px;">risultato a video</p>');
		echo('<table style="margin:0px 0px 0px 50px;">');
			echo("<tr><th>LETTERA</th></tr>");
			# ---------------- CICLO FOR ----------------
			for ($i=0; $i<strlen($parola); $i++)
				echo "<tr><td>$parola[$i]</td></tr>\n";		
		echo "</table>";
	echo '</div>';
?>
	<div style="clear:both;"></div>
	<div style="border-top:#afafaf 1px solid;margin:10px 0px;"></div>

	<h2>Esempio 2</h2>				
	<p><strong>Contare il numero di vocali presenti in una parola</strong>
		<ol>
			<li>&egrave; possibile dichiarare e inizializzare pi&ugrave; variabili;</li>
		</ol>
	</p>
<?php 
$codice=<<<'CODICE'
$parola="FANTASTICO";
for ($i=0, $j=strlen($parola)-1, $contaVocali=0; $i<strlen($parola); $i++, $j--)
{
	echo"<tr><td>$parola[$i]</td><td>$parola[$j]</td></tr>\n";
		// Confronto Bitwise !== o ===		
		if(strpos("AEIOU",strtoupper($parola[$i])) !== false) // oppure usare '=== true'
			$contaVocali++:
}
CODICE;

	echo "<p>codice di esempio</p>";
	echo "<pre>";
	echo htmlspecialchars($codice);
	echo "</pre>";
	
	$parola="FANTASTICO";
	
	echo('<p style="margin: 0px 0px 10px 0px;">risultato a video</p>');
	echo('<table>');
	echo('<tr><th colspan="2">LETTERA</th></tr>');
	# ---------------- CICLO FOR ----------------
	for ($i=0, $j=strlen($parola)-1, $contaVocali=0; $i<strlen($parola); $i++, $j--){
		echo "<tr><td>$parola[$i]</td><td>$parola[$j]</td></tr>\n";
			if(strpos("AEIOU",strtoupper($parola[$i]))!==false)
				$contaVocali++;
	}
	echo "</table>";
?>
<div style="clear:both;"></div>
<div style="border-top:#afafaf 1px solid;margin:10px 0px;"></div>

<h2>Esempio 3</h2>
<p>Nessuna delle 3 sezioni all'inizializzazione del ciclo for &egrave; obbligatoria.</p>
<?php
$codice=<<<'CODICE'
$parola="FANTASTICO";
for($i=0; ; $i++)
{
	if($i>=strlen($parola))
		break; // Esce dal ciclo
}
CODICE;

	echo "$nl\n<p>codice di esempio</p>";
	echo "<pre>";
	echo htmlspecialchars($codice);
	echo "</pre>";
?>
<h2>Esempio 4</h2>
<?php
$codice=<<<'CODICE'
$parola="FANTASTICO";
for(; ;)
{
...
}
CODICE;

	echo "\n<p>codice di esempio</p>";
	echo "<pre>";
	echo htmlspecialchars($codice);
	echo "</pre>";
?>
</body>
</html>