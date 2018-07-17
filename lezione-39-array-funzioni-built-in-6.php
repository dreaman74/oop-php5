<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 39 - Array - Le Funzioni Built-in 2 di 4 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	ol,ul{line-height:1.5em;}
        li {line-height: 3em;}
	
        h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;}
        p {line-height: 1.5em;margin:0px;padding:0px;}
	
        pre, .codice {
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
        .codice {
            margin: 15px 0px;
        }
        
        
	table, th, td {border-collapse:collapse;padding:5px;}
	th {border: 1px solid red;text-align:center;}
	td {border: 1px solid grey;text-align:center;}
        
        .celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
        .esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
        
        form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
</style>
</head>

<?php
// Variabili comuni
$nl = '<br />';

// Funzioni Comuni
function stampa($array){
    $nl = '<br />';
    foreach($array as $key => $elemento)
            echo "$key => $elemento".$nl;
}
?>
<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 39</strong>
	</p>
	
	<h1>[39] Array (6 di 8) - Le funzioni Built-in 2 di 4</h1>
        <p>Impariamo ad estrarre o sostituire parti di array (anche associativi):</p>
        <ul>
            <li><p><a href="#array_slice" title="la funzione array_slice() built-in di PHP">array_slice()</a><br />
                    La funzione restituisce <strong>una copia di un Array</strong> composta da una sequenza di elementi estratti da un Array passato alla funzione stessa, 
                    <strong>preservando le chiavi associative</strong> ma riordinando gli indici numerici;</p></li>
            <li><p><a href="#array_splice" title="la funzione array_splice() built-in di PHP">array_splice()</a><br />
                    La funzione <strong>modifica la sequenza di elementi dell' Array</strong> passatto alla funzione, 
                    <strong>preservando le chiavi associative</strong> ma riordinando gli indici numerici;</p></li>
            <li><p><a href="#array_keys" title="la funzione array_keys() built-in di PHP">array_keys() - Restituisce un nuovo Array con Indice Numerico i cui elementi hanno il valore delle chiavi o degli indici dell'Array passato alla funzione stessa.</a>;</li>
            <li><p><a href="#array_key_exists" title="la funzione array_key_exists() built-in di PHP">array_key_exists()</a><br />
                    Cerca le chiavi associative o indici numerici all'interno di un Array;</p></li>
        </ul>
        
        <hr />
        
        <h2 id=array_slice">array_slice()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/en/function.array-slice.php" title="array_slice" target="_blank">array_slice()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>array_slice()</strong> ritorna una '<strong>n</strong>' sequenza di elementi estratti, da un Array passato alla funzione stessa, in un nuovo array; 
            le chiavi associative sono preservate ma gli indici numerici sono riodinati</p>.<br />
            Con il secondo argomento <strong>offset</strong>, obbligatorio, si indica la posizione dalla quale inziare il recupero degli elementi stessi.<br />
            &Egrave; anche possibile indicare il numero di elementi da estrarre, tramite il terzo argomento <strong>length</strong>, opzionale.
            
        <h3 class="celeste">Sintassi</h3>
<pre>
array array_slice ( array $array , int $offset [, int $length = NULL [, bool $preserve_keys = false ]] )
</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><strong>array</strong> (1° Argomento) - L'Array da cui estrarre gli elementi;</p></li>
            <li><p><strong>offset</strong> (2° Argomento) - Posizione dalla quale inziare l'estrazione degli elementi, accetta un tipo di dati INTEGER.<br />
                    Se <strong>offset è positivo</strong>, la posizione inziale per la sequenza di elementi da estrarre, il conteggio inzia dal primo elemento 0 [ZERO].<br />
                    Se <strong>offset è negativo</strong>, la posizione iniziale per la sequenza di elementi da estrarre, dal più basso al più alto, 
                    è data da LUNGHEZZA ARRAY meno OFFSET.</p></li>
            <li><p><strong>length</strong> (3° Argomento) - <strong>[OPZIONALE]</strong> Indica il numero di elementi da estrarre.<br />
                <strong>Default NULL</strong>, se non viene specificato, estrae tutti gli Elementi.<br />
                Se <strong>length è un INTEGER POSITIVO</strong>, saranno restituiti tanti elementi quanti quelli indicati.<br />
                Se il numero di elementi da estrarre è più basso di length, saranno restituiti solo gli elementi disponibili.<br />
                Se <strong>legth è un INTEGER NEGATIVO</strong> la posizione di partenza è data da offset sommato a length assoluto e l'estrazione degli elementi, dal più alto al più basso, 
                si ferma all'offset.</p></li>
            <li><p><strong>preserve_keys</strong> (4° Argomento) - <strong>[OPZIONALE]</strong><br />
                    Se non specificato, <strong>DEFAULT FALSE</strong>, il Comportamento di default, <strong>resetta e riordina gli indici numerici</strong>.<br />
                    Per modificare questo comportamento, evitando il Reset e il Reindex degli Indici Numerici, indicare TRUE.</p></li>
        </ul>

        <h3 class="celeste">Valore Restituito</h3>
        <p>Restituisce un <strong>Array tagliato</strong>. Se l'<strong>offset è più alto del numero di elementi presenti nell'Array</strong> da cui effettuare l'estrazione, 
            la funzione <strong>restituisce</strong> un Array Vuoto (<strong>Empty Array</strong>).</p>
        
        <h3 class="celeste">Changelog</h3>
        <ul>
            <li><p><strong>PHP 5.2.4</strong> - Il valore di default di length è NULL, questo indica alla funzione di estrarre tutti gli elementi dall'Array. Nelle versioni precedenti, 
                    NULL Length significava lunghezza zeo (niente era restituito).</p></li>
            <li><p><strong>PHP 5.0.2</strong> -  l'argomento <strong>preserve_keys</strong> è stato aggiunto.</p></li>
        </ul>
        
        <h3 class="esempio">Esempi da PHP.net</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
echo "// Dato un Array$nl";
echo '<b>$input = array("a", "b", "c", "d", "e");</b>',$nl,$nl;
$input = array("a", "b", "c", "d", "e");

// returns "c", "d", and "e"
echo '<b>// array_slice($input, 2)</b>',$nl;
print_r(array_slice($input, 2));

// returns "d", "e"
echo $nl,'<b>// array_slice($input, -2) - Parte da elemento 3 (5-2) ed estrae tutti gli elmenti</b>',$nl;
print_r(array_slice($input, -2));

// returns "d"
echo $nl,'<b>// array_slice($input, -2, 1) - Parte da elemento 3 (5-2) ed estrae un solo un elemento</b>',$nl;
print_r(array_slice($input, -2, 1));

// returns "a", "b", and "c"
echo $nl,'<b>// array_slice($input, 0, 3) - Parte da elemento 0 ed estrae 3 elementi</b>',$nl;
print_r(array_slice($input, 0, 3));

// eturns "c", "d"
echo $nl,'<b>// array_slice($input, 2, -1)',$nl,'// Parte da 4° elemento e si ferma al 3° ',$nl,'// Inizio INDICE 3 (n-1) (2 [offset] + 1 [lenght assoluto])', $nl, '// e si ferma all\'INDICE 2 [offset]</b>',$nl;
print_r(array_slice($input, 2, -1));

echo $nl,'<b>// array_slice($input, 2, -1, true))', $nl, '// NO RESET degli indici [preserve_keys = true]</b>',$nl;
print_r(array_slice($input, 2, -1, true));

echo $nl,'// Stampa Array tramite funzione stampa()',$nl;
echo '<b>stampa(array_slice($input, 2, -1, true))</b>',$nl;
stampa(array_slice($input, 2, -1, true));
?>
</pre>
        
        <hr />
        
        <h2 id=array_splice">array_splice()</h2>
        <p>Reference <a href="http://php.net/manual/en/function.array-splice.php" title="array_splice" target="_blank">array_splice()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>array_splice() modifica l'array originale</strong> eliminando, sostituendo o aggiungendo elementi.<br />
            Opzionalmente, è possibile indicare tramite l'argomento replacement un <strong>Array</strong> con uno o più elementi da aggiunere o sostituire.<br />
            <strong>La funzione preserva le chiavi associative ma riordina e resetta gli Indici Numerici dell' $input array.</strong><br />
            Aggiungendo un nuovo elemento con chiave associativa, questa non viene preservata diventando un indice numerico.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>array array_splice ( array &$input , int $offset [, int $length = 0 [, mixed $replacement = array() ]] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><strong>input</strong> - L'Array da modificare;</p></li>
            <li><p><strong>offset</strong> - <strong>Se è un numero positivo</strong> il conteggio dell'offset inizierà dall'inizio dell'Array, indice più basso, verso la fine.<br />
                    <strong>Se è un numero negativo</strong> il conteggio dell'offset inizierà dalla fine dell'Array, indice più alto, verso la fine.</p></li>
            <li><p><strong>length</strong> - <strong>[OPZIONALE]</strong> se omesso, rimuove tutti gli Array partendo dall'offset indicato verso la fine dell'Array, indice più alto.<br />
                    <strong>se è un numero positivo</strong>, saranno rimossi il numero di elementi indicati.<br />
                    <strong>se è un numero negativo</strong>, la posizione di partenza è data da offset sommato a length assoluto e l'estrazione degli elementi, 
                    dal più alto al più basso, si ferma all'offset.<br />
                    <strong>se è 0 [ZERO]</strong>, nessun elemento sarà rimosso.</p>
                <p style="background-color: yellow;margin:10px 0px 0px;padding: 5px;">Tip: <strong>Quando l'argomento di sostituzione [replacement]</strong> viene specificato, <strong>in length</strong> utilizzare
                            <strong>count($input)</strong> per eliminare, dall'offset alla fine, tutti gli elementi dall'Array da Modificare.</p>
            </li>
            <li><p><strong>replacement</strong> - <strong>[OPZIONALE]</strong> se viene specificato un Array di Sostituzione, gli elementi dell'Array da Modificare sono sostituiti 
                    con gli elementi dell'Array di sostituzione.<br />
                    <strong>se offset e lunghezza non indicano alcun elemento da rimuovere</strong>, gli elementi dell'Array di sostituzione saranno aggiunti, 
                    partendo dall'offset indicato.</p>
                <p style="background-color: yellow;margin:10px 0px;padding: 5px;">Nota: Le chiavi dell'Array di sostituzione [Replacement Array] non sono preservate!</p>
                <p style="background-color: yellow;padding: 5px;">Se replacement è un solo elemento non è necessario indicare un Array(), a meno che l'elemento stesso è
                    un Array(), un oggetto o NULL</p>
            </li>
        </ul>
        
        <h3 class="esempio">Esempio Vari</h3>
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$nl = '<br />';

// Array
$arrCliente = array('Rossi', 'Mario', 45, 'Via Verdi', 8, 22041, 'Canicattì');

// List()
list($cognome, $nome, $eta) = $arrCliente;
echo "$nome $cognome, $eta",$nl;

// ----- array_splice() -----

// Elimina solo il 3° elemento [eta]
array_splice($arrCliente,2, 1);
print_r($arrCliente);

// Elimina tutti gli elementi, dal 3° compreso in poi
array_splice($arrCliente,2);

// Sostituire il 3° elemento
array_splice($arrCliente,2,1,56);

// Aggiungere 2 elementi prima del 3° elemento [eta]
// Specificare Length 0
array_splice($arrCliente,2,0,array(34,56));
?>
CODICE;
    
echo "<pre>".htmlspecialchars($codice)."</pre>";
?>

        <h4>Visualizzazione nel Browser</h4>
<pre>
<?php
$nl = '<br />';

$arrCliente = array('Rossi', 'Mario', 45, 'Via Verdi', 8, 22041, 'Canicattì');
list($cognome, $nome, $eta) = $arrCliente;
echo '// list($cognome, $nome, $eta) = $arrCliente;',$nl;
echo '// echo "$nome $cognome, $eta";',$nl;
echo "$nome $cognome, $eta",$nl;

echo $nl,'// -----> Modifica Array originale e Resetta gli Indici Numerici <-----',$nl;
echo $nl,'// elimina solo il 3° elemento',$nl,'// array_splice($arrCliente, 2, 1);',$nl;
array_splice($arrCliente, 2, 1); // Elimina solo età
print_r($arrCliente);

// Ricostituisco l'Array
$arrCliente = array();
$arrCliente = array('Rossi', 'Mario', 45, 'Via Verdi', 8, 22041, 'Canicattì');

echo $nl,'// elimina tutti gli elementi, partendo dal 3° elemento compreso',$nl,'// array_splice($arrCliente, 2);',$nl;
array_splice($arrCliente, 2); // Elimina solo età
print_r($arrCliente);

// Ricostituisco l'Array
$arrCliente = array();
$arrCliente = array('Rossi', 'Mario', 45, 'Via Verdi', 8, 22041, 'Canicattì');

echo $nl,'// Sostituire solo il 3° elemento [eta] da 45 a 56',$nl,'array_splice($arrCliente,2,1,56);',$nl;
array_splice($arrCliente,2,1,56);
print_r($arrCliente);

// Ricostituisco l'Array
$arrCliente = array();
$arrCliente = array('Rossi', 'Mario', 45, 'Via Verdi', 8, 22041, 'Canicattì');

echo $nl,'// Sostituire il 3° elemento [eta] con 2 elementi 34 e 56',$nl,'array_splice($arrCliente,2,1,array(34,56));',$nl;
array_splice($arrCliente,2,1,array(34,56));
print_r($arrCliente);

// Ricostituisco l'Array
$arrCliente = array();
$arrCliente = array('Rossi', 'Mario', 45, 'Via Verdi', 8, 22041, 'Canicattì');

echo $nl,'// Aggiungere 2 elementi prima del 3° elemento [eta]',$nl,'array_splice($arrCliente,2,0,array(34,56));',$nl;
array_splice($arrCliente,2,0,array(34,56));
print_r($arrCliente);
?>
</pre>
        
        <hr />
        
        <h2 id="array_keys">array_keys()</h2>
        <p>Reference <a href="http://php.net/manual/en/function.array-keys.php" title="array_keys" target="_blank">array_keys()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>array_keys</strong> restituisce tutte le chiavi o un subset delle chiavi di un array. <strong>Il nuovo Array con Indice Numerico</strong>, 
            sarà composto da elementi contenenti il valore delle chiavi o degli indici dell'Array passato alla funzione stessa.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>array array_keys ( array $array [, mixed $search_value = null [, bool $strict = false ]] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><strong>array</strong> - L'Array con le chiavi e gli indici da restituire;</p></li>
            <li><p><strong>search_value</strong> - [OPZIONALE] Se specificato, restituisce solo le chiavi con i valori indicati con questo argomento;</p></li>
            <li><p><strong>strict</strong> - [OPZIONALE] Metodo di comparazione con cui viene effettuala la ricerca:</p>
                <ul>
                    <li><p><strong>false [Default]</strong>;</p></li>
                    <li><p><strong>true</strong> si effettua la ricerca in modalità <strong>strict (===)</strong>.</p></li>
                </ul>
            </li>
        </ul>

        <h3 class="esempio">Esempi FCamuso</h3>
        <p>Crea un nuovo Array ad Indice Numerico, i cui elementi contengono le chiavi associative dell'Array specificato alla funzione array_kesy().</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
// Array a chiavi associative
$arrCliente = array(
            'cognome' => 'Rossi',
            'nome' => 'Mario',
            'eta' => 45,
            'via' => 'Via Verdi',
            'civico' => '22041',
            'cap' => 22041,
            'comune' => 'Canicattì'
            );


$chiavi = array_keys($arrCliente);
print_r($chiavi);
?>
CODICE;

echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
// Array a chiavi associative
$arrCliente = array(
            'cognome' => 'Rossi',
            'nome' => 'Mario',
            'eta' => 45,
            'via' => 'Via Verdi',
            'civico' => '22041',
            'cap' => 22041,
            'comune' => 'Canicattì'
            );

echo '<b>// $chiavi = array_keys($arrCliente);</b>',$nl;
$chiavi = array_keys($arrCliente);
print_r($chiavi);
?>
</pre>
        
        <h3 class="esempio">Esempi di PHP.net</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$array = array(0 => 100, "color" => "red", 2=> 'Francesco', 'Tomei');
print_r(array_keys($array));

$array = array("blue", "red", "green", "blue", "blue");
print_r(array_keys($array, "blue"));

$array = array("color" => array("blue", "red", "green"),
               "size"  => array("small", "medium", "large"));
print_r(array_keys($array));
?>
CODICE;

echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$array = array();
$array = array(0 => 100, "color" => "red", 2=> "Francesco", "Tomei");
echo '<b>// array(0 => 100, "color" => "red", 2=> "Francesco", "Tomei");</b>',$nl;
echo '// Elementi contenuti nell\' Array',$nl;
print_r($array);
echo $nl,'<b>// array_keys($array);</b>',$nl;
print_r(array_keys($array));

$array = array();
$array = array("blue", "red", "green", "blue", "blue");
echo $nl,'<b>// array("blue", "red", "green", "blue", "blue");</b>',$nl;
echo $nl,'<b>// array_keys($array, "blue");</b>',$nl;
echo '// Restituisce solo gli indici degli elementi che contengono la parola \'blue\':',$nl;
print_r(array_keys($array, "blue"));

$array = array();
$array = array("color" => array("blue", "red", "green"),
               "size"  => array("small", "medium", "large"));
echo $nl,'<b>// $array = array("color" => array("blue", "red", "green"),
               "size"  => array("small", "medium", "large"));</b>',$nl;
echo '// Preleva le chiavi subset di un Array Multidimensionale',$nl;
print_r(array_keys($array));
?>
</pre>
        
        <h3 class="celeste">Sistema 32bit o 64 bit - Differenza dei Tipi di Dati restituiti</h4>
        
        <h4 class="esempio">Codice e Visualizzazione nel Browser</h4>
        
        <pre>
<?php 
$importantKeys = array('329462291595' =>null, 'ZZ291595' => null);
echo '<b>// $importantKeys = array(\'329462291595\' =>null, \'ZZ291595\' => null);</b>',$nl,$nl;

$codice = <<< 'CODICE'
<b>64 bits system, will return on a:</b>

    integer
    string

<b>32 bits system, will return on a:</b>

    string
    string
CODICE;
echo $codice,$nl;

echo $nl,$nl,'<b>// Su questo sistema l\'Array Creato ha gli indici con i seguenti tipi di dato :</b>',$nl,$nl;
echo '<b>// -----> Con ciclo foreach() e funzione gettype()</b>',$nl;
foreach(array_keys($importantKeys) as $key){
    echo gettype($key)."\n";
}

echo $nl,'<b>// -----> Con var_dump()</b>',$nl;
var_dump(array_keys($importantKeys));
?>
</pre>
        
        <h4 class="celeste">Approfondimenti: Get PHP Options and Information</h4>
        <p>Recupera le informazioni sull' Engine e Impostazioni di PHP: <a href="http://php.net/manual/en/book.info.php" title="PHP Option and Information">PHP Option and Information</a></p>

        <h2 id="array_key_exists">array_key_exists()</h2>
        <p>Reference <a href="http://php.net/manual/en/function.array-key-exists.php" title="array_key_exists" target="_blank">array_key_exists()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>array_key_exists</strong> controlla e restituisce <strong>TRUE</strong> se la chiave o indice indicato è presente nell'Array.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool array_key_exists ( mixed $key , array $array )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><strong>key</strong> - le chiavi da cercare;</p></li>
            <li><p><strong>array</strong> - L'Array in cui cercare le chiavi.</p></li>
        </ul>
        
        <h3 class="celeste">Valore restituito</h3>
        <ul>
            <li><p>Restituisce <strong>TRUE</strong> se la chiave è presente;</p></li>
            <li> <p><strong>FALSE</strong> in caso di fallimento.</p></li>
        </ul>
        
        <h3 class="esempio">Esempi di PHP.net</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$search_array = array('first' => 1, 'second' => 4);

echo '<b>// $search_array = array("first" => 1, "second" => 4);</b>',$nl;
echo '<b>// array_key_exists("first", $search_array);</b>',$nl;
if (array_key_exists('first', $search_array))
    echo "The 'first' element is in the array";
?>
</pre>
        
        <h3 class="celeste">Differenze con la funzione isset()</h3>
        <p>Differentemente da <strong>array_key_exists()</strong> che restituisce <strong>TRUE</strong>,<br />
            la funzione <strong>isset()</strong> restituisce <strong>FALSE</strong> anche se l'elemento da cercare è presente 
            ma <strong>il valore corrispondente è NULL</strong>.</p>
        
        <h4>Esempio di PHP.net</h4>
<pre>
<?php
$search_array = array('first' => null, 'second' => 4);
echo '// Dato un Array',$nl;
echo '<b>// $search_array = array(\'first\' => null, \'second\' => 4);</b>',$nl,$nl;

echo '<b>// returns false</b>',$nl;
echo '// isset($search_array[\'first\']);',$nl;
isset($search_array['first']);

echo $nl,'<b>// returns true</b>',$nl;
echo '// array_key_exists(\'first\', $search_array);',$nl;
array_key_exists('first', $search_array);
?>
</pre>

</body>
</html>