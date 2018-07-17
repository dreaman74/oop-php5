<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 29 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
	table, th, td {border-collapse:collapse;padding:5px;}
	th {border: 1px solid red;text-align:center;}
	td {border: 1px solid grey;text-align:center;}
</style>
</head>
<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 29</strong>
	</p>
	
	<h1>[29] Tutto sulle stringhe - parte 1 di 5</h1>
	
	<h2>Costanti Letterali Stringa</h2>
	<p>Argomenti di questa lezione:
		<ul>
			<li>i 3 metodi per inserire Costanti Letterali Stringa;</li>
			<li>l'Intepolazione in dettaglio, interpolazione ricorsiva;</li>
			<li>Stringhe Heredocs;</li>
			<li>le Sequenze di Escape;</li>
		</ul>
	</p>
	
	<hr />
	
	<h2>Dichiarare le Costanti Letterali Stringa</h2>
	<p>Ci sono tre metodi per dichiarare le Costanti Letterali Stringa.</p> 
	
	<h3>Stringa tra doppi apici (").</h3>
<?php 
$codice=<<<'CODICE'
$nl = "<br />";
CODICE;
	
	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>Stringa tra singoli apici (').</h3>
<?php
$codice=<<<'CODICE'
$nome = 'Giorgio';
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>HERE DOC</h3>
	<p>Il metodo Here Doc, è utile quando il testo da gestire.</p>
	<h4>Sintassi</h4>
	<p>
		<ul>
			<li><b>Variabile</b>;</li>
			<li><b>Operatore di assegnazione</b>;</li>
			<li><b>Operatore</b> &lt;&lt;&lt;</li>
			<li><b>Indicatore</b> Citazione.</li>
		</ul>
	</p> 
	<p>Nota: Questo metodo vale anche con il costrutto echo e funzioni print, etc.</p> 
	<?php
$codice=<<<'CODICE'
$brano = <<<Citazione // Questa istruzione non deve avere alcuno spazio dopo
	Quel ramo del lago di Como, che volge a mezzogiorno,  tra due catene non interrotte di monti, tutto a seni e a golfi, 
	a seconda dello sporgere e del rientrare di quelli, vien, 
	quasi a un tratto, a ristringersi, e a prender corso e figura di fiume, 
	tra un promontorio a destra, e un'ampia costiera dall'altra parte; 
	e il ponte, che ivi congiunge le due rive, par che renda ancor più sensibile 
	all'occhio questa trasformazione, e segni il punto in cui il lago cessa, 
	e l'Adda rincomincia, per ripigliar poi nome di lago dove le rive, 
	allontanandosi di nuovo, lascian l'acqua distendersi e 
	rallentarsi in nuovi golfi e in nuovi seni.
Citazione; // Questa istruzione non deve avere alcuno spazio prima

CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
<hr />

	<h2>Interpolazione delle variabili</h2>
	
	<h3>Interpolazione</h3>
	<p><b>Usando i doppi apici</b> per la dichiarazione di una Costante Letterale Stringa ed 
	inserendo una variabile precedentemente dichiarata,
	è possibile visualizzarne il valore espanso di quest'ultima (<b>la variabile viene espansa</b>).
<?php 
$codice=<<<'CODICE'
$nl = "<br />";
// Prima a capo, in quanto stampa il contenuto espanso della variabile $nl
// poi stampa i tre punti
$riga = "$nl ...";
CODICE;
	
	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>Interpolazione ricorsiva</h3>
	<p>L'interpolazione delle variabili, avviene su più livelli.</p>
<?php 
$codice = <<<'CODICE'
$nl = "<br />"; // 1° Livello
$a = "Ciao"; // 3° Livello
$b = "$a a"; // 2° Livello
$c = "$b tutti"; // 1° Livello
$d = "$c$nl";

echo $d;
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>Interpolazione con Here Doc</h3>
<?php
$codice=<<<'CODICE'
$intestazione='Quel ramo del lago di Como, che volge a mezzogiorno, ';
$brano = <<<Citazione // Questa istruzione non deve avere alcuno spazio dopo
	$intestazione tra due catene non interrotte di monti, tutto a seni e a golfi, 
	a seconda dello sporgere e del rientrare di quelli, vien, 
	quasi a un tratto, a ristringersi, e a prender corso e figura di fiume, 
	tra un promontorio a destra, e un'ampia costiera dall'altra parte; 
	e il ponte, che ivi congiunge le due rive, par che renda ancor più sensibile 
	all'occhio questa trasformazione, e segni il punto in cui il lago cessa, 
	e l'Adda rincomincia, per ripigliar poi nome di lago dove le rive, 
	allontanandosi di nuovo, lascian l'acqua distendersi e 
	rallentarsi in nuovi golfi e in nuovi seni.
Citazione; // Questa istruzione non deve avere alcuno spazio prima

CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>Interpolazione con Parentesi Graffe</h3>
	<p><b>Usare le parentesi graffe</b>, per isolare la variabile o l'Array. 
	Ovviamente, questo vale anche per gli Here Doc.</p>
<?php 
$codice=<<<'CODICE'
$volte = "20";
// Isolare la variabile, non usando le graffe
// l'identificativo sarebbe alla variabile $voltema
$saluto = "Ciao a tutti per la {$volte}ma volta";
echo $saluto;
CODICE;
	
	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<hr />
        
	<h2>Evitare Interpolazione delle variabili</h2>
	
	<h3>Singoli Apici</h3>
	<p>Dichiarando una Costante Letterale Stringa, <b>con i singoli apici</b>, 
	si evita l'interpolazione della/delle variabile/i contenute -  
	contenuto della/delle stessa/e non viene espanso.</p>
<?php
$codice=<<<'CODICE'
$nl = "<br />";
// Evitare l'interpolazione delle variabili
// Dichiarando la Costante Letterale con singoli apici
// le variabili in essa contenute non vengono espanse
$nome = '$nl Giorgio';
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>Backslash</h3>
        <p><b>Nel caso si usino i doppi apici o il costrutto 'Here Doc"</b>, 
        è possibile evitare l'interpolazione <b>anteponendo</b> il carattere di escape 
        (<b>backslash \) alla variabile</b> di cui non si vuole espandere 
        il contenuto.<br /><br />
        <b>Il carattere di escape non viene stampato a video nel Browser.</b></p>        
<?php
$codice=<<<'CODICE'
$nl = "<br />";
// Oppure, se si usano i doppi apici, anteporre il carattere di escape (\)
// alla variabile di cui non si vuole effettuare l'interpolazione
// Il Backslah non verrà stampato a video nel Browser
$nome = "\$nl Giorgio";
$cognome = "\{$nl} Bianchi";
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <p style="background-color:yellow;margin-top:10px;padding:5px;">
        Il simbolo di escape (backslash \) è trattato più approfonditamente nel corso della guida.</p>
	
	<h3>Now Doc</h3>
	<p>Tramite il costrutto Now Doc.</p>
	
	<h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$intestazione='Quel ramo del lago di Como, che volge a mezzogiorno, ';
$brano = <<<'Citazione' // Questa istruzione non deve avere alcuno spazio dopo
	$intestazione tra due catene non interrotte di monti, tutto a seni e a golfi, 
	a seconda dello sporgere e del rientrare di quelli, vien, 
	quasi a un tratto, a ristringersi, e a prender corso e figura di fiume, 
	tra un promontorio a destra, e un'ampia costiera dall'altra parte; 
	e il ponte, che ivi congiunge le due rive, par che renda ancor più sensibile 
	all'occhio questa trasformazione, e segni il punto in cui il lago cessa, 
	e l'Adda rincomincia, per ripigliar poi nome di lago dove le rive, 
	allontanandosi di nuovo, lascian l'acqua distendersi e 
	rallentarsi in nuovi golfi e in nuovi seni.
Citazione; // Questa istruzione non deve avere alcuno spazio prima
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h4>Visualizzato nel Browser</h4>
<?php
$intestazione='Quel ramo del lago di Como, che volge a mezzogiorno, ';

// L' istruzione 'Citazione' non deve avere alcuno spazio dopo
$brano = <<<'Citazione'
	$intestazione tra due catene non interrotte di monti, tutto a seni e a golfi, 
	a seconda dello sporgere e del rientrare di quelli, vien, 
	quasi a un tratto, a ristringersi, e a prender corso e figura di fiume, 
	tra un promontorio a destra, e un'ampia costiera dall'altra parte; 
	e il ponte, che ivi congiunge le due rive, par che renda ancor più sensibile 
	all'occhio questa trasformazione, e segni il punto in cui il lago cessa, 
	e l'Adda rincomincia, per ripigliar poi nome di lago dove le rive, 
	allontanandosi di nuovo, lascian l'acqua distendersi e 
	rallentarsi in nuovi golfi e in nuovi seni.
Citazione;
// L' istruzione 'Citazione' non deve avere alcuno spazio prima

	echo "<pre>".$brano."</pre>";
?>

	<hr />
        
	<h2>Escape</h2>
	
	<h3>Escape di apici e doppi apici</h3>
	<p>Per utilizzare i caratteri speciali come virgolette (doppi apici) o apici, 
	nidificandoli, all'interno delle Costanti Letterali Stringa è necessario
	<b>utilizzare il carattere Backslash (\)</b>.</p>
	
	<p style="background-color:yellow;margin-top:10px;padding:5px;">il carattere 
	Backslash di Escape non è da utilizzare quando il carattere speciale contenuto nella 
	Costante Letterale è diverso da quello del suo contenitore.</p>
<?php 
$codice=<<<'CODICE'
// Usare il carattere Backslash di escape per inserire
// correttamente lo stesso carattere speciale
// all'interno di una Costante Letterale
$s = "Manzoni è l'autore de \"I promessi sposi\"";
$s = 'Manzoni è l\'autore de "I promessi sposi"';
// Il carattere di escape non si deve utilizzare
// quando si usa un carattere speciale
// diverso da quello utilizzato dal suo contenitore.
$s = "Manzoni è l'autore de 'I promessi sposi'";
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>NewLine \n</h3>
	<p>Inserendo questo metacarattere (\n) si va a capo nel codice, 
	questo comando non influisce nella formattazione nel Browser.</p> 
	
	<p style="background-color:yellow;margin-top:10px;padding:5px;">
	Per funzionare, il metacarattere (\n) è da racchiudere all'interno dei 
	doppi apici (virgolette).</p> 
<?php
$codice=<<<'CODICE'
// Per andare a capo nel codice, 
// inserire il metacarattere di newline (\n) 
// all'interno della Costante Letterale Stringa
// racchiusa SOLO tra DOPPI APICI
$s = "#1 - Manzoni è l'autore de 'I promessi sposi'\n";
$t = "{$s}#2 - Questa linea va alla riga successiva";
echo $t;
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<h3>Escape dei Caratteri Speciali</h3>
	<p>Per effettuare l'escape dei caratteri speciali, anteporre
	un backslash allo stesso. Nel caso di newline (\n) aggiungere un altro backslash (\\n). 
	<b>L'escape del backslash deve essere fatto, solo quando c'è ambiguità.</b></p>
	
	<h4>Elenco dei Metacaratteri</h4>
	<table>
		<tr><th style="width:200px;">Metacarattere</th><th style="width:200px;">escaped</th></tr>
		<tr><td>$</td><td>\$</td></tr>
		<tr><td>\</td><td>\\</td></tr>
                <tr><td>\n</td><td>\\n</td></tr>
		<tr><td>{</td><td>\{</td></tr>
		<tr><td>}</td><td>\}</td></tr>
		<tr><td>[</td><td>\[</td></tr>
		<tr><td>]</td><td>\]</td></tr>
	</table>

<?php 
$codice=<<<'CODICE'
// Escape del Backslash (\\) quando c'è Ambiguità
// diversamente l'Engine di PHP effettua il parsing
// del metacarattere NewLine \n andando a capo nello script
$file = "Posizione del file: C:\\novita\...";
// Nessuna Ambiguità NON EFFETTUARE ESCAPE
$file = "Posizione del file: C:\windows\...";
$s = "$ {ciao a} t[utt ]i";
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<p style="background-color:yellow;margin-top:10px;padding:5px;">
	Il singolo o doppio backslash \, si deve utilizzare solo per l'escape dei metacaratteri,
	solo quando c'è ambiguità.<br />
	Per esempio le coppie di caratteri \w, \s, \e non rappresentano alcun carattere speciale, quindi non si deve effettuare l'escape \\w, \\s, \\e.</p>

        <hr />
        
        <h2>Caratteri ASCII</h2>
        <p>&Egrave; possibile esprimere un qualsiasi simbolo, cifra o lettera 
        direttamente tramite il codice ASCII (8 bit, 0-255).</p>
        
        <h3>Esempio</h3>
        <p>Stampare il carattere tilde (~) [ALT+126 Base decimale]</p>
        <ul>
            <li>Formato Esadecimale: \x7e</li>
            <li>Formato Ottale: \176</li>
        </ul>
        
        <h4>Codice:</h4>
<?php 
$codice=<<<'CODICE'
$tilde_esadecimale = "\x7e";
$tilde_ottale = "\176";
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
	$nl = "<br />";
        $tilde_esadecimale = "\x7e";
        $tilde_ottale = "\176";
	
	echo '<pre>';
            echo "Tilde $tilde_esadecimale con valore Esadecimale$nl";
            echo "Tilde $tilde_ottale con valore Ottale";
	echo '</pre>';
	?>
</body>
</html>