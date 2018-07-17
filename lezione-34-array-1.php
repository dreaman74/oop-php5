<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 34 - Array - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 34</strong>
	</p>
	
	<h1>[34] Gli Array - parte 1 di 8</h1>

        <ul>
            <li><p><b>Array</b> cosa sono - PHP.net Reference (Types) 
                    <a href="http://php.net/manual/en/language.types.array.php" title="Cosa sono gli Array">http://php.net/manual/en/language.types.array.php</a></p></li>
            <li><p><b>Array</b> esempi vari - PHP.net Reference (Arrays / Array Functions) 
                    <a href="http://php.net/manual/en/function.array.php" title="Array Functions" target="_blank">http://php.net/manual/en/function.array.php</a></p></li>
            <li><p>La funzione <a href="#list" title="list()"><b>list()</b></a> - prima parte - crea variabili con riferimenti agli elementi di un array.</p></li>
            <li><p>La funzione array_combine() ;</p></li>
            <li><p>array_fill() ;</p></li>
            <li><p>La funzione array_values() ;</p></li>
            <li><p>shuffle() ;</p></li>
        </ul>
        
        <p><a href="#fcamuso" title="esempi di fcamuso">Esempi FCamuso</a></p>
        
        <hr />
        
        <h2>Cosa è un Array</h2>
        <p>An array in PHP is actually an ordered map. A map is a type that associates values to keys. This type is optimized for several different uses; 
            it can be treated as an array, list (vector), hash table (an implementation of a map), dictionary, collection, stack, queue, and probably more. 
            As array values can be other arrays, trees and multidimensional arrays are also possible.</p>
        
        <h3>Variabile Stringa</h3>
        <p>Un esempio di Array è una <b>variabile stringa, in cui ogni carattere rappresenta un elemento di un Array</b>.</p>
        <p style="margin:10px 0px;">Altro esempio di Array, <b>elenco di checkbox o radio button</b> passati da un form.</p>

        <hr />

        <h3 class="celeste">Sintassi</h3>
        
        <h4>Sintassi con la forma > array()</h4>
        <p>An array can be created using the array() language construct. It takes any number of comma-separated key => value pairs as arguments.</p>
<pre>
array(
    key  => value,
    key2 => value2,
    key3 => value3,
    ...
)
</pre>
        <p style="background-color: yellow;">The comma after the last array element is optional and can be omitted. This is usually done for single-line arrays, 
            i.e. array(1, 2) is preferred over array(1, 2, ). For multi-line arrays on the other hand the trailing comma is commonly used, 
            as it allows easier addition of new elements at the end.</p>

        <h2>Creare un Array</h2>
        <p>As of PHP 5.4 (Dal PHP 5.4) you can also use the short array syntax, which replaces array() with [].</p>
<?php
$codice = <<< 'CODICE'
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

// as of PHP 5.4 - Forma contratta con Parentesi Quasre (Square Brackets)
$array = [
    "foo" => "bar",
    "bar" => "foo",
];
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>

        <h2>Chiavi e Valori degli Array</h2>
        <p>Le <b>Chiavi</b> possono essere rappresentate sia da interi sia da stringhe. I <b>Valori</b> da qualsiati tipo.</p>

        <h2 class="celeste">Casting delle Chiavi</h2>
        <ul>
            <li>Le chiavi con <b>stringhe</b> contenenti valori di tipo intero (<b>integers</b>) saranno automaticamente convertite in chiavi numeriche intere (<b>integer</b>). 
            Per esempio, la chiave "8" sarà convertita in un dato di tipo intero 8 (integer). Invece, non à effettuato il cast sulla chiave "08" in quanto 
            non rappresente un intero su base decimale.</li>
            <li><b>Floats</b> are also cast to integers, which means that the fractional part will be truncated. E.g. the key 8.7 will actually be stored under 8.</li>
            <li><b>Bools</b> are cast to <b>integers</b>, too, i.e. the key true will actually be stored under 1 and the key false under 0.</li>
            <li><b>Null</b> will be cast to the empty string, i.e. the key null will actually be stored under "".</li>
            <li><b>Arrays</b> and <b>Objects</b> can not be used as keys. Doing so will result in a warning: Illegal offset type.</li>
        </ul>
        
        <h2 class="celeste">Chiavi uguali</h2>
        <p>Se all'interno dello stesso, risultano più elementi con la stessa chiave, solo l'ultima di esse sarà valida e le latre saranno sovrascritte.</p>
        
        <h3 class="esempio">Esempio 1</h3>
        <p>Il seguente Array avendo più elementi con la stessa Chiave  - con il Casting le chiavi 1, "1", 1.5 e True assumono il valore 1 (integer) - 
            l'ultima chiave valida è True => "d"  - tutti gli elementi precedenti sono sovrascritti.</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$array = array(
    1    => "a",
    "1"  => "b",
    1.5  => "c",
    true => "d",
);
var_dump($array);
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>

<?php
$array = array(
    1    => "a",
    "1"  => "b",
    1.5  => "c",
    true => "d",
);
echo "<pre>";
var_dump($array);
echo "</pre>";
?>
        <h2 class="celeste">Array con Chiavi Associative e Indici Numerici</h2>
        <p>PHP arrays can contain integer and string keys at the same time as PHP does not distinguish between indexed and associative arrays.</p>
        
        <h3 class="esempio">Esempio 2</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$array = array(
    "foo" => "bar",
    "bar" => "foo",
    100   => -100,
    -100  => 100,
);
var_dump($array);
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$array = array(
    "foo" => "bar",
    "bar" => "foo",
    100   => -100,
    -100  => 100,
);
echo "<pre>";
var_dump($array);
echo "</pre>";
?>
        <h2 class="celeste">Dichiarazioni delle Chiavi</h2>        
        
        <h3 class="esempio">Valori senza chiavi</h3>
        <p>Dichiarare le chiavi è opzionale, l'engine di PHP assegnerà, per ogni chiave non specificata, una chiave numerica 
            incrementando di 1 la chiave precedente di tipo intero con valore maggiore.</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$array = array("foo", "bar", "hello", "world");
var_dump($array);
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$array = array("foo", "bar", "hello", "world");

echo "<pre>";
var_dump($array);
echo "</pre>";
?>
        <h3 class="esempio">Dichiarare alcune chiavi</h3>
        <p>&Egrave; permesso specificare la chiave solo per alcuni elementi. Le chiavi non specificate assumeranno un valore uguale alla chiave numerica precedente con 
            valore intero maggiore + 1.</p>
        
        <p style="margin:10px 0px;">Nel Codice successivo, l'ultimo elemento "d" avrà una chiave numerica 7 perché la chiave dell'elemento precedente con valore più alto è 6 (elemento "c").</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$array = array(
         "a",
         "b",
    6 => "c",
         "d",
);
var_dump($array);
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$array = array(
         "a",
         "b",
    6 => "c",
         "d",
);

echo "<pre>";
var_dump($array);
echo "</pre>";
?>
        
        <h2>Accedere agli Elementi degli Array</h2>
        <p>Per <b>accedere ad un elemento di un Array</b> bisogna <b>usare le parentesi quadre</b> (Square Brackets) <b>o le parentesi graffe</b> (Curly Brackets).</p>
        
        <h3>Esempio 3</h3>
        <p>Specificare e Accedere ad Array Multidimensionali.</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
$array = array(
    "foo" => "bar",
    42    => 24,
    "multi" => array(
         "dimensional" => array(
             "array" => "foo"
         )
    )
);

var_dump($array["foo"]);
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$array = array(
    "foo" => "bar",
    42    => 24,
    "multi" => array(
         "dimensional" => array(
             "array" => "foo"
         )
    )
);

echo "<pre>";
var_dump($array["foo"]);
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);
echo "</pre>";
?>
        
        <h2>Array restituiti da Funzioni o Metodi</h2>
        <p>As of PHP 5.4 it is possible to array dereference the result of a function or method call directly. Before it was only possible using a temporary variable.</p>
        <p>As of PHP 5.5 it is possible to array dereference an array literal.</p>
        
        <h3>Esempio 4</h3>
        <p>Accedere direttamente ad un Array tramite una funzione (da PHP 5.4) che restituisce i valori degli elementi stessi dell'Array, tramite una copia dell'Array o 
            utilizzando la funzione built-in <a href="#list" title="list() - Funzione Built-in di PHP">list()</a> di PHP.</p>

        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
// Funzione che Restituisce un Array
function getArray() {
    return array(1, 2, 3);
}

// on PHP 5.4
$secondElement = getArray()[1];

// previously 
$tmp = getArray();
$secondElement = $tmp[1];

// Oppure usando la Funzione list()
list(, $secondElement) = getArray();
?>
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$nl = "<br />";

function getArray() {
    return array(1, 2, 3);
}

echo "<pre>";

echo '// on PHP 5.4',$nl;
$secondElement = getArray()[1];
echo '$secondElement = getArray()[1]',$nl,'Secondo Elemento: ',$secondElement,$nl,$nl;

echo '// previously',$nl;
$tmp = getArray();
$secondElement = $tmp[1];
echo '$tmp = getArray();',$nl,'$secondElement = $tmp[1];',$nl,'Secondo Elemento: ',$secondElement,$nl,$nl;

echo '// Oppure usando la Funzione list()',$nl;
list(, $secondElement) = getArray();
echo 'list(, $secondElement) = getArray();',$nl,'Secondo Elemento: ',$secondElement;

echo "</pre>";
?>
        <p style="background-color: yellow;margin: 10px 0px;padding:5px;"><b>NOTA:</b><br />
            Attempting to access an array key which has not been defined is the same as accessing any other undefined variable:<br />
            an E_NOTICE-level error message will be issued, and the result will be NULL.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding:5px;"><b>NOTA:</b><br />
            Array dereferencing a <b>scalar value</b> - <a href="lezione-7-tipi-di-dato.php#dati-scalari" title="tipi di dato scalari">tipi di dato scalare</a>: numeri interi (long - integer), 
            numeri reali (double - floating point), stringhe e booleani (true / false) - which is not a string silently yields NULL, i.e. without issuing an error message.</p>
        
        <h2 class="celeste">Creare o Modificare un Array</h2>
        <p>Per creare e/o modificare il valore di un elemento di un Array nuovo o esistente, basta specificare la chiave nelle parentesi quadre assegnado il valore con l'operatore di assegnazione =. 
            Le chiavi possono essere omesse, utilizzando una coppia di parentesi quadre ( [] ) senza la chiave al loro interno.</p>

<pre>
// La Chiave (Key) deve essere un intero o una stringa
// Il valore può essere un dato di qualsiasi tipo

// Specificando la chiave
$arr[key] = value;
// Senza specificare la chiave
$arr[] = value;
</pre>
        <p style="background-color: yellow;margin: 10px 0px;padding:5px;">Se l'<b>Array non esiste, il metodo delle parentesi quadre è un altro modo per creare un nuovo Array</b>.</p>
        <p style="color: white;background-color: red;margin: 10px 0px;padding:5px;">Questo metodo comunque è sconsigliato, in quanto se si fa riferimento ad un Array esistente e 
            contenente degli elementi (esempio stringhe da variabili request), i valori passati con le parentesi quadre senza chiave, andranno ad aggiungersi come nuovi elementi 
            - con indice numerico - agli elementi esistenti dell'Array stesso. <b>Specificare la chiave, è il modo migliore per sosituire un valore di un Array esistente.</b></p>
        <p style="color: white;background-color: red;margin: 10px 0px;padding:5px;"><b>Usare la funzione unset()</b> per eliminare le coppie chiave/valore degli elementi.</p>
<?php
$codice = <<< 'CODICE'
$arr = array(5 => 1, 12 => 2);

$arr[] = 56;    // This is the same as $arr[13] = 56;
                // at this point of the script

$arr["x"] = 42; // This adds a new element to
                // the array with key "x"
                
unset($arr[5]); // This removes the element from the array

unset($arr);    // This deletes the whole array
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <p style="background-color: yellow;margin: 10px 0px;padding:5px;"><b>NOTA:</b> Come da esempio sopra riportato, se non vengono specificate le chiavi, il nuovo elemento creato 
            avrà un indice numerico incrementando di 1 (integer) l'indice numerico più alto dell'Array stesso, se non sono presenti indici numerici il valore della chiave sarà 0.</p>

        <h2 id="array_values">array_values()</h2>
        <p>La funzione restituisce un array sostituendo le chiavi associative con indici numerici. La funzione resetta indici numerici di un Array. 
            Con unset() se eliminano le chiavi/valore ma l'indice numerico dell'Array non viene rindicizzato, utilizzare array_values() per rindicizzare l'indice numerico.</p>
        
        <p>Per altri esempi, vedi anche:</p>
        <ul>
            <li><p><a href="lezione-36-array-associativi-e-numerici-3.php#array_values" title="array_values">array_values()</a> nella Lezione 36;</p></li>
            <li><p>La Reference di PHP.net su <a href="http://php.net/manual/en/function.array-values.php" title="array_values() su PHP.net" target="_blank">array_values()</a> .</p></li>
        </ul>
        
        <h3 class="esempio">Esempio 5</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
// Create a simple array.
$array = array(1, 2, 3, 4, 5);
print_r($array);

// Now delete every item, but leave the array itself intact:
foreach ($array as $i => $value) {
    unset($array[$i]);
}
print_r($array);

// Append an item (note that the new key is 5, instead of 0).
$array[] = 6;
print_r($array);

// Re-index:
// La funzione array_values($array) è possibile invocarla anche dopo $array[] = 7)
$array = array_values($array);
$array[] = 7;
print_r($array);
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$nl = "<br />";

echo '<pre>';

echo '// Create a simple array.',$nl;
echo '<b>$array = array(1, 2, 3, 4, 5);</b>',$nl;
$array = array(1, 2, 3, 4, 5);
print_r($array);

echo $nl,'// unset() Now delete every item, but leave the array itself intact:',$nl;
foreach ($array as $i => $value) {
    unset($array[$i]);
}
print_r($array);

echo $nl,'// Append an item (note that the new key is 5, instead of 0).',$nl;
echo '<b>$array[] = 6;</b>',$nl;
$array[] = 6;
print_r($array);

echo $nl,'// Append another item (the new key is 6).',$nl;
echo $nl,'<b>','$array[] = 7;</b>',$nl;
// $array = array_values($array);
$array[] = 7;
print_r($array);

echo $nl,'// Re-index - Ripristina indice numerico partendo da 0:',$nl;
echo '<b>$array = array_values($array);</b>',$nl;
$array = array_values($array);
print_r($array);
echo '</pre>';
?>
        
        <h3 class="esempio">Esempio 6</h3>
<?php
$codice = <<< 'CODICE'
<?php
$a = array(1 => 'one', 2 => 'two', 3 => 'three');
unset($a[2]);
/* will produce an array that would have been defined as
   $a = array(1 => 'one', 3 => 'three');
   and NOT
   $a = array(1 => 'one', 2 =>'three');
*/

$b = array_values($a);
// Now $b is array(0 => 'one', 1 =>'three')
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <hr />
        
        <h2 id="list">list()</h2>
        <p>La funzione <a href="http://php.net/manual/en/function.list.php" title="Assegnare Variabili come se fossero un Array" target="_blank">http://php.net/manual/en/function.list.php</a> 
            su PHP.net Reference (Arrays / Array Functions)</p>                    
        <p><b>list() lavora solo con Array con Indice Numerico</b> and assumes the numerical indices start at 0.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding:5px;">Warning
In PHP 5, list() assigns the values starting with the right-most parameter. In PHP 7, list() starts with the left-most parameter.
If you are using plain variables, you don't have to worry about this. But if you are using arrays with indices you usually expect the order of the indices in the array the same you wrote in the list() from left to right, which is not the case in PHP 5, as it's assigned in the reverse order.
Generally speaking, it is advisable to avoid relying on a specific order of operation, as this may change again in the future.</p>
        
        <h3 class="esempio">Esempio 7</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$info = array('coffee', 'brown', 'caffeine');

// Listing all the variables
list($drink, $color, $power) = $info;
echo "$drink is $color and $power makes it special.\n";

// Listing some of them
list($drink, , $power) = $info;
echo "$drink has $power.\n";

// Or let's skip to only the third one
list( , , $power) = $info;
echo "I need $power!\n";

// list() doesn't work with strings
list($bar) = "abcde";
var_dump($bar); // NULL
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <h3 class="esempio">Esempio 8</h3>
        
        <h4>Codice</h4>        
<?php
$codice = <<< 'CODICE'
<table>
 <tr>
  <th>Employee name</th>
  <th>Salary</th>
 </tr>

<?php
$result = $pdo->query("SELECT id, name, salary FROM employees");
while (list($id, $name, $salary) = $result->fetch(PDO::FETCH_NUM)) {
    echo " <tr>\n" .
          "  <td><a href=\"info.php?id=$id\">$name</a></td>\n" .
          "  <td>$salary</td>\n" .
          " </tr>\n";
}
?>

</table>
CODICE;
  
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h3 class="esempio">Esempio 9</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
list($a, list($b, $c)) = array(1, array(2, 3));
var_dump($a, $b, $c);
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
list($a, list($b, $c)) = array(1, array(2, 3));
echo '<pre>';
var_dump($a, $b, $c);
echo '</pre>';
?>
        <h3 class="esempio">Ordine degli elementi</h3>
        <p>The order in which the indices of the array to be consumed by list() are defined is irrelevant.</p>
        <p style="color: white;background-color: red;margin:10px 0px;padding:5px;">Con list() non è possibile specificare un elemento a chiave associativa.</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$foo = array(2 => 'a', 'foo' => 'b', 0 => 'c');
$foo[1] = 'd'; // Aggiungo un Altro Elemento

list($x, $y, $z) = $foo;
var_dump($foo, $x, $y, $z);
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$foo = array(2 => 'a', 'foo' => 'b', 0 => 'c');
$foo[1] = 'd';
list($x, $y, $z) = $foo;

echo '<pre>';
var_dump($foo, $x, $y, $z);
echo '</pre>';
?>
        
        <p>Gives the following output (note the order of the elements compared in which order they were written in the list() syntax).</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$info = array('coffee', 'brown', 'caffeine');
list($a[0], $a[1], $a[2]) = $info;
var_dump($a);
?>
CODICE;
  
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>     
        <h4>Output in PHP 7:</p>
<?php
$info = array('coffee', 'brown', 'caffeine');
list($a[0], $a[1], $a[2]) = $info;
echo '<pre>';
var_dump($a);
echo '</pre>';
?>
        <h4>Output in PHP 5:</h4>
<?php
$info = array('coffee', 'brown', 'caffeine');
list($a[0], $a[1], $a[2]) = $info;
echo '<pre>';
var_dump($a);
echo '</pre>';
?>
        
        <hr />
        
        <h2>Guarda anche</h2>
        <ul>
            <li><p><a href="http://php.net/manual/en/function.each.php" title="each()" target="_blank"><b>each()</b></a> - Return the current key and value pair from an array and advance the array cursor;</p></li>
            <li><p><a href="http://php.net/manual/en/function.extract.php" title="extract()" target="_blank"><b>extract()</b></a> - Import variables into the current symbol table from an array.</p></li>
        </ul>
        
        <hr />
        
        <h2 id="fcamuso">Gli Array - Guida FCamuso</h2>
        
        <h3 class="esempio">Esempi Vari</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
// Array per IRPEF e Scaglioni

// Forma estesa (4 elementi)
$aliquoteClassica = array(15000, 28000, 55000, 75000);

echo "<ul>\n";
$indice = 0;
while ($indice < count($aliquoteClassica))
{
    // Array[espressione] dove espressione da 0 a (count - 1)
    echo "<li>$aliquoteClassica[$indice]</li>";
    $indice++;
}
echo "</ul>";

// Forma Contratta - con Aggiunta di un elemento (5 elementi)
$aliquoteContratta = [15000, 18000, 28000, 55000, 75000];

echo "<ul>\n";
$indice = 0;
while ($indice < count($aliquoteContratta))
{
    // Array[espressione] dove espressione da 0 a (count - 1)
    echo "<li>$aliquoteContratta[$indice]</li>";
    $indice++;
}
echo "</ul>";
CODICE;
        
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$nl = '<br />';

// Forma estesa
$aliquoteClassica = array(15000, 28000, 55000, 75000);

// Forma Contratta
$aliquoteContratta = [15000, 18000, 28000, 55000, 75000];

echo '<pre>';

echo str_repeat('-', 70),$nl;
echo "Forma Classica con uso di Parentesi Tonde (count ".count($aliquoteClassica)." - Elementi):$nl";
echo str_repeat('-', 70),$nl;
echo "<ul>";
$indice = 0;
while ($indice < count($aliquoteClassica))
{
    echo "<li>$aliquoteClassica[$indice]</li>";
    $indice++;
}
echo "</ul>";

echo str_repeat('-', 70),$nl;
echo "Forma Contratta con uso di Parentesi Quadre (count ".count($aliquoteContratta)." - Elementi):$nl";
echo str_repeat('-', 70),$nl;
echo "<ul>";
$indice = 0;
while ($indice < count($aliquoteContratta))
{
    echo "<li>$aliquoteContratta[$indice]</li>";
    $indice++;
}
echo "</ul>";

echo '</pre>';
?>
        
        <h3>Esempio con operatore di post incremento</h3>
        <p>Inserendo l'operatore di incremento dopo la variabile, assume significato di operatore di <b>post incremento</b>: prima <b>legge il valore contenuto nella variabile, 
            solo dopo incrementa di 1 la variabile stessa</b>. Differentemente, <b>anteponendo l'operatore di incremento alla variabile, si incrementa di 1 e poi 
                legge il contenuto della variabile</b>.</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
$aliquote = [15000, 18000, 27000, 55000, 75000];

$indice = 0;
echo '<ul>';
while ($indice < count($aliquote))
    echo "<li>{$aliquote[$indice++]}</li>";    
echo '<ul>';
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <h4>Visualizzato nel Browser</h4>
<?php
$aliquote = [15000, 18000, 27000, 55000, 75000];

$indice = 0;
echo '<pre>';
echo '<ul>';
while ($indice < count($aliquote))
    echo "<li>{$aliquote[$indice++]}</li>";    
echo '<ul>';
echo '</pre>';
?>

</body>
</html>