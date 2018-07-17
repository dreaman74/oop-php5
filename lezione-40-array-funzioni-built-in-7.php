<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 40 - Array - Le Funzioni Built-in 3 di 4 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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

<body>
<?php
include("include/utility.php");
include("include/array.php");
?>
    
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 40</strong>
	</p>
	
	<h1>[40] Array (7 di 8) - Le funzioni Built-in 3 di 4</h1>
        <p>Un'altra carrellata di funzione built in utili con gli array:</p>
        <ul>
            <li><p>il comando <a href="#include" title="il comando include() di PHP">include()</a> (statement);</p></</li>
            <li><p><a href="#extract" title="la funzione extract built-in di PHP">extract()</a> - split di un array in 'n' variabili;</p></li>
            <li><p><a href="#compact" title="la funzione compact built-in di PHP">compact()</a> - creare un array da variabili sparse;</p></li>
            <li><p><a href="#array_walk" title="la funzione array_walk() built-in di PHP">array_walk()</a> - richiamare una funzione su ogni elemento di un array;</p></li>
            <li><p><a href="#in_array" title="la funzione in_array() built-in di PHP">in_array()</a> - controlla se un valore è contenuto in un elemento dell'Array.</p></li>
            <li><p><a href="#is_array" title="la funzione is_array() built-in di PHP">is_array()</a> - controlla se una variabile stringa è un Array.</p></li>
            <li><p><a href="#reset" title="la funzione reset() built-in di PHP">reset()</a> - riporta il puntatore di un Array sul primo elemento e ne restituisce il valore.</p></li>
            <li><p><a href="#current" title="la funzione current() built-in di PHP">current()</a> - restituisce l'elemento corrente di un array;</p></li>
            <li><p><a href="#each" title="la funzione each() built-in di PHP">each()</a> - restituisce la corrente coppia chiave/valore di un array e incrementa il puntatore dell'array;</p></li>
            <li><p><a href="#next" title="la funzione next() built-in di PHP">next()</a> - prima incrementa il puntatore interno dell'array e ne restituisce il valore;</p></li>
            <li><p><a href="#prev" title="la funzione prev() built-in di PHP">prev()</a> - prima decrementa il puntatore interno dell'array e ne restituisce il valore.</p></li>
            </ul>
        
        <hr />
        
        <h2 id="include">include()</h2>
        <p>Reference <a href="http://bg2.php.net/manual/en/function.include.php" title="include" target="_blank">include()</a> statement di PHP.net in Arrays / Array Functions</p>
        <p>Includere file esterni. Vedere la reference ufficiale di PHP per gli esempi.</p>
        
        <hr />
        
        <h2 id="extract">extract()</h2>
        <p class="codice">Reference <a href="http://bg2.php.net/manual/en/function.extract.php" title="extract" target="_blank">extract()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione extract() crea tante variabili quante sono le chiavi dell' Array Associativo, il valore delle variabili è dato dagli elementi corrispondenti. 
        Crea le variabili sono se le chiavi corrispondendti hanno un nome valido per la variabile stessa. It also checks for collisions with existing variables in the symbol table.</p>
        <p style="background-color: yellow;margin:10px 0px;padding: 5px;">La funzione extract(), di default, sovrascrive il valore di eventuali variabili presenti 
            nel caso l'array contenga una chiave uguale. &Egrave, possibile modificare questo comportamento tramite i FLAGS del 2° Argomento opzionale.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>int extract ( array &$array [, int $flags = EXTR_OVERWRITE [, string $prefix = NULL ]] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p>input <strong>array</strong> - Un Array Associativo. Questa funzione estrae le chiavi associative come nomi delle variabili e gli elementi come valore delle variabili stesse.
                    For each key/value pair it will create a variable in the current symbol table, subject to flags and prefix parameters.</p>
                <p style="margin:10px 0px;">Passare alla funzione solo Array Associativi, in quanto gli <strong>Array con Indici Numerici non produce alcun risultato</strong> 
                    ammenoché si usi il flag <strong>EXTR_PREFIX_ALL</strong> o <strong>EXTR_PREFIX_INVALID</strong> nel secondo argomento.</p>
            </li>
            <li><p><strong>flags</strong> - Problemi con l'estrazione di Indici Numerici e Collissioni (sovrascrittura di variabili già presenti nel codice) 
                    sono gestibili con il 2° Argomento FLAGS [opzionale].</p>
                <p class="codice" style="margin: 10px 0px;">Costante di <strong>DEFAULT</strong> è <strong>EXTR_OVERWRITE</strong>, se il flag non viene specificato,.</p>
                <p>Queste le costanti accettate in FLAGS:</p>
                <ul>
                    <li>EXTR_OVERWRITE - If there is a collision, overwrite the existing variable.</li>
                    <li>EXTR_SKIP - If there is a collision, don't overwrite the existing variable.</li>
                    <li>EXTR_PREFIX_SAME - Se variabile già presente nello script, viene aggiunto un prefisso, specificato come argomento in prefix, alla variabile creata.</li>
                    <li>EXTR_PREFIX_ALL - Verrà aggiunto un prefisso a tutte le variabili estratte dalla chiavi.</li>
                    <li>EXTR_PREFIX_INVALID - Only prefix invalid/numeric variable names with prefix.</li>
                    <li>EXTR_IF_EXISTS - Only overwrite the variable if it already exists in the current symbol table, otherwise do nothing. 
                        This is useful for defining a list of valid variables and then extracting only those variables you have defined out of $_REQUEST, for example.</li>
                    <li>EXTR_PREFIX_IF_EXISTS - Only create prefixed variable names if the non-prefixed version of the same variable exists in the current symbol table.</li>
                    <li>EXTR_REFS - Extracts variables as references. This effectively means that the values of the imported variables are still referencing 
                        the values of the array parameter. You can use this flag on its own or combine it with any other flag by OR'ing the flags.</li>
                </ul>            
            </li>
            <li><strong>prefix</strong> - Il prefisso è richiesto se uno dei seguenti flag viene specificato:
                <ul>
                    <li>EXTR_PREFIX_SAME;</li>
                    <li>EXTR_PREFIX_ALL;</li>
                    <li>EXTR_PREFIX_INVALID;</li>
                    <li>EXTR_PREFIX_IF_EXISTS.</li>
                </ul>
                <p style="background-color: yellow;margin: 10px 0px; padding: 5px;">La variabile relativa alla chiave non è estratta se 
                    il prefisso e la chiave restituiscono un nome di variabile non valido.</p>
                <p style="background-color: yellow;margin: 10px 0px; padding: 5px;">I <strong>prefissi specificati</strong> sono <strong>automaticamente separati</strong> 
                    dalla variabile estratta con il carattere di <strong>underscore</strong>.</p>
            </li>
        </ul>
        
        <h3 class="celeste">Valore restituito</h3>
        <p>Returns the number of variables successfully imported into the symbol table.</p>
        
        <h3 class="esempio">Esempi FCamuso</h3>
        
        <p>Estrarre chiavi/valori e aggiungere un prefisso alle variabili create.<br />
            <strong>EXTR_PREFIX_SAME</strong>, aggiunge il prefisso alla variabile estratta solo in caso di collisione (con variabili già presenti);<br />
            <strong>EXTR_PREFIX_ALL</strong>, aggiunge il prefisso a tutte le variabili estratte.</p>
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
echo '<b>// Contenuto dell\'Array $arrCliente2</b>',$nl;
stampa_ass($arrCliente2, $nl, '');

echo '<b>// Crea una variabile con nome uguale ad una chiave contenuta in $arrCliente2</b>',$nl;
echo '// $cognome = "Verdi";',$nl;
$cognome = "Verdi";

echo $nl,'// Crea sequenza di variabili il cui nome è prelevato dalle chiavi dell\'Array',$nl;
echo '// Il valore è preso dagli elementi relativi alle chiavi prelevate',$nl;
echo '<b>// Per evitare di sovrascrivere variabili già presenti usare il FLAG [ FLAG EXTR_PREFIX_* ] e il \'prefix\', argomenti opzionali.</b>',$nl;
echo 'extract($arrCliente2, EXTR_PREFIX_SAME, \'ext\');',$nl;
extract($arrCliente2, EXTR_PREFIX_SAME, 'ext');

echo $nl,'<b>// Variabili restituite - visualizzato</b>',$nl;
echo "\$nome > $nome",$nl;

echo $nl,'// COLLISSIONE, variabile $cognome già presente',$nl;
echo '// viene preservato il valore della variabile presente',$nl;
echo "<b>\$cognome > $cognome</b>",$nl;
echo '// e anteposto un prefisso, con l\'aggiunta automatica del carattere underscore, alla variabile estratta',$nl;
echo "<b>\$ext_cognome > $ext_cognome</b>",$nl;

echo $nl,"\$eta > $eta",$nl;
echo "\$via > $via",$nl;
echo "\$nciv > $nciv",$nl;
echo "\$cap > $cap",$nl;
echo "\$comune > $comune",$nl;
?>
</pre>
        
        <hr />
        
        <h2 id="compact">compact()</h2>
        <p class="codice">Reference <a href="http://bg2.php.net/manual/en/function.compact.php" title="compact" target="_blank">compact()</a> di PHP.net in Arrays / Array Functions</p>        
        <p>La funzione compact() crea un Array Associativo (Vettore), in cui le chiavi corrispondono al nome delle variabili e il valore dell'elemento a quello contenuto nella variabile.</p>
        <p>La funzione <strong>non aggiunge elementi</strong> nel caso in cui le <strong>variabili specificate non sono state dichiarate precedentemente</strong> nello script 
            (symbol table).<br /><strong>La funzione in questo caso non restituisce alcun Warning.</strong></p> 
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Note: Gotcha
            Because variable variables may not be used with PHP's Superglobal arrays within functions, the Superglobal arrays may not be passed into compact().</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>array compact ( mixed $varname1 [, mixed $... ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><strong>varname1</strong> - la funzione compact() accetta un numero variabile di argomenti. Ciascuno argomento, può essere una stringa contenente il nome della variabile, 
                    senza il segno del dollaro $, o un array di nomi di variabili. Gli Array, possono contenere altri Array con nomi di variabili.; 
                    la funzione compact() gestisce gli Array nidifcati ricorsivamente.</p></li>
        </ul>
        
        <h3 class="celeste">Differenze tra compact() ed extract()</h3>
        <p>The description says that compact is the opposite of extract() but it is important to understand that it does not completely reverse extract(). 
            In particluar compact() does not unset() the argument variables given to it (and that extract() may have created). 
            If you want the individual variables to be unset after they are combined into an array then you have to do that yourself.</p>
        
        <h3 class="esempio">Esempi da PHP.net</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$city  = "San Francisco";
$state = "CA";
$event = "SIGGRAPH";

// Array con elementi ad indice numerico
$location_vars = array("city", "state");

$result = compact("event", "nothing_here", $location_vars);
print_r($result);
?>
CODICE;

    // Stampa nel Browser il Codice Sorgente
    echo htmlspecialchars($codice),$nl;
    
    $city  = "San Francisco";
    $state = "CA";
    $event = "SIGGRAPH";

    // Array con elementi ad indice numerico
    $location_vars = array("city", "state");
    
    echo $nl,'<b>// Stampa a Video</b>',$nl;
    $result = compact("event", "nothing_here", $location_vars);
    print_r($result);
?>
</pre>
        <h3 class="esempio">Altro esempio da PHP.net</h3>
        <p>Can also handy for debugging, to quickly show a bunch of variables and their values:</p>
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
echo '// Mosta velocelemente un gruppo di variabili e rispettivi valori',$nl;
echo 'print_r(compact(explode(\' \', \'count acw cols coldepth\')));',$nl;
// print_r(explode(' ', 'count acw cols coldepth'));
//print_r(compact(explode(' ', 'count acw cols coldepth')));
?>
</pre>
        
        <hr />
        
        <h2 id="array_walk">array_walk()</h2>
        <p class="codice">Reference <a href="http://bg2.php.net/manual/en/function.array-walk.php" title="array_walk" target="_blank">array_walk()</a> di PHP.net in Arrays / Array Functions</p>
        <p>Esegue la funzione definita dall'utente, identificata dal nome della funzione, su ogni elemento di array. Normalmente funzione accetta due parametri. 
            Il valore del parametro Array viene passato per primo, la chiave/indice per secondo. Se il parametro <strong>datiutente</strong> è specificato, 
            verrà passato come terzo parametro alla funzione callback.</p>

        <h2 class="celeste">Sintassi</h2>
        <pre>bool array_walk ( array &$array , callable $callback [, mixed $userdata = NULL ] )</pre>
        
        <h2 class="celeste">Argomenti</h2>
        <ul>
            <li><p><strong>array</strong> - l'Array su cui effettuare le operazioni.</li>
            <li><p><strong>callback</strong> - Normalmente, la funzione di callback riporta due argomenti. The array parameter's value being the first, and the key/index second.</p>
                <p class="codice">Nota: Se la funzione deve lavorare con i reali valori dell'array, negli argomenti della funzione specificare che il primo parametro di funzione 
                    deve essere passato come riferimento, anteponendo il simbolo <strong>&</strong>. A questo punto ogni modifica agli elementi verrà effettuata sull'array stesso.</p>
        
                <p class="codice">Nota: Il passaggio della chiave e di datiutente a func è stato aggiunto nella versione 4.0.</p>
        
                <p><strong>array_walk()</strong> non è influenzato dal puntatore interno dell'array array. <strong>array_walk()</strong> percorrerà l'intero array indipendentemente 
                    dalla posizione del puntatore. Per reinizializzare il puntatore, utilizzare reset(). In PHP 3, array_walk() reinizializza il puntatore.</p>
        
                <p class="codice">Note: If callback needs to be working with the actual values of the array, specify the first parameter of callback as a reference. 
                    Then, any changes made to those elements will be made in the original array itself.</p>
                <p class="codice">Note: Many internal functions (for example strtolower()) will throw a warning if more than the expected number of argument are passed 
                    in and are not usable directly as a callback.</p>
                <p>Only the values of the array may potentially be changed; its structure cannot be altered, i.e., the programmer cannot add, unset or reorder elements. 
                    If the callback does not respect this requirement, the behavior of this function is undefined, and unpredictable.</p>
            </li>
            <li><p><strong>userdata</strong> - If the optional userdata parameter is supplied, it will be passed as the third parameter to the callback.</p></li>
        </ul>
        
        <h2 class="celeste">Valore restituito</h2>
        <p>Restituisce <strong>TRUE</strong> (1) se l'operazione è svolta con successo, <strong>FALSE</strong> in caso di fallimento.</p>       

        <h3 class="celeste">Errori / Eccezioni</h3>
        <p>Gli utenti non possono modificare l'array attraverso la funzione di callback, ad esempio aggiungere/togliere un elemento, 
            o cancellare l'array su cui array_walk() è applicata. Se l'array viene cambiato, il comportamento di questa funzione non è definito ed è imprevedibile.</p>
        
        <p style="margin: 10px 0px;">Se la funzione di callback richiede più parametri di quanti gliene vengono passati, un errore di livello 
            <a href="http://php.net/manual/it/errorfunc.constants.php" title="E_WARNING" target="_blank">E_WARNING</a> verrà generato ogni volta che <strong>array_walk()</strong> 
            la chiama. Questi avvertimenti possono essere soppressi apponendo l'operatore d'errore <strong>@</strong> alla chiamata di array_walk(), oppure usando error_reporting().</p>
        
        <h3 class="esempio">Esempio da PHP.net</h3>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$frutta = array("d"=>"limone", "a"=>"arancia", "b"=>"banana", "c"=>"mela");

function modifica(&$elemento1, $chiave, $prefisso) 
{
    $elemento1 = "$prefisso: $elemento1";
}

function stampa($elemento2, $chiave) 
{
    echo "$chiave. $elemento2<br />\n";
}

echo "Prima ...:\n";
array_walk($frutta, 'stampa');

array_walk($frutta, 'modifica', 'frutto');
echo "... e dopo:\n";

array_walk($frutta, 'stampa');
?>
CODICE;

    echo htmlentities($codice);
?>
</pre>
        
        <h4>Visualizzazione nel Browser</h4>
<pre>
<?php
$frutta = array("d"=>"limone", "a"=>"arancia", "b"=>"banana", "c"=>"mela");

function modifica(&$elemento1, $chiave, $prefisso) 
{
    $elemento1 = "$prefisso: $elemento1";
}

function stampa_cust($elemento2, $chiave) 
{
    echo "$chiave. $elemento2\n";
}

echo "<b>// Stampa dell'Array \$fruits...</b>\n";
echo "<b>// array_walk(\$frutta, 'stampa');</b>\n";
array_walk($frutta, 'stampa_cust');
echo $trattini,$nl,$nl;

echo "<b>// Modifica l'Array \$fruits</b>\n";
echo "<b>// array_walk(\$frutta, 'modifica', 'frutto');</b>\n";
array_walk($frutta, 'modifica', 'frutto');

var_dump($frutta);

echo "$nl<b>// ... e dopo la modifica stampa dell'Array:</b>\n";
array_walk($frutta, 'stampa_cust');
?>
</pre>
        
        <h3 class="esempio">Esempio da FCamuso</h3>
        <p>Crea tante cella (Table Data) quanti sono i valori estratti dagli elementi.</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
    function cellaTabella($valoreCella){
        echo '<td>'.$valoreCella.'</td>',"\n";
    }
?>

<table>
    <tr>
        <?php
            // Scorre tutto l'Array passando alla funzione di callback solo il valore
            array_walk($cliente1,'cellaTabella');
        ?>
    </tr>
</table>
CODICE;

    echo htmlentities($codice);
?>
</pre>
        
        <h4>Visualizzazione nel Browser</h4>
<pre>
<?php
echo '// Dato il seguente Array: ',$nl;
var_dump($arrCliente2);

echo $nl,'// Vengono create le seguenti table data:';
echo '<table>';
    echo '<tr>';
      array_walk($arrCliente1, 'cellaTabella');
    echo '</tr>';
echo '</table>';
?>
</pre>
        
        <h3 class="celeste">Vedi anche</h3>
        <ul>
            <li><a href="http://php.net/manual/it/function.array-walk-recursive.php" title="array_walk_recursive" target="_blank">array_walk_recursive()</a>;</li>
            <li><a href="http://php.net/manual/it/function.create-function.php" title="create_function" target="_blank">create_function()</a>;</li>
            <li><a href="http://php.net/manual/it/function.list.php" title="list" target="_blank">list()</a>;</li>
            <li><a href="http://php.net/manual/it/control-structures.foreach.php" title="foreach" target="_blank">foreach</a>;</li>
            <li><a href="http://php.net/manual/it/function.each.php" title="each" target="_blank">each()</a>;</li>
            <li><a href="http://php.net/manual/it/function.call-user-func-array.php" title="call_user_func_array" target="_blank">call_user_func_array()</a>;</li>
            <li><a href="http://php.net/manual/it/function.array-map.php" title="array_map" target="_blank">array_map()</a>.</li>
        </ul>
        
        <hr />
        
        <h2 id="in_array">in_array()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.in-array.php" title="in_array" target="_blank">in_array()</a> di PHP.net in Arrays / Array Functions</p>
        <p>Controlla se un valore è contenuto in un elemento dell'Array. La funzione effettua un controllo <strong>CASE SENSITIVE</strong>.</p>
        
        <h3 class="celeste">Valore restituito</h3>
        <p>Restituisce <strong>TRUE</strong> nel caso in cui il valore è presente nelle'elemento dell'Array, <strong>FALSE</strong> se il valore non viene trovato.</p>
        
        <h3 class="esempio">Esempio da FCamuso</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
echo '<b>// Dato un Array</b>',$nl;
var_dump($arrCliente1);

echo $nl,'<b>// Mario</b>',$nl;
echo "<b>// in_array('Mario', \$arrCliente1)</b>",$nl;

if (in_array('Mario', $arrCliente1))
        echo 'Mario è stato trovato!';

echo $nl,$nl,'<b>// mario</b>',$nl;
echo "<b>// in_array('mario', \$arrCliente1)</b>",$nl;

if (in_array('mario', $arrCliente1))
        echo 'Mario è stato trovato!';
?>
</pre>
        
        <hr />
        
        <h2 id="is_array">is_array()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/en/function.is-array.php" title="is_array" target="_blank">is_array()</a> di PHP.net in Arrays / Array Functions</p>
        
        <hr />
        
        <h2 id="reset">reset()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.reset.php" title="reset" target="_blank">reset()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>reset()</strong> riporta il puntatore di array sul primo elemento e ne restituisce il valore.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>mixed reset ( array &$array )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><strong>array</strong> - Input Array</li>
        </ul>
        
        <h3 class="celeste">Valore restituito</h3>
        <p>Returns the value of the first array element, or FALSE if the array is empty.</p>
        
        <h3 class="esempio">Esempi di PHP.net</h3>
        
        <h4>Codice</h4>
        
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$array = array('passo uno', 'passo due', 'passo tre', 'passo quattro');
  
// di default, il puntatore è sul primo elemento  
echo current($array) . "<br />\n"; // "passo uno"

// salta due passi    
next($array);                                 
next($array);
echo current($array) . "<br />\n"; // "passo tre"
  
// reset del puntatore, ricomincia dal passo uno
reset($array);
echo current($array) . "<br />\n"; // "passo uno"
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>

        <hr />
        
        <h2 id="current">current()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.current.php" title="current" target="_blank">current()</a> di PHP.net in Arrays / Array Functions</p>

        <hr />
        
        <h2 id="each">each()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.each.php" title="each" target="_blank">each()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>each()</strong> prima restituisce la corrente coppia chiave/valore di un array e dopo incrementa il puntatore dell'array.</p>
        
        <hr />
        
        <h2 id="next">next()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.next.php" title="next" target="_blank">next()</a> di PHP.net in Arrays / Array Functions</p>
        
        <hr />
        
        <h2 id="prev">prev()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.prev.php" title="prev" target="_blank">prev()</a> di PHP.net in Arrays / Array Functions</p>
        
</body>
</html>