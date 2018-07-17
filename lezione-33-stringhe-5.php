<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 33 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	ol,ul{line-height:1.5em;}
	
        h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;}
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
        
        .celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
        .esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
</style>
</head>

<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 33</strong>
	</p>
	
	<h1>[33] Tutto sulle stringhe - parte 5 di 5</h1>
	
        <h2>Componiamo e Decomponiamo Stringhe</h2>
        <ul>
            <li><a href="#str_repeat" title="str_repeat()">str_repeat()</a> - pattern ripetuti;</li>
            <li><a href="#str_pad" title="str_pad()">str_pad()</a> - padding;</li>
            <li><a href="#explode" title="explode()">explode()</a> ed <a href="#implode" title="implode()">implode()</a> - split e join;</li>
            <li><a href="#strtok" title="strtok()">strtok()</a> - consumare una stringa a frammenti (token): strtok;</li>
            <li><a href="#parse_url" title="parse_url()">parse_url()</a> - decomporre una URL;</li>
            <li><a href="#strip_tags" title="strip_tags()">strip_tags()</a> - filtrare tutti gli elementi HTML da una stringa;</li>
            <li><a href="#get_meta_tags" title="get_meta_tags()">get_meta_tags()</a> - estrarre le informazioni 'meta' da una URL;</li>
            <li><a href="#utf8_encode" title="utf8_encode()">utf8_encode()</a> - Codifica una stringa da ISO-8859-1 a UTF-8;</li>
            <li><a href="#utf8_decode" title="utf8_decode()">utf8_decode()</a> - Converte una stringa con caratteri ISO-8859-1 codificati con UTF-8 in formato ISO-8859-1 singolo byte;</li>
        </ul>

	<hr />
        
        <h2 id="str_repeat">str_repeat()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.str-repeat.php" title="str_repeat()" target="_blank">http://php.net/manual/en/function.str-repeat.php</a></p>
        <p style="margin:10px 0px;">La funzione <b>str_repeat()</b> crea una stringa formata da un pattern ripetuto per un certo numero di volte.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>string str_repeat ( string $input , int $multiplier )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>input</b> il pattern (stringa) da ripetere;</li>
            <li><b>multiplier</b> indica quante volte il pattern deve essere ripetuto;</li>
        </ol>
        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">Il <b>moltiplicatore</b> deve essere più grande o uguale a 0 [ZERO].<br />
            Se il <b>moltiplicatore è settato a 0</b>, la funzione restituisce una stringa di tipo <b>empty</b>.</p>
        
        <h3 class="esempio">Esempio 1</h3>
        <p>Stampa il segno meno ( - ) ripetendolo 80 volte.</p>
        <h4>Codice</h4>
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
$nl = "<br />";
       
// Stampa 80 volte il segno meno ( - )
echo str_repeat("-",80);
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
        echo "<pre>".str_repeat("-",80)."</pre>";
?>
        
        <h3 class="esempio">Esempio 2</h3>
        <p>Stampa una Tabella composta da 10 righe x 5 colonne.</p>
        <h4>Codice</h4>
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
// Crea una tabella formata da 4 colonne e 10 righe
// usando l'interpolazione delle variabili
$celle = str_repeat("<td> cella </td>",5);
echo '<table>'.str_repeat("<tr>$celle</tr>",10).'</table>';
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
        $celle = str_repeat("<td> cella </td>\n",5);
        echo "<pre>\n<table>\n".str_repeat("<tr>$celle</tr>\n",10)."</table>\n</pre>\n";
?>
        <h2>Altri Riferimenti di PHP.net</h2>
        <ul>
            <li>ciclo <a href="http://php.net/manual/en/control-structures.for.php" title="ciclo for" target="_blank">for</a></li>
            <li><a href="http://php.net/manual/en/function.str-pad.php" title="str_pad()" target="_blank">str_pad()</a> - Pad a string to a certain length with another string</li>
            <li><a href="http://php.net/manual/en/function.substr-count.php" title="substr_count()" target="_blank">substr_count()</a> - Count the number of substring occurrences</li>
        </ul>
        
        <hr />
        
        <h2 id="str_pad">str_pad()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.str-pad.php" title="str_repeat()" target="_blank">http://php.net/manual/en/function.str-pad.php</a></p>
        <p>La funzione <b>str_pad()</b> restuituisce una stringa con il padding (caratteri riempitivo) di spazi, e opzionali, caratteri o stringhe a sinistra, destra o entrambi.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>string str_pad ( string $input , int $pad_length [, string $pad_string = " " [, int $pad_type = STR_PAD_RIGHT ]] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>input</b> stringa;</li>
            <li><b>pad_length</b> numero di ripetizioni del pattern, il padding comprende la lunghezza della stringa;</li>
            <li><b>pad_string</b> [opzionale] il carattere di padding (riempitivo), di <b>default è una stringa vuota (singolo spazio)</b></li>
            <li><b>pad_type</b> [opzionale] Indica dove effettuare il padding di pad_string <b>STR_PAD_RIGHT</b>, <b>STR_PAD_LEFT</b> o <b>STR_PAD_BOTH</b>.<br />
                Nel caso in cui non venga indicato, il <b>valore di default è STR_PAD_RIGHT</b>.</li>
        </ol>
        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">Nel caso in cui <b>pad_length</b> sia negativo, inferiore o uguale alla lunghezza della stringa <b>input</b> 
            sarà restituita una <b>stringa senza padding</b></p>
        
        <h3 class="esempio">Esempio 1</h3>
        <p>Padding di 3 variabili contenenti numeri (integer) con padding a sinistra STR_PAD_LEFT.</p>
        <h4>Codice</h4>
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
$nl = "<br />";
    
$a = 123;
$b = 494822;
$c = 7;

echo $a.$nl;
echo $b.$nl;
echo $c.$nl.$nl.$nl;

echo str_pad($a, 10, "0", STR_PAD_LEFT).$nl;
echo str_pad($b, 10, "0", STR_PAD_LEFT).$nl;
echo str_pad($b, 4, "0", STR_PAD_LEFT).$nl;
echo str_pad($c, 10, "0", STR_PAD_LEFT).$nl;
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$nl = "<br />";
    
$a = 123;
$b = 494822;
$c = 7;

echo "<pre>";

echo $a.$nl;
echo $b.$nl;
echo $c.$nl.$nl;

echo "\$a PADDING 10 > ".str_pad($a, 10, "0", STR_PAD_LEFT).$nl;
echo "\$b PADDING 10 > ".str_pad($b, 10, "0", STR_PAD_LEFT).$nl;
echo "\$b PADDING 4 > ".str_pad($b, 4, "0", STR_PAD_LEFT)." // Padding inferiore alla lunghezza della stringa, restituisce stringa intera$nl";
echo "\$c PADDING 10 > ".str_pad($c, 10, "0", STR_PAD_LEFT).$nl;

echo "</pre>";
?>
        
        <hr />
    
        <h2 id="explode">explode()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.explode.php" title="explode()" target="_blank">http://php.net/manual/en/function.explode.php</a></p>
        <p>La funzione <b>explode()</b> restuituisce un array di stringhe ognuna delle quali è una sottostringa formata dall'esplosione della stringa effettuato dal delimitatore.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>array explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>delimiter</b> - il segno che delimita l'esplosione della stringa;</li>
            <li><b>string</b> - la stringa da cui ricavare l'array;</li>
            <li><b>limit</b> [opzionale] se indicato e rappresenta un numero positivo, restituirà un array di stringhe con l'ultimo elemento che conteine 
                tutto il resto della stringa.</li>
        </ol>
        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">Explode, a differenza di implode, non accetta i primi due argomenti in ordine arbitrario: 
        Inserire, nel modo corretto, prima il segno di delimitazione seguito dalla stringa da cui ricavare l'array.</p>
        
        <h3 class="esempio">Esempio 1</h3>
        <p>&Egrave; possibile creare un array di stringhe splittando la virgola (o punto e virgola), il classico segno di divisione usato per separare i campi 
            di un file CSV (Comma Separated Values).</p>
        
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$nl = "<br />";
       
$cliente = "Rossi, Mario, Via Trento 15, 23042, Vattelapesca";
$arrCliente = explode(",", $cliente);

echo $arrCliente[0].$nl; // Cognome
echo $arrCliente[1].$nl; // Nome
echo $arrCliente[2].$nl; // Via
echo $arrCliente[3].$nl; // CAP
echo $arrCliente[4].$nl.$nl;; // Località

print_r($arrCliente);
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
    $nl = "<br />";

    $cliente = "Rossi, Mario, Via Trento 15, 23042, Vattelapesca";
    $arrCliente = explode(",", $cliente);

    echo "<pre>";
    echo $arrCliente[0].$nl;
    echo $arrCliente[1].$nl;
    echo $arrCliente[2].$nl;
    echo $arrCliente[3].$nl;
    echo $arrCliente[4].$nl.$nl;
    
    print_r($arrCliente);
    echo "</pre>";
?>
        <hr />
    
        <h2 id="implode">implode()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.implode.php" title="implode()" target="_blank">http://php.net/manual/en/function.implode.php</a></p>
        <p>La funzione <b>implode()</b> crea una stringa incollando (glue) tutti gli elementi di un array, nell'ordine che lo compongono.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>string implode ( string $glue , array $pieces )</pre>
        <pre>string implode ( array $pieces )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>glue</b> - il segno che delimita l'unione degli array nella stringa, se omesso utilizza una stringa vuota (singolo spazio);</li>
            <li><b>pieces</b> - la stringa da cui ricavare l'array;</li>
        </ol>
        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">Con implode, a differenza di explode, è possibile invertire l'ordine di glue e pieces.<br />
            Per mantenere una compatibilità sintattica con la funzione explode(), è consigliabile mantenere l'ordine corretto indicando come primo elemento glue seguito da pieces.</p>
        
        <h3 class="esempio">Esempio 1</h3>
        <p>&Egrave; possibile creare una stringa unendo tutti gli elementi dell'array usando come delimitatore la virgola (o punto e virgola), 
            il classico segno di divisione usato per separare i campi di un file CSV (Comma Separated Values).</p>
        
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$nl = "<br />";

$arrCliente[0] = "Rossi";
$arrCliente[0] = "Mario";
$arrCliente[0] = "Via Trento 15";
$arrCliente[0] = "23042";
$arrCliente[0] = "Vattelapescaè";

// Crea una stringa, unendo tutti gli elementi dell'array delimitati dal carattere di PIPE ( | )
$strCliente = implode("|", $arrCliente);

print_r($arrCliente);
echo $nl.$nl;
echo $strCliente;
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
    $nl = "<br />";

    $arrCliente[0] = "Rossi";
    $arrCliente[1] = "Mario";
    $arrCliente[2] = "Via Trento 15";
    $arrCliente[3] = "23042";
    $arrCliente[4] = "Vattelapescaè";
    
    // Crea una stringa, unendo tutti gli elementi dell'array delimitati dal carattere di PIPE ( | )
    $strCliente = "Stringa Creata dall'unione degli elementi dell'array:$nl<b>".implode("|", $arrCliente)."</b>";

    echo "<pre>";
    print_r($arrCliente);
    echo $nl;
    echo $strCliente;
    echo "</pre>";
?>
        <h3 class="esempio">Esempio 2</h3>
        <p>Usare un solo comando che sfrutta la composizione di istruzioni. Crea prima l'Array con explode e poi crea la stringa unendo gli elementi che lo compongono 
        separati dal punto e virgola.</p>
       
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$nl = "<br />";

$cliente = "Rossi, Mario, Via Trento 15, 23042, Vattelapescà";
echo implode(";", explode(",", $cliente)).$nl;
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        $nl = "<br />";

        $cliente = "Rossi, Mario, Via Trento 15, 23042, Vattelapesca";
        echo "<pre>".implode(";", explode(",", $cliente))."</pre>";
        ?>
        
        <h2 id="strtok">strtok()</h2>
        <p style="margin-bottom: 10px;">PHP.net Reference <a href="http://php.net/manual/en/function.strtok.php" title="implode()" target="_blank">http://php.net/manual/en/function.strtok.php</a></p>
        <p>La funzione <b>strtok()</b> abbreviazione di token (gettone), permette di restituire una parte di stringa fino al carattere separatore ogni volta che viene invocato.</p>
        <p style="margin:10px 0px;">La Stringa da morsicare, Primo Argomento, è da indicare solo alla prima invocazione o quando si vuole iniziare nuovamente a moriscare dall'inizio la stringa - esempio 2.</p>
        <p>Invocando la funzione con il solo token e assegnando il valore ad una variabile diversa il token continuerà dall'ultimo morso - vedere esempio 2.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>string strtok ( string $str , string $token )</pre>
        <pre>string strtok ( string $token )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>str</b> - la stringa da morsicare, da chiamare solo per la prima invocazione della funzione;</li>
            <li><b>token</b> - il delimitatore, da richiamare da solo successivamente alla primva invocazione della funzione;</li>
        </ol>
        
        <h3 class="esempio">Esempio 1</h3>
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
<?php
$nl = "<br />";

$prova = ("Questa è una prova per il token.");
// Usare una stringa vuota per morsicare (tokenize) la stringa
echo "1 > ".strtok($prova, ' ').$nl;
echo "2 > ".strtok(' ').$nl;
echo "3 > ".strtok(' ').$nl;
echo "4 > ".strtok(' ').$nl;
echo "5 > ".strtok(' ').$nl;
echo "6 > ".strtok(' ').$nl;
echo "7 > ".strtok(' ').$nl;
?>
CODICE;
        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$nl = "<br />";

$prova = ("Questa è una prova per il token.");
// Usare una stringa vuota per morsicare (tokenize) la stringa

echo "<pre>";
echo "1 > ".strtok($prova, ' ').$nl;
echo "2 > ".strtok(' ').$nl;
echo "3 > ".strtok(' ').$nl;
echo "4 > ".strtok(' ').$nl;
echo "5 > ".strtok(' ').$nl;
echo "6 > ".strtok(' ').$nl;
echo "7 > ".strtok(' ').$nl;
echo "</pre>";
?>
        
        <h3 class="esempio">Esempio 2</h3>
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
<?php
$nl = "<br />";

$prova = ("Questa è una prova per il token.");
// Usare una stringa vuota per morsicare (tokenize) la stringa
$stringa1 = strtok($prova, ' ');
echo "1 > ".$stringa1.$nl;
echo "2 > ".strtok(' ').$nl;
echo "3 > ".strtok(' ').$nl;

echo "4 > ".strtok($prova, ' ').$nl;
echo "5 > ".strtok(' ').$nl;
echo "6 > ".strtok(' ').$nl;
echo "7 > ".strtok(' ').$nl;

// Memorizza la parte moriscata, continuando anche assegnando il token ad una stringa diversa
$stringa2 = strtok(' '); 
echo "8 > ".$stringa2.$nl;
echo "9 > ".strtok(' ').$nl;
echo "10 > ".strtok(' ').$nl;
?>
CODICE;
        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$nl = "<br />";

$prova = ("Questa è una prova per il token.");
// Usare una stringa vuota per morsicare (tokenize) la stringa

echo "<pre>";
$stringa1 = strtok($prova, ' ');
echo "1 > ".$stringa1.$nl;
echo "2 > ".strtok(' ').$nl;
echo "3 > ".strtok(' ').$nl.$nl;

echo "4 > ".strtok($prova, ' ').$nl;
echo "5 > ".strtok(' ').$nl;
echo "6 > ".strtok(' ').$nl;
echo "7 > ".strtok(' ').$nl.$nl;

$stringa2 = strtok(' ');
echo "8 > ".$stringa2.$nl;
echo "9 > ".strtok(' ').$nl;
echo "10 > ".strtok(' ').$nl;
echo "</pre>";
?>
        
        <h3 class="esempio">Esempio 3</h3>
        <p>Da PHP4 .1.0. il comportamento quando viene trovata una parte empty è cambiato. Il vecchio comportamento restituiva una stringa vuota (empty string), 
            il nuovo, in modo corretto, semplicemente salta la parte della stringa.</p>
        
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$first_token  = strtok('/something', '/');
$second_token = strtok('/');
var_dump($first_token, $second_token);
CODICE;
        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <p><b>Vecchio Comportamento:</b> Restituisce stringa vuota alla prima invocazione perché trova subito alla prima posizione il token</p>
<?php
$codice=<<<'CODICE'
string(0) ""
string(9) "something"
CODICE;

        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <p><b>Nuovo Comportamento</b> Salta la parte della stringa, quando incontra una parte vuota.</p>
        <?php
        $first_token  = strtok('/something', '/');
        $second_token = strtok('/');
        echo "<pre>";
        var_dump($first_token, $second_token);
        echo "</pre>";
        ?>
        
        <h3 class="esempio">Esempio 4</h3>
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$nl = "<br />";
$cliente = "Rossi, Mario, Via Trento 15, 23042, Vattelapescà";

$frammento = strtok($cliente, ",");
while ($frammento!==false)
    {
        echo $frammento.$nl;
        $frammento = strtok(",");
    }
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        $nl = "<br />";
        $cliente = "Rossi, Mario, Via Trento 15, 23042, Vattelapescà";

        $frammento = strtok($cliente, ",");
        echo "<pre>";
        while ($frammento!==false)
            {
                echo $frammento.$nl;
                $frammento = strtok(",");
            }
        echo "</pre>";
        ?>
        
        <hr />
        
        <h2 id="parse_url">parse_url()</h2>
        <p style="margin-bottom: 10px;">PHP.net Reference (URLs / URL Functions) 
            <a href="http://php.net/manual/en/function.parse-url.php" title="parse_url()" target="_blank">http://php.net/manual/en/function.parse-url.php</a></p>
        <p>La funzione <b>parse_url()</b> effettua il Parsing dell' URL e restituisce un Array di Elementi contenente tutti i componenti che contengono l' URL stessa.</p>
        <p style="margin:10px 0px;">This function is not meant to validate the given URL, it only breaks it up into the above listed parts. Partial URLs are also accepted, 
            parse_url() tries its best to parse them correctly.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>mixed parse_url ( string $url [, int $component = -1 ] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>url</b> - URL sulla quale effettuare il Parsign, caratteri non validi saranno sostituiti con underscore ( _ );</li>
            <li><b>component</b> - [opzionale] <b>DEFAULT restituisce un Array Associativo</b> con le chiavi relative alle componenti presenti nell'URL.<br />
                <b>Specificando il secondo argomento 'component'</b> PHP_URL_SCHEME, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_USER, PHP_URL_PASS, PHP_URL_PATH, PHP_URL_QUERY or 
                PHP_URL_FRAGMENT <b>viene restituita una variabile stringa con lo specifico componente indicato</b> 
                (solo quando viene indicato PHP_URL_PORT, la funzione resituisce un valore intero - integer).</li>
        </ol>
        
        <h3 class="celeste">Valore di ritorno</h3>
        <p>On seriously malformed URLs, parse_url() may return FALSE.</p>
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">If the component parameter is omitted, an associative array is returned. 
            At least one element will be present within the array.</p>
        
        <p>Potential keys within this array are:</p>
        <ul>
            <li>scheme - e.g. http</li>
            <li>host</li>
            <li>port</li>
            <li>user</li>
            <li>pass</li>
            <li>path</li>
            <li>query - after the question mark ?</li>
            <li>fragment - after the hashmark #</li>
        </ul>
        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">If the component parameter is specified, parse_url() returns a string (or an integer, in the case of PHP_URL_PORT) instead of an array. 
            If the requested component doesn't exist within the given URL, NULL will be returned.</p>

        <h3 class="celeste">Changelog</h3>
        <ul>
            <li><p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>PHP 5.4.7</b> Fixed host recognition when scheme is omitted and 
                    a leading component separator is present.</p></li>
            <li><p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>PHP 5.3.3</b> Removed the E_WARNING that was emitted when URL parsing failed.</p></li>
            <li><p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>PHP 5.1.2</b> Added the component parameter.</p></li>
        </ul>
        
        <h3 class="celeste">Note</h3>
        <p style="color:white;background-color:red;margin:10px 0px;padding:5px;">Questa funzione non funziona con URLs relativi.</p>
        <p style="color:white;background-color:red;margin:10px 0px;padding:5px;">This function is intended specifically for the purpose of parsing URLs and not URIs. 
            However, to comply with PHP's backwards compatibility requirements it makes an exception for the file:// scheme where triple slashes (file:///...) are allowed. For any other scheme this is invalid.</p>
        
        <h3 class="esempio">Esempio 1</h3>
        <p>Se non viene specificato il secondo argomento, la funzione restituisce un Array Associativo.</p>
        
        <h4>Codice</h4>
<?php
$codice = <<<'CODICE'
$arrURL = parse_url('http://www.mobilinolimit.it/blog/idee-di-arredo/arredare-la-camera-da-letto-shabby-chic.html');
print_r ($arr_URL);
CODICE;

        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        // Se non viene specificato il secondo argomento, 
        // la funzione restituisce un Array Associativo
        $arrURL = parse_url('http://www.mobilinolimit.it/blog/idee-di-arredo/arredare-la-camera-da-letto-shabby-chic.html');
        
        echo '<pre>';
        print_r ($arrURL);
        echo '</pre>';
        ?>
        
        <h3 class="esempio">Esempio 2</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
$url = 'http://username:password@hostname:9090/path?arg=value#anchor';

var_dump(parse_url($url));
var_dump(parse_url($url, PHP_URL_SCHEME));
var_dump(parse_url($url, PHP_URL_USER));
var_dump(parse_url($url, PHP_URL_PASS));
var_dump(parse_url($url, PHP_URL_HOST));
var_dump(parse_url($url, PHP_URL_PORT));
var_dump(parse_url($url, PHP_URL_PATH));
var_dump(parse_url($url, PHP_URL_QUERY));
var_dump(parse_url($url, PHP_URL_FRAGMENT));
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>

        <h4>Visualizzato nel Browser</h4>
<?php
$nl = '<br />';
$url = 'http://username:password@hostname:9090/path?arg=value#anchor';

echo '<pre>';
echo '<b>var_dump(parse_url($url)); > restituisce:</b>',$nl;
var_dump(parse_url($url));

echo $nl,'<b>parse_url con 2° Argomento > restituisce:</b>',$nl;
var_dump(parse_url($url, PHP_URL_SCHEME));
var_dump(parse_url($url, PHP_URL_USER));
var_dump(parse_url($url, PHP_URL_PASS));
var_dump(parse_url($url, PHP_URL_HOST));
var_dump(parse_url($url, PHP_URL_PORT));
var_dump(parse_url($url, PHP_URL_PATH));
var_dump(parse_url($url, PHP_URL_QUERY));
var_dump(parse_url($url, PHP_URL_FRAGMENT));
echo '</pre>';
?>
        
        <h3 class="esempio">Esempio 3</h3>
        <p>example with missing scheme:</p>

        <h4>Codice</h4>
<?php
$codice = <<<'CODICE'
$url = '//www.example.com/path?googleguy=googley';

// Prior to 5.4.7 this would show the path as "//www.example.com/path"
var_dump(parse_url($url));
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$url = '//www.example.com/path?googleguy=googley';

echo '<pre>';
var_dump(parse_url($url));
echo '</pre>';
?>
        
        <hr />

        <h2 id="strip_tags">strip_tags()</h2>
        <p style="margin-bottom: 10px;">PHP.net Reference (Strings / String Functions) 
            <a href="http://php.net/manual/en/function.strip-tags.php" title="strip_tags()" target="_blank">http://php.net/manual/en/function.strip-tags.php</a></p>
        <p>La funzione <b>strip_tags()</b> cerca di eliminare tutti i NULL Bytes, PHP e HTML TAGs da una stringa (elimina le coppie attributo - proprietà).</p>
        <p style="margin:10px 0px;">This function tries to return a string with all NULL bytes, HTML and PHP tags stripped from a given str. 
            It uses the same tag stripping state machine as the <a href="http://php.net/manual/en/function.fgetss.php" title="fgetss()" target="_blank">fgetss</a> function.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>string strip_tags ( string $str [, string $allowable_tags ] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>str</b> - Il percorso del file HTML, può essere un percorso locale o URL;</li>
            <li><b>allowable_tags</b> - [opzionale] <b>DEFAULT elimina TUTTI i TAGs</b>. Con il secondo parametro è possibile <b>indicare quali TAGs non devono essere eliminati</b>.</li>
        </ol>
        
        <h3 class="celeste">Note</h3>        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>i commenti HTML e PHP vengono sempre eliminati</b> anche nel caso in cui vengano indicati in 'allowable_tags'.</p>
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">In PHP 5.3.4 and later, self-closing XHTML tags are ignored and only non-self-closing tags 
            should be used in allowable_tags.<br /><br/>Per esempio, permetti entrambi <b>&lt;br&gt;</b> e <b>&lt;br/&gt;</b>, devi usare:</p>
<?php
$codice=<<<'CODICE'
strip_tags($input, '<br>');
CODICE;

echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <h3 class="celeste">Valore Restituito</h3>
        <p>Restituisce una stringa spogliata di TAGs.</p>
        
        <h3 class="celeste">Changelog</h3>
        <ul>
            <li><p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>PHP 5.3.4</b> - <b>strip_tags()</b> ignores self-closing XHTML tags in <b>allowable_tags</b>.</p></li>
            <li><p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>PHP 5.0.0</b> - <b>strip_tags()</b> is now binary safe.</p></li>
        </ul>
        
        <h3 class="esempio">Esempio 1</h3>
        
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$riga = <<< End
    <li id="ti-hat04"><a class="ti-gl" target="_top" 
    href="//www.impresasemplice.it/" 
    onclick="s_trackHeader('Telecom Italia: Tab Impresa Semplice');">
    Impresa Semplice</a></li>
End;
    
echo strip_tags($riga);
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$riga = <<< End
<li id="ti-hat04"><a class="ti-gl" target="_top" href="//www.impresasemplice.it/" onclick="s_trackHeader('Telecom Italia: Tab Impresa Semplice');">Impresa Semplice</a></li>
End;
echo "<pre>".strip_tags($riga)."</pre>";
?>

        <hr />

        <h2 id="get_meta_tags">get_meta_tags()</h2>
        <p style="margin-bottom: 10px;">PHP.net Reference (URLs / URL Functions) 
            <a href="http://php.net/manual/en/function.get-meta-tags.php" title="get_meta_tags()" target="_blank">http://php.net/manual/en/function.get-meta-tags.php</a></p>
        <p>La funzione <b>get_meta_tags()</b> crea un array di elementi in cui salva tutti i meta tag estratti da un file.</p>
        <p style="margin:10px 0px;">La Stringa da morsicare, Primo Argomento, è da indicare solo alla prima invocazione o quando si vuole iniziare nuovamente a moriscare dall'inizio la stringa - esempio 2.</p>
        <p>Invocando la funzione con il solo token e assegnando il valore ad una variabile diversa il token continuerà dall'ultimo morso - vedere esempio 2.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>array get_meta_tags ( string $filename [, bool $use_include_path = false ] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>filename</b> - Il percorso del file HTML, può essere un percorso locale o URL;</li>
            <li><b>use_include_path</b> - [opzionale] <b>DEFAULT FALSE</b>. Settando a TRUE, cercherà di aprire il file utilizzando lo standard dell'include path. 
                <b>TRUE, è usato per accedere ai file locali</b>.</li>
        </ol>
        
        <h3 class="celeste">Valore Restituito</h3>
        <p>Restituisce un Array di elementi, con il parsing, di tutti i Meta TAGs.</p>
        
        <h3 class="celeste">Note:</h3>        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>Le chiavi sono gli attributi</b> e <b>i valori le proprietà</b>. In questo modo è possibile recuperare 
            i valori, e l'array di elementi, con le funzioni Built-In di PHP.</p>
        <p style="background-color:yellow;margin:10px 0px;padding:5px;"><b>I caratteri speciali delle proprietà</b> contenute negli attributi HTML, nei relativi valori 
            vengono salvati e <b>sostituiti con il segno underscore ( _ )</b>, tutto <b>il resto viene convertito in minuscolo (lower case)</b>.</p>
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">Nel caso siano presenti nel file HTML, 2 o <b>più attributi con lo stesso Meta TAG, 
                viene salvato l'ultimo restituito</b>.</p>
        
        <h3 class="celeste">Guarda anche</h3>
        <ul>
            <li><a href="http://php.net/manual/en/function.htmlentities.php" title="htmlentities" target="_blank"><b>htmlentities()</b></a> - Convert all applicable characters to HTML entities;</li>
            <li><a href="http://php.net/manual/en/function.urlencode.php" title="urlencode" target="_blank"><b>urlencode()</b></a> - URL-encodes string;</li>
        </ul>
        
        <h3 class="esempio">Esempio 1</h3>
        
        <h4>Codice</h4>
<?php
$codice=<<<'CODICE'
$nl = "<br />";
    
$metaTags = get_meta_tags('http://www.mobilinolimit.it/blog/arredo-casa.html');
echo "Il Meta TAG <b>Keywords</b> contiene i seguenti valori: <b>{$metaTags['keywords']}</b>$nl$nl";

echo "Chiavi e Valori contenuti nell'Array risultato:$nl";
print_r $metaTags;
CODICE;

        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        $nl = "<br />";
        $metaTags = get_meta_tags('http://www.mobilinolimit.it/blog/arredo-casa.html');
        
        echo "<pre>";
        echo str_repeat("-", 50).$nl;
        echo "Il Meta TAG <b>Keywords</b> contiene i seguenti valori:$nl";
        echo str_repeat("-", 50).$nl;
        echo "<b>{$metaTags['keywords']}</b>$nl$nl";
        
        echo str_repeat("-", 50).$nl;
        echo "<b>Chiavi e Valori contenuti nell'Array restituito:</b>$nl";
        echo str_repeat("-", 50).$nl;
        print_r ($metaTags);
        
        echo $nl.str_repeat("-", 70).$nl;
        echo "<b>La funzione utf8_encode codifica una stringa ISO-8859-1 in UTF-8</b>$nl";
        echo str_repeat("-", 70).$nl;
        // utf8_encode — Codifica una stringa da ISO-8859-1 a UTF-8
        echo "\$metaTags['description'] > ".utf8_encode($metaTags['description']);
        echo "</pre>";
        ?>
        
        <hr />
        
        <h3 id="utf8_encode" class="celeste">utf8_encode</h3>
        <p style="margin-bottom: 10px;">PHP.net Reference (XML Parser / XML Parser Funzioni) 
            <a href="http://php.net/manual/it/function.utf8-encode.php" title="utf8_encode()" target="_blank">http://php.net/manual/it/function.utf8-encode.php</a></p>
        <p style="margin:10px 0px;"><b>utf8_encode</b> — Codifica una stringa da standard ISO-8859-1 a UTF-8</p>
        <p style="margin:10px 0px;">Questa funzione converte la stringa data al formato UTF-8, e restituisce la versione codificata. UTF-8 è il meccanismo standard utilizzato 
            da Unicode per la codifica dei valori wide character in un flusso di byte. La codifica UTF-8 è trasparente ai caratteri ASCII, è auto-sincronizzata 
            (per un programma è possibile determinare dove iniziano i caratteri in un flusso di dati) e può essere usata nelle normali funzioni di confronto di stringhe 
            per i sort e simili. Il PHP codifica i caratteri UTF-8 fino a quattro byte come segue:</p>
        
        <h4>Codifica UTF-8</h4>
        <table>
            <tr>
                <th>Byte</th>
                <th>Bit</th>
                <th>Rappresentazione</th>
            </tr>
            <tr>
                <td>1</td>
                <td>7</td>
                <td>0bbbbbbb</td>
            </tr>
            <tr>
                <td>2</td>
                <td>11</td>
                <td>110bbbbb 10bbbbbb</td>
            </tr>
            <tr>
                <td>3</td>
                <td>16</td>
                <td>1110bbbb 10bbbbbb 10bbbbbb</td>
            </tr>
            <tr>
                <td>4</td>
                <td>21</td>
                <td>11110bbb 10bbbbbb 10bbbbbb 10bbbbbb</td>
            </tr>
        </table>
        <p style="margin-top:10px;">Ciascuna b rappresenta un bit che può essere utilizzato per memorizzare le informazioni del carattere.</p>

        <hr />
        
        <h3 id="utf8_decode" class="celeste">utf8_decode</h3>
        <p style="margin-bottom: 10px;">PHP.net Reference (XML Parser / XML Parser Funzioni) 
            <a href="http://php.net/manual/it/function.utf8-encode.php" title="utf8_decode()" target="_blank">http://php.net/manual/it/function.utf8-encode.php</a></p>
        <p><b>utf8_decode</b> — Converte una stringa con caratteri ISO-8859-1 codificati con UTF-8 in formato ISO-8859-1 singolo byte</p>
</body>
</html>