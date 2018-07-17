<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 30 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 30</strong>
	</p>
	
	<h1>[30] Tutto sulle stringhe - parte 2 di 5</h1>
	
	<p>Argomenti di questa lezione:
		<ul>
                    <li>il comando <b>echo</b> in dettaglio;</li>
                    <li>il comando <b>print</b> ;</li>
                    <li>output formattato con <b>printf</b> - marcatori e modificatori (o specificatori);</li>
                    <li>cenni a <b>print_r</b> .</li>

		</ul>
	</p>
	
	<hr />
        
        <h2>echo</h2>
        <p><b>Il costrutto echo accetta un numero variabile di espressioni</b>, divise da virgole, solo se non si usa il costrutto con le parentesi tonde. 
        Nel caso di utilizzo del costrutto con parentesi tonde (simile al metodo in cui si invoca una funzione), l'engine di PHP (ZEND) 
        accetta solo un argomento - quindi per concatenare più espressioni, all'interno delle parentesi, usare il simbolo di concatenazione, il punto (.).</p>
        <p style="margin:10px 0px;">Di seguito, sono mostrati i vari metodi in cui è possibile <b>invocare il costrutto echo</b></p>
        <p style="background-color:yellow;margin-top:10px;padding:5px;">
            <b>echo NON RESTITUISCE alcun valore</b><br />
            echo, rispetto a print, restituisce un minimo vantaggio in termini di velocità.
        </p>
<?php
$codice=<<<'CODICE'
$nl = "<br />";

// CORRETTO -> Passare una sola espressione
echo "Ciao".$nl;

// CORRETTO -> Passare più espressioni con le virgole
echo "Ciao ", "a", "tutti", $nl;

// CORRETTO -> Usare echo come se fosse invocata una funzione
// E' possibile passare un solo argomento
// non usare le virgole ma solo punti di concatenzaione
echo ("Ciao".$nl);

$x = 4;
$y = 5;
echo $x + $y;

// ERRORE di Parsing
// in quanto usare le parentesi tonde, è equiparato a passare degli argomenti ad una funzione
// Echo con le parentesi tonde accetta un solo argomento
echo ("Ciao", " a ", "tutti");
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
	<hr />
        
        <h2>print</h2>
        <p style="margin:10px 0px;">print non è una funzione ma un costrutto che accetta un solo argomento - un'espressione -, diversamente da echo.
        &Egrave; possibile inviare più variabili / stringhe con il simbolo di concatenamento (punto .)</p>
        <p style="background-color:yellow;margin-top:10px;padding:5px;"><b>print RESTITUISCE IL VALORE (1).</b></p>
<?php
$codice=<<<'CODICE'
$nl = "<br />";

print "Ciao".$nl;
print ("Ciao".$nl);

$x = 4;
$y = 5;
print $x + $y;

// ERRORE -> non è possibile passare più espressioni, 
// usare le righe produce un errore di Parsing
print "Ciao", " a ", "tutti", $nl;
print ("Ciao", " a ", "tutti", $nl);

// RESTITUISCE 1
echo (print ("Ciao".$nl) );
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <hr />
        
        <h2>printf</h2>
        
        <p><b>PHP.net reference:</b> <a href="http://php.net/manual/en/function.printf.php" title="printf su php.net">http://php.net/manual/en/function.printf.php</a></p>
        <p style="margin:10px 0px;">Guardare anche le seguenti funzioni:</p>
        <ul>
            <li><a href="http://php.net/manual/en/function.print.php" title="print su php-net" target="_blank">print</a> - Output a string</li>
            <li><a href="http://php.net/manual/en/function.sprintf.php" title="sprintf() su php.net" target="_blank">sprintf()</a> - Return a formatted string</li>
            <li><a href="http://php.net/manual/en/function.vprintf.php" title="vprintf() su php.net" target="_blank">vprintf()</a> - Output a formatted string</li>
            <li><a href="http://php.net/manual/en/function.sscanf.php" title="sscanf() su php.net" target="_blank">sscanf()</a> - Parses input from a string according to a format</li>
            <li><a href="http://php.net/manual/en/function.fscanf.php" title="fscanf() su php.net" target="_blank">fscanf()</a> - Parses input from a file according to a format</li>
            <li><a href="http://php.net/manual/en/function.flush.php" title="flush() su php.net" target="_blank">flush()</a> - Flush system output buffer</li>
        </ul>
        
        <h3>Sintassi</h3>
        <pre>int printf ( string $format [, mixed $args [, mixed $... ]] )</pre>
        
        <p>La <b>funzione printf</b> prevede, come primo argomento, un stringa di formato: stringa da formattare con relativi marcatori che specificano, 
            nei punti in cui vengono inseriti, i valori da inserire prelevati dalle espressioni che seguono il primo argomento. 
            <b>Le espressioni sono tante quanti sono i marcatori definiti nella stringa di formato.</b> 
            <b>I marcatori possono essere preceduti da modificatori</b> di formato e/o allineamento.
        </p>
        <p style="margin:10px 0px;">Se la stringa di formato non include dei marcatori, l'espressione successiva può essere omessa. 
            In quest'ultimo caso viene stampata una semplice stringa. 
            Anche il <b>printf effettua l'interpolazione della variabili</b>.</p>
<?php
$codice=<<<'CODICE'
$nl = "<br />";

// Un marcatore e una espressione
printf ("stringa di formato con %marcatore", espressione);

// Più marcatori e espressioni
printf ("stringa di formato con primo %marcatore e un secondo %marcatore", espressione, espressione);

// Senza Marcatori e espressioni
printf ("stringa di formato");

// Interpolazione di variabili
printf ("stringa di formato $nl".$nl);
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <h3>Stringa di formato e marcatori</h3>
        <p>La stringa di formato contiene una parte fissa, compresa di variabili, che viene stampata così com'è e un marcatore (definito, anteceduto, con il simbolo di percentuale %).</p>
        
        <h4>Esempio</h4>
        <p>Stringa di formato con un marcatore ed espressione che contiene una costante floating point. &Egrave; possibile inserire un'espressione complessa che viene prima calcolata e poi
        inserita al posto del marcatore.</p>
<?php
$codice=<<<'CODICE'
$nl = "<br />";
    
printf ("Io mi chiamo %s %s$nl","Francesco","Tomei");
printf ("Io mi chiamo %s %s$nl","Tomei","Francesco");
printf ("Il valore approssimativo di pi greco è %f", 3.14); // %f > Floating Point
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        $nl = "<br />";
        echo '<pre>';
        printf ("Io mi chiamo %s %s$nl","Francesco","Tomei");
        printf ("Io mi chiamo %s %s$nl","Tomei","Francesco");
        printf ("Il valore approssimativo di pi greco è %f", 3.14);
        echo '</pre>';
        ?>
        
        <h3>Elenco dei marcatori accettati</h3>
        
        <ul>
            <li>% - a literal percent character. No argument is required.</li>
            <li>b - the argument is treated as an integer, and presented as a binary number.</li>
            <li>c - the argument is treated as an integer, and presented as the character with that ASCII value.</li>
            <li>d - the argument is treated as an integer, and presented as a (signed) decimal number.</li>
            <li>e - the argument is treated as scientific notation (e.g. 1.2e+2). The precision specifier stands for the number of digits after the decimal point since PHP 5.2.1. In earlier versions, it was taken as number of significant digits (one less).</li>
            <li>E - like %e but uses uppercase letter (e.g. 1.2E+2).</li>
            <li>f - the argument is treated as a float, and presented as a floating-point number (locale aware).</li>
            <li>F - the argument is treated as a float, and presented as a floating-point number (non-locale aware). Available since PHP 4.3.10 and PHP 5.0.3.</li>
            <li>g - shorter of %e and %f.</li>
            <li>G - shorter of %E and %f.</li>
            <li>o - the argument is treated as an integer, and presented as an octal number.</li>
            <li>s - the argument is treated as and presented as a string.</li>
            <li>u - the argument is treated as an integer, and presented as an unsigned decimal number.</li>
            <li>x - the argument is treated as an integer and presented as a hexadecimal number (with lowercase letters).</li>
            <li>X - the argument is treated as an integer and presented as a hexadecimal number (with uppercase letters).</li>
        </ul>

        <table style="width:100%;">
            <tr>
                <th>Type Handling</th>
                <th>Type Specifiers</th>
            </tr>
            <tr>
                <td>string</td>
                <td>s</td>
            </tr>
            <tr>
                <td>integer</td>
                <td>d, u, c, o, x, X, b</td>
            </tr>
            <tr>
                <td>double</td>
                <td>g, G, e, E, f, F</td>
            </tr>
        </table>

        <p style="background-color:yellow;margin-top:10px;padding:5px;">Warning: Attempting to use a combination of the string and width specifiers with character sets that 
            require more than one byte per character may result in unexpected results</p>        
        
        <h3>Aggiungere modificatori (specificatori)</h3>
        <p>Aggiungendo un modificatore di precisione, possiamo formattare il risultato sopra riportato come nel seguente codice.</p>
        
        <h4>Esempio</h4>
<?php
$codice=<<<'CODICE'
// Stampa un numero di tipo Floating Point 

// con 2 cifre dopo il punto decimale.
printf ("Il valore approssimativo di pi greco è %.2f", 3.14);

// con 8 cifre dopo il punto decimale
// Le prime 2 cifre sono 1 e 4
// le restanti 6 sono 0 (zeri).
printf ("Il valore approssimativo di pi greco è %.8f", 3.14);

// Stampare un valore con 12 cifre
// di cui 8 dopo il punto decimale
// saranno aggiunti 6 zeri dopo il 14
// e 1 ZERO prima di 3, in quanto ho indicato 0 (ZERO) come carattere di Padding
printf ("Il valore approssimativo di pi greco è %012.8f", 3.14);

// Carattere di Padding, diverso da 0 (ZERO)
// Indicare un carattere diverso da ZERO anteceduto dall'Apice
// Qui asterisco è il carattere di padding
printf ("Il valore approssimativo di pi greco è %'*12.8f", 3.14);

// Forzare la stampa del simbolo più + anche per i Numeri Positivi
printf ("Il valore approssimativo di pi greco è %+12.8f", 3.14);

// Formattare in Binario il Numero Intero passato
printf ("Il Binario di 12 è %b", 12);

// Formattare in Charset (Tabella ASCII) il Numero Intero passato (100 = d)
printf ("Il Charset ASCII di 100 è %c", 100);

// Formattare Numero con Notazione Esponenziale
// 10 elevato alla 9 ( 1 per e+9 )
printf ("Notazione esponenziale di 1.000.000.000 è %e", 1000000000);

// e-9 corrisponde a Formattare Numero dividendo per un miliardo
printf ("Divide il numero per 1.000.000.000 %e-9", 1000000000);

// Formattare in Esadecimale il Numero Intero passato
printf ("Esadecimale di 41 è %x", 41);
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
echo '<pre>';
    $nl = "<br />";
    
    echo "Stampa un numero di tipo Floating Point$nl$nl"; 

    echo "// con 2 cifre dopo il punto decimale$nl";
    printf ("Il valore approssimativo di pi greco è %.2f$nl$nl", 3.14);

    echo "// con 8 cifre dopo il punto decimale
// le prime 2 cifre sono 1 e 4
// le restanti 6 sono 0 (zeri).$nl";
    printf ("Il valore approssimativo di pi greco è %.8f$nl$nl", 3.14);

    echo "// Stampare un valore con 12 cifre
// di cui 8 dopo il punto decimale
// saranno aggiunti 6 zeri dopo il 14
// e 1 ZERO prima di 3, in quanto ho indicato 0 (ZERO) come carattere di Padding$nl";
    printf ("Il valore approssimativo di pi greco è %012.8f$nl$nl", 3.14);

    echo "// Carattere di Padding, diverso da 0 (ZERO)
// Indicare un carattere diverso da ZERO anteceduto dall'Apice
// Qui asterisco è il carattere di padding$nl";
    printf ("Il valore approssimativo di pi greco è %'*12.8f$nl$nl", 3.14);
    
    echo "// Forzare la stampa del simbolo più + anche per i Numeri Positivi$nl";
    printf ("Il valore approssimativo di pi greco è %+12.8f", 3.14);
    
    echo "// Formattare la stringa convertendo in Binario il Numero Intero passato$nl";
    printf ("Il Binario di 12 è %b$nl$nl", 12);
    
    echo "// Formattare in Charset (Tabella ASCII) il Numero Intero passato (100 = d)$nl";
    printf ("Il Charset ASCII di 100 è %c$nl$nl", 100);
    
    echo "// Formattare Numero con Notazione Esponenziale$nl";
    echo "// 10 elevato alla 9$nl";
    printf ("Notazione esponenziale di 1.000.000.000 è %e$nl$nl", 1000000000);

    echo "// e-9 corrisponde dividere per un miliardo$nl";
    printf ("Divide il numero per 1.000.000.000 %e-9$nl$nl", 1000000000);

    echo "// Formattare in Esadecimale il Numero Intero passato$nl";
    printf ("Esadecimale di 41 è %x", 41);
echo '</pre>';    
?>
    <p style="background-color:yellow;margin-top:10px;padding:5px;">Usando il modificatore (o specificatore) in versione Maiuscola si ha un risultato diverso, 
    per approfondire vedere la guida ufficiale di PHP.net</p>
    
    <hr />
    
    <h2>print_r</h2>
    <p>Il costrutto print_r serve a stampare ARRAY e OGGETTI (Istanze delle Classi).</p>
<?php
$codice=<<<'CODICE'
// Piccolo Esempio che Stampa un Array Formattato
$elenco = array("Rossi", "Verdi", "Bianchi");
print_r($elenco);
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";

        // Visualizzato nel Browser
        $elenco = array("Rossi", "Verdi", "Bianchi");
        echo '<pre>';
        print_r($elenco);
        echo '</pre>'
?>
</body>
</html>