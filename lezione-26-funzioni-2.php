<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 26 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	/*ol,ul {line-height:1.5em;}*/
	p {margin:0px;padding:0px;}
        p,ol,ul{font-size:18px;line-height:1.5em;}
        pre {
        font-size:16px;
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
</style>
</head>
<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 26</strong>
	</p>
	
	<h1>[26] Funzioni - parte 2 di 4</h1>	
	<p>
            Argomenti di questa lezione: Uso di variabili esterne ad una funzione con la keyword 'global'. 
            Passaggio di parametri per valore (by value) e per indirizzo (by reference).
	</p>

        <p style="margin:10px 0;padding:5px;border:green solid 2px;"><b>Le Variabili definite a livello di script (ROOT)</b> e visibili all'interno delle funzioni a cui vengono passate 
            <b>sono definite variabili globali</b>.</p>
        
        <h2>Passaggio per valore (By Value) - DEFAULT</h2>
	<p style="margin:10px 0px;">
            <b>Le Variabili Globali non sono visibili dalle istruzioni interne alle funzioni</b>.<br />
            In PHP è possibile rendere visibile il valore delle variabili all'interno delle funzioni, passando come argomento l'identificatore (nome della variabile) 
            in fase di invocazione delle stesse.<br />
            Per <b>DEFAULT</b>, alla funzione viene passata solo la <b>copia del valore</b> delle variabili globali (<b>By Value</b>).
	</p>
	
        <h2>Passaggio per riferimento (By Reference)</h2>
	<p>
            Per <b>modificare direttamente il valore di una variabile globale tramite una funzione</b>, abbiamo 2 possibilità:
            <ul>
                <li>Utilizzando nella funzione stessa la keyword '<b>global</b>' seguita dall'identificatore della variabile globale;</li> 
                <li>Nella dicharazione della funzione, esplicitare l'<b>argomento</b> che corrisponde alla variabile <b>anteponendo il simbolo &</b> (ampersand),
                    cosicché, quando si invoca la funzione stessa, la variabile globale corrisponda all'argomento con ampersand.</li>
            </ul>
	</p>	
	
	<hr />
	
	<h2>Keyword global</h2>
	<p>Per modificare tramite una funzione il valore di una variabile globale, usare la keyword 'global' seguita dall'identificatore della variabile esterna.</p>
	<h3>Codice sorgente</h3>
	<?php
	$codice=<<<'NOWDOC'
# Dichiarazione Variabili Esterne (ROOT - Livello di script)
$nl="<br />";
$messaggio = "Messaggio esterno alla funzione";

# Invocazione Funzione
p("Primo Pararafo");
echo "\$messaggio dopo la funzione vale: $messaggio$nl$nl";
		
# Dichiarazione Funzione
function p($testo,$stili="background-color:green;"){
	global $messaggio; // Accede alla variabile esterna
	echo "<p style=\"$stili\">$testo</p>\n";
	$messaggio = "Messaggio Modificato nella funzione!";
}
NOWDOC;
	
	echo "<pre>".htmlspecialchars($codice)."</pre>";
	?>
	
	<h3>Risultato nel browser</h3>
	<?php
	# Dichiarazione Variabili Esterne (ROOT - Livello di script)
	$nl="<br />";
	$messaggio = "Messaggio esterno alla funzione";

	# Invocazione Funzione
	p("Primo Pararafo");
	echo "<p>\$messaggio dopo la funzione vale: <b>$messaggio</b></p>";
	
	# Dichiarazione Funzione
	function p($testo,$stili="background-color:green;"){
		global $messaggio;
		echo "<p style=\"$stili\">$testo</p>\n";
		$messaggio = "Messaggio Modificato nella funzione!";
	}
	?>
	
	<hr />
	
	<h2>Variabile per riferimento/indirizzo con &$argomento</h2>
	<p>Quando si invoca una funzione, è possibile passare la variabile per indirizzo (riferimento)
	anteponendo, nella dichiarazione della funzione, all'argomento da passare come riferimento 
        il simbolo <b style="color:red;">&</b> (<b>ampersand - & commerciale</b>).</p>
        
        <p style="margin-top:10px;">Adesso qualsiasi variazione alla variabile/argomento <b>$testo</b> nella funzione <b>paragraph</b>, 
        si ripercuote su <b>$messaggio</b> (variabile a livello di script), in quanto la stessa è stata passata alla funzione 
        come riferimento tramite l'argomento <b>&$testo</b>.</p>
        
	<p style="background-color:yellow;margin-top:10px;padding:5px;"><b>Attenzione:</b> 
            Quando si invoca una funzione in cui si è dichiarato un argomento per riferimento, ad esso è possibile passare solo variabili e 
            non delle stringhe (COSTANTI LETTERALI).<br /><br />
            
            Corretto: <b>paragraph($messaggio)</b><br />
            Errato: paragraph("contenuto testuale, costante letterale");
	</p>
	
	<h3>Codice sorgente</h3>
	<?php
	$codice_r=<<<'NOWDOC'
# Dichiarazione Variabili Esterne (ROOT - Livello di script)
$nl="<br />";
$messaggio = "Messaggio esterno alla funzione";

# Invocazione Funzione
paragraph($messaggio);
echo "\$messaggio dopo la funzione vale: <b>$messaggio</b>$nl$nl";
paragraph($messaggio,"background-color:pink;padding:5px 0px;");
		
# Dichiarazione Funzione, con passaggio della variabile per riferimento (BY Reference)
# Anteporre all'argomento corrispondente il simbolo & (ampersand)
# La il valore della Variabile Globale $messaggio (ROOT - Livello di Script)
# adesso è accessibile dalle istruzioni interne alla funzione
# modificando la variabile $testo (interna alla funzione)
function paragraph(&$testo,$stili="background-color:green;"){
	echo "<p style=\"$stili\">$testo</p>\n";
	// Ora modifico il valore della variabile esterna $messaggio passata come riferiemnto 
	$testo = "Messaggio Modificato nella funzione!";
}

NOWDOC;
	
	echo "<pre>".htmlspecialchars($codice_r)."</pre>";
	?>
	
	<h3>Risultato nel browser</h3>
	<?php
	# Dichiarazione Variabili Esterne (ROOT - Livello di script)
	$messaggio_r = "Messaggio esterno alla funzione";
	
	# Invocazione Funzione
	paragraph($messaggio_r);
	echo "<p>\$messaggio dopo la funzione vale: <b>$messaggio_r</b></p>";
	paragraph($messaggio_r,"background-color:pink;padding:5px 0px;");
	
	# Dichiarazione Funzione, con passaggio della variabile per riferimento (BY Reference)
        # Anteporre all'argomento corrispondente il simbolo & (ampersand)
        # La il valore della Variabile Globale $messaggio_r (ROOT - Livello di Script)
        # adesso è accessibile dalle istruzioni interne alla funzione
        # modificando la variabile $testo_r (interna alla funzione)
	function paragraph(&$testo_r,$stili="background-color:green;"){
		echo "<p style=\"$stili\">$testo_r</p>\n";
		// Modifico il valore della variabile esterna $messaggio_r passata come riferiemnto 
		$testo_r = "Messaggio Modificato nella funzione!";
	}
	?>
</body>
</html>