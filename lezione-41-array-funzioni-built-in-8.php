<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 41 - Array - Le Funzioni Built-in 4 di 4 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	html, body {
            margin: 0px;
            padding: 0px;
        }

        body {
                font-size: 100%;
                font-family: Arial, sans-serif;

                width: 100%;
        }

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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 41</strong>
	</p>
	
	<h1>[41] Array (8 di 8) - Le funzioni Built-in 4 di 4</h1>
        <p>Ordinamento, :</p>
        <ul>
            <li>
                <p>Ordinamento di un Array:</p>
                <ul>
                    <li><p><a href="#sort" title="la funzione sort() built-in di PHP">sort()</a><br />
                            Ordina in modo crescente gli elementi di un Array, riassegnando gli indici numerici;</p></li>
                    <li><p><a href="#rsort" title="la funzione rsort() built-in di PHP">rsort()</a><br />
                            Ordina in modo decrescente gli elementi di un Array, riassegnando gli indici numerici;</p></li>
                    <li><p><a href="#asort" title="la funzione asort() built-in di PHP">asort()</a><br />
                            Ordina in modo crescente gli elementi di un Array, mantenendo la correlazione chiave/elemento;</p></li>
                    <li><p><a href="#arsort" title="la funzione arsort() built-in di PHP">arsort();</a><br />
                            Ordina in modo decrescente gli elementi di un Array, mantenendo la correlazione chiave/elemento;</p></li>
                    <li><p><a href="#ksort" title="lafunzione ksort() buit-in di PHP">ksort()</a> - Ordinamento crescente in base alle chiavi, mantenendo le associazioni;</p></li>
                    <li><p><a href="#krsort" title="lafunzione krsort() buit-in di PHP">krsort()</a> - Ordinamento decrescente in base alle chiavi, mantenendo le associazioni;</p></li>
                    <li><p><a href="#natsort" title="la funzione natsort(9 built-in di PHP">natsort()</a> - Ordina un array usando un algoritmo di "ordine naturale";</p></li>
                    <li><p><a href="#usort" title="la funzione usort() built-in di PHP">usort()</a> - Ordinamento mediante una funzione definita dall'utente;</p></li>
                    <li><p><a href="#uasort" title="la funzione uasort() built-in di PHP">uasort()</a> - Ordinamento mediante una funzione definita dall'utente, mantenendo le associazioni;</p></li>
                    <li><p><a href="#uksort" title="la funzione uksort() built-in di PHP">uksort()</a> - Ordinamento rispetto alle chiavi, mediante una funzione definita dall'utente.</p></li>
                </ul>
            </li>
            <li><p><a href="#array_sum" title="la funzione array_sum() built-in di PHP">array_sum()</a>;</p></li>
            <li><p><a href="#array_merge" title="la funzione array_merge() built-in di PHP">array_merge()</a>;</p></li>
        </ul>
        
        <hr />
        
        <h2 id="sort">sort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.sort.php" title="sort" target="_blank">sort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>sort()</strong> ordina gli elementi (quindi i valori) di un Array in modo crescente - <strong>dal più piccolo al più grande</strong>. 
            <strong>La modifica avviene sull'Array Originale.</strong></p>
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: La funzione sovrascrive tutte le chiavi associative e gli indici presenti 
           con i nuovi indici numerici restituiti dall'ordinamento.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool sort ( array &$array [, int $sort_flags = SORT_REGULAR ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><strong>array</strong> - L'Array da Ordinare;</p></li>
            <li><p><strong>sort_flags</strong> - [opzionale] - il 2° argomento <strong>sort_flags</strong> può essere usato per modificare il comportamento in cui viene effettuato 
                    l'ordinamento, usando i seguenti <b>FLAGS di ordinamento</b>:</p>
                <ul>
                    <li><strong>SORT_REGULAR</strong> - <b>[DEFAULT]</b> compara gli elementi normalmente, non modifica il tipo;</li>
                    <li><strong>SORT_NUMERIC</strong> - compara gli elementi numericamente;</li>
                    <li><strong>SORT_STRING</strong> - compara gli elementi convertiti in stringa (chiave numerica);</li>
                    <li><strong>SORT_LOCALE_STRING</strong> - compare items as strings, based on the current locale. It uses the locale, which can be changed using setlocale();</li>
                    <li><strong>SORT_NATURAL</strong> - compare items as strings using "natural ordering" like natsort();</li>
                    <li><strong>SORT_FLAG_CASE</strong> - can be combined (bitwise OR) with SORT_STRING or SORT_NATURAL to sort strings case-insensitively.</li>
                </ul>
            </li>
        </ul>
        
        <h3 class="celeste">Valore Retituito</h3>
        <p>Restituisce TRUE in caso di successo, FALSE in caso di fallimento.</p>
        
        <h3 class="esempio">Esempio di PHP.net</h3>

        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$frutti = array("limone", "arancia", "banana", "mela");
sort($frutti); // Ordina l'Array
reset($frutti); // Riporta il puntatore dell'Array al primo elemento e ne restituisce il valore

while (list($chiave, $valore) = each($frutti)) {
    echo "frutti[" . $chiave . "] = " . $valore . "\n";
}
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
    
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$frutti = array("limone", "arancia", "banana", "mela");
sort($frutti); // Ordina l'Array
reset($frutti); // Riporta il puntatore dell'Array al primo elemento e ne restituisce il valore

while (list($chiave, $valore) = each($frutti)) {
    echo "frutti[" . $chiave . "] = " . $valore . "\n";
}
?>
</pre>
        
        <h3 class="celeste">Vedi anche</h3>
        <ul>
            <li><a href="lezione-40-array-funzioni-built-in-7.php#each" title="funzione built.in each() di PHP per gli array">each()</a>.</li>
            <li><a href="lezione-40-array-funzioni-built-in-7.php#reset" title="funzione built.in reset() di PHP per gli array">reset()</a>.</li>
        </ul>
        
        <h3 class="esempio">Esempio di FCamuso</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$arrVettore1['numero1'] = 60;
$arrVettore1[] = 56;
$arrVettore1[] = 25;
$arrVettore1[] = 37;
$arrVettore1['numero2'] = 22;

echo '<b>Array non Ordinato:</b>',$nl;
print_r($arrVettore1);
//stampa($arrVettore1);

echo '<b>// Ordinamento crescente:</b>',$nl;
echo '// sort($arrVettore1)',$nl;
sort($arrVettore1);
print_r($arrVettore1);
?>
</pre>
        <hr />
        
        <h2 id="rsort">rsort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.rsort.php" title="rsort" target="_blank">rsort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>rsort()</strong> ordina gli elementi (quindi i valori) di un Array in modo decrescente - <strong>dal più grande al più piccolo</strong>. 
            <strong>La modifica avviene sull'Array Originale.</strong></p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: La funzione sovrascrive tutte le chiavi associative e gli indici presenti 
           con i nuovi indici numerici restituiti dall'ordinamento.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool rsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <p>La funzione <strong>rsort()</strong> funziona come <a href="#sort">sort()</a>.
            
            <h3 class="esempio">Esempio di FCamuso</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
echo '<b>// Ordinamento decrescente dell\'Array Precedentemente Ordinato con sort():</b>',$nl;
echo '// rsort($arrVettore1)',$nl;
rsort($arrVettore1);
print_r($arrVettore1);
?>
</pre>
        
        <hr />
        
        <h2 id="asort">asort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.asort.php" title="asort" target="_blank">asort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>asort()</strong> ordina gli elementi (quindi i valori) di un Array in modo crescente - 
            <strong>dal più piccolo al più grande, prima le lettere e dopo i numeri.</strong> 
            <strong>La modifica avviene sull'Array Originale.</strong> Viene modificata solo la posizione degli elementi e non la correlazione chiave/valore.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: La funzione <strong>asort()</strong> viene utilizzata principalmente nel caso in cui si renda necessario 
            mantenere inalterata la relazione chiave/valore degli elementi negli array associativi.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool asort ( array &$array [, int $sort_flags = SORT_REGULAR ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <p>&Egrave; possibile modificare il comportamento dell'ordinamento usando il 2° Argomento [opzionale] <strong>sort_flags</strong>, 
            per maggiori dettagli vedere <a href="#sort" title="sort()">sort()</a>.</p>
        
        <h3 class="esempio">Esempio di PHP.net</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$frutta = array("d"=>"limone", "e"=>25, "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela");
echo '<b>Riordina il seguente Array:</b>',$nl;
echo '<b>$frutta = array("d"=>"limone", "e"=>25, "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela");</b>',$nl,$nl;

echo '<b>asort($frutta);</b>',$nl;
asort($frutta);
/*
reset($frutta);

while (list($chiave, $valore) = each($frutta)) {
    echo "$chiave = $valore\n";
}
 */
print_r($frutta);
?>
</pre>
        
        <hr />
        
        <h2 id="arsort">arsort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.arsort.php" title="arsort" target="_blank">arsort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>arsort()</strong> ordina gli elementi (quindi i valori) di un Array in modo decrescente - 
            <strong>dal più grande al più piccolo, prima i numeri e dopo le lettere.</strong> 
            <strong>La modifica avviene sull'Array Originale.</strong> Viene modificata solo la posizione degli elementi e non la correlazione chiave/valore.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: La funzione <strong>asort()</strong> viene utilizzata principalmente nel caso in cui si renda necessario 
            mantenere inalterata la relazione chiave/valore degli elementi negli array associativi.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool arsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <p>&Egrave; possibile modificare il comportamento dell'ordinamento usando il 2° Argomento [opzionale] <strong>sort_flags</strong>, 
            per maggiori dettagli vedere <a href="#sort" title="sort()">sort()</a>.</p>
        
        <h3 class="esempio">Esempio di PHP.net</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$frutta = array("d"=>"limone", "e"=>25, "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela");
echo '<b>Riordina il seguente Array:</b>',$nl;
echo '<b>$frutta = array("d"=>"limone", "e"=>25, "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela");</b>',$nl,$nl;

echo '<b>arsort($frutta);</b>',$nl;
arsort($frutta);
/*
reset($frutta);

while (list($chiave, $valore) = each($frutta)) {
    echo "$chiave = $valore\n";
}
 */
print_r($frutta);
?>
</pre>
        
        <hr />
        
        <h2 id="ksort">ksort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.ksort.php" title="ksort" target="_blank">ksort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>ksort()</strong> ordina gli elementi di un Array <strong>in base alle key (chiavi e indici)</strong> - 
            <strong>dal più piccolo al più grande, prima le lettere e dopo i numeri <span style="color: red;">(indice numerico 0 [ZERO], verificare il comportamento)</span>.</strong> 
            Viene modificata solo la posizione degli elementi e <strong>mantenuta la correlazione chiave/valore</strong>. <strong>La modifica avviene sull'Array Originale.</strong></p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: La funzione <strong>ksort()</strong> viene utilizzata principalmente nel caso in cui si renda necessario 
            mantenere inalterata la relazione chiave/valore degli elementi negli array associativi.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool ksort ( array &$array [, int $sort_flags = SORT_REGULAR ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <p>&Egrave; possibile modificare il comportamento dell'ordinamento usando il 2° Argomento [opzionale] <strong>sort_flags</strong>, 
            per maggiori dettagli vedere <a href="#sort" title="sort()">sort()</a>.</p>
        
        <h3 class="esempio">Esempio di PHP.net</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$frutta = array("d"=>"limone", "e"=>25, 1=>"indice numerico 1", "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela", 0=>"indice numerico 0", "indice numerico 2");
echo '<b>Riordina il seguente Array:</b>',$nl;
echo '<b>$frutta = array("d"=>"limone", "e"=>25, 1=>"indice numerico 1", "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela", 0=>"indice numerico 0", "indice numerico 2");</b>',$nl,$nl;

echo '<b>ksort($frutta);</b>',$nl;
ksort($frutta);
/*
reset($frutti);
while (list($chiave, $valore) = each($frutti)) {
    echo "$chiave = $valore\n";
}
*/
print_r($frutta);
?>
</pre>
        
        <hr />
        
        <h2 id="krsort">krsort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.krsort.php" title="krsort" target="_blank">krsort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>krsort()</strong> ordina gli elementi di un Array <strong>in base alle key (chiavi e indici)</strong> - 
            <strong>dal più grande al più piccolo, prima i numeri e dopo le lettere <span style="color: red;">(indice numerico 0 [ZERO], verificare il comportamento)</span>.</strong> 
            Viene modificata solo la posizione degli elementi e <strong>mantenuta la correlazione chiave/valore</strong>. <strong>La modifica avviene sull'Array Originale.</strong></p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: La funzione <strong>ksort()</strong> viene utilizzata principalmente nel caso in cui si renda necessario 
            mantenere inalterata la relazione chiave/valore degli elementi negli array associativi.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool krsort ( array &$array [, int $sort_flags = SORT_REGULAR ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <p>&Egrave; possibile modificare il comportamento dell'ordinamento usando il 2° Argomento [opzionale] <strong>sort_flags</strong>, 
            per maggiori dettagli vedere <a href="#sort" title="sort()">sort()</a>.</p>
        
        <h3 class="esempio">Esempio di PHP.net</h3>
        
        <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$frutta = array("d"=>"limone", "e"=>25, 1=>"indice numerico 1", "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela", 0=>"indice numerico 0", "indice numerico 2");
echo '<b>Riordina il seguente Array:</b>',$nl;
echo '<b>$frutta = array("d"=>"limone", "e"=>25, 1=>"indice numerico 1", "a"=>"arancia", "f"=>8, "b"=>"banana", "c"=>"mela", 0=>"indice numerico 0", "indice numerico 2");</b>',$nl,$nl;

echo '<b>krsort($frutta);</b>',$nl;
krsort($frutta);
/*
reset($frutti);
while (list($chiave, $valore) = each($frutti)) {
    echo "$chiave = $valore\n";
}
*/
print_r($frutta);
?>
</pre>
        
        <hr />
        
        <h2 id="natsort">natsort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.natsort.php" title="natsort" target="_blank">natsort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>natsort()</strong> ordina un array usando un algoritmo di "ordine naturale". Questa funzione implementa un algoritmo di ordinamento che 
            ordina le stringhe alfanumeriche come lo farebbe un essere umano, mantenendo l'associazione chiavi/valori. Questo è chiamato "ordine naturale".</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool natsort ( array &$array )</pre>
        
        <h3 class="esempio">Esempio di PHP.net</h3>
        <p>Un esempio della differenza tra questo algoritmo e quello normalmente usato dai computer (usato in sort()) è dato qui sotto:</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$array1 = $array2 = array("img12.png", "img10.png", "img2.png", "img1.png");

sort($array1);
echo "Ordinamento standard con sort\n";
print_r($array1);

natsort($array2);
echo "\nOrdinamento naturale con natsort\n";
print_r($array2);
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$array1 = $array2 = array("img12.png", "img10.png", "img2.png", "img1.png");

sort($array1);
echo "<b>Ordinamento standard con 'sort'</b>\n";
print_r($array1);

natsort($array2);
echo "\n<b>Ordinamento naturale con 'natsort'</b>\n";
print_r($array2);
?>
</pre>
        
        <hr />
        
        <h2 id="usort">usort()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.usort.php" title="usort" target="_blank">usort()</a> di PHP.net in Arrays / Array Functions</p>
        <p>Ordina i valori di un array mediante una funzione di comparazione definita dall'utente. Se si vuole ordinare un array con dei criteri non usuali, 
            si deve usare questa funzione.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: <b>Se due parametri vengono valutati come uguali, il loro ordinamento nell'array ordinato 
                è indefinito.</b> Fino al PHP 4.0.6 le funzioni definite dall'utente mantenevano l'ordine originario per questi elementi, ma 
                con il nuovo algoritmo di ordinamento introdotto con la versione 4.1.0 questo non succede dal momento che non c'è un modo per ottenerlo in maniera efficiente.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>bool usort ( array &$array , callable $value_compare_func )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><strong>array</strong> - The input array;</p></li>
            <li>
                <p><strong>value_compare_func</strong> - <strong>La funzione di comparazione</strong> deve restituire un intero minore, uguale o superiore a zero se il primo elemento è 
                    da considerarsi rispettivamente minore, uguale o maggiore del secondo:</p>
                
                <div style="margin: 10px 0px;">
                    <table>
                        <caption class="codice">int callback ( mixed $a, mixed $b )</caption>
                        <thead>
                            <tr>
                                <th>Primo Elemento</th>
                                <th>Operatore</th>
                                <th>Secondo Elemento</th>
                                <th>(int) callback</th>
                                <th>Funzione di Comparazione</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$a</td>
                                <td>&lt;</td>
                                <td>$b</td>
                                <td>-1</td>
                                <td rowspan="3">
<pre style="text-align: left;margin:0px;padding: 5px 20px 5px 5px;">
function confronta($a, $b){
    // Se $a =  $b
    if ($a==$b) return 0

    // Operatore Ternario
    return ($a < $b) ? -1 : 1;
}
</pre>
                                </td>
                            </tr>
                            <tr>
                                <td>$a</td>
                                <td>=</td>
                                <td>$b</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>$a</td>
                                <td>&gt;</td>
                                <td>$b</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <p style="margin: 10px 0px;">Note that before PHP 7.0.0 this integer had to be in the range from -2147483648 to 2147483647 (Integer Unsigned 32 Bit).</p>
                
                <p>Attenzione: I valori in un'espressione di comparazione, sono convertiti (casting) in integer (int 32 bit, Nelle versioni precedenti a PHP 7.0.0.). 
                    Per esempio, i numeri a virgola mobile (float) 0.99 (Primo Elemento) and 0.1 (Secondo Elemento) saranno convertiti (cast) in numeri interi (int), 
                    entrambi assumeranno valore 0 (ZERO). Quindi il risultato dell'espressione di comparazione restituirà 0.</p>                                
                <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Attenzione: Returning non-integer values from the comparison function, such as float, 
                    will result in an internal cast to integer of the callback's return value. <b>So values such as 0.99 and 0.1 will both be cast to an integer value of 0, 
                    which will compare such values as equal</b>.</p>
            </li>
        </ul>
        
        <h3 class="celeste">Valore restituito</h3>
        <p>Restituisce <b>TRUE</b> in caso di successo, <b>FALSE</b> in caso di fallimento.</p>
        
        <h3 class="esempio">Esempio da PHP.net</h3>
        
        <h4>Codice</h4>
        
<pre>
<?php
$codice = <<< 'CODICE'
<?php
function cmp($a, $b){
    // Istruzione condizionale
    if ($a == $b) return 0;
    
    // Operatore Condizionale Ternario
    return ($a < $b) ? -1 : 1;
}

// Array
$a = array(3, 2, 5, 6, 1);

// Ordina con user defined function
usort($a, "cmp");

// Cicla tutto l'Array
while (list($chiave, $valore) = each($a))
    echo "$chiave: $valore\n";
?>
CODICE;

        echo htmlspecialchars($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
        
<pre>
<?php
function cmp($a, $b){
    // Istruzione condizionale
    if ($a == $b) return 0;
    
    // Operatore Condizionale Ternario
    return ($a < $b) ? -1 : 1;
}

// Array
$a = array(3, 2, 5, 6, 1);

// Ordina con user defined function
usort($a, "cmp");

// Cicla tutto l'Array
while (list($chiave, $valore) = each($a))
    echo "$chiave: $valore\n";            
?>
</pre>
        
        <hr />
        
        <h2 id="array_sum">array_sum()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.array-sum.php" title="array_sum" target="_blank">array_sum()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>array_sum()</strong> restituisce la somma dei valori dell'array sotto forma di integer o float.</p>
        
        <p class="codice">Nota: Le versioni di PHP antecedenti alla 4.2.1 modificavano l'array stesso e 
            convertivano le stringhe in numeri (le quali erano convertite in zeri la maggior parte delle volte, a seconda dal valore).</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>number array_sum ( array $array )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><strong>array</strong> - input array;</li>
        </ul>
        
        <h3 class="esempio">Esempio di PHP.net</h3>
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$a = array(2, 4, 6, 8);
echo "sum(a) = " . array_sum($a) . "\n";

$b = array("a" => 1.2, "b" => 2.3, "c" => 3.4);
echo "sum(b) = " . array_sum($b) . "\n";
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$a = array(2, 4, 6, 8);
echo '<b>$a = array(2, 4, 6, 8);</b>',$nl;
echo "array_sum(\$a) = " . array_sum($a) . "\n";

$b = array("a" => 1.2, "b" => 2.3, "c" => 3.4);
echo $nl,'<b>$b = array("a" => 1.2, "b" => 2.3, "c" => 3.4);</b>',$nl;
echo "array_sum(\$b) = " . array_sum($b) . "\n";

?>
</pre>
        
        <hr />
        
        <h2 id="array_merge">array_merge()</h2>
        <p class="codice">Reference <a href="http://php.net/manual/it/function.array-merge.php" title="array_merge" target="_blank">array_merge()</a> di PHP.net in Arrays / Array Functions</p>
        <p>La funzione <strong>array_merge()</strong> fonde gli elementi di uno o più array in modo che i valori di un array siano accodati a quelli dell'array precedente. Restituisce l'array risultante.</p>
        <p style="margin: 10px 0px;"><span style="color: red;font-weight: bold;">Se viene specificato un solo array, e questo è indicizzato numericamente, le chiavi (gli indici numerici) 
            vengono reindicizzate in una sequenza continua. Nel caso di array associativi, delle chiavi duplicate rimane solo l'ultima.</span> 
            Vedere l'esempio tre per ulteriori dettagli.</p>
        
        <p style="font-weight: bold;margin: 10px 0px;">Differentemente dalle chiavi stringa (chiavi associative), gli elementi con indici numerici che hanno valori uguali 
            non sono sovrascritti ma accodati.</p>
        
        <p class="codice">Nota: Gli array originali specificati non vengono modificati.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>array array_merge ( array $array1 [, array $... ] )</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><strong>array1</strong> - Array iniziale da fondere;</li>
            <li><strong>array...</strong> - <strong>[opzionale]</strong> Elenco degli altri Array da fondere.</li>
        </ul>
        
        <h3 class="esempio">Esempio 1 - PHP.net</h3>
        <p>Se gli array in input hanno le stesse chiavi stringa (chiavi associative), l'ultimo valore di quella chiave sovrascriverà i valori 
            delle precedenti chiavi stringa uguali, verrà restituito solo l'ultimo valore il quale occuperà il posto dell'elemento della prima chiave stringa sovrascritta. 
            Diversamente, se gli array da fondere hanno le stesse chiavi numeriche, l'ultimo valore non sovrascriverà quello precedente, bensì sarà accodato.</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$array1 = array("colore" => "rosso", 2, 4);
$array2 = array("a", "b", "colore" => "verde", "forma" => "trapezio", 4);
$risultato = array_merge($array1, $array2);
print_r($risultato);
?>
CODICE;

    echo htmlentities($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$array1 = array("colore" => "rosso", 2, 4);
$array2 = array("a", "b", "colore" => "verde", "forma" => "trapezio", 4);
$risultato = array_merge($array1, $array2);
print_r($risultato);
?>
</pre>
        
        <h3 class="esempio">Esempio 2 - PHP.net</h3>
        <p style="background-color: yellow;padding: 5px;"><strong>Chiavi Numeriche Rinumerate</strong> - Non dimenticarsi che le chiavi numeriche saranno rinumerate!</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$array1 = array();
$array2 = array(3 => "dati");
$result = array_merge($array1, $array2);
?>
CODICE;

    echo htmlentities($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$array1 = array();
$array2 = array(3 => "dati");
$result = array_merge($array1, $array2);
print_r($result);
?>
</pre>
        
        <p style="color: white;background-color: green;padding: 5px;">Per <strong>Preservare gli Indici Numerici NON USARE la funzione array_merge()</strong> - 
            Se si vogliono preservare gli array e li si vuole solo concatenare, <strong>usare l'operatore +</strong><br />
            La chiave numerica sarà preservata e così pure l'associazione.</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$array1 = array();
$array2 = array(3 => "dati");
$result = $array1 + $array2;
?>
CODICE;

    echo htmlentities($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$array1 = array();
$array2 = array(3 => "dati");
$result = $array1 + $array2;

print_r($result);
?>
</pre>
        <h3 class="esempio">Esempio 3 - PHP.net</h3>
        <p style="background-color: yellow;padding: 5px;">Nel caso di <strong>array associativi</strong>, delle chiavi duplicate rimane solo l'ultima. 
            Le chiavi condivise verranno sovrascritte dalla prima chiave processata, ovvero l'ultimo valore sarà l'unico valore e prenderò il posto della prima chiave trovata.</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$array_uno = array(0 => "mario", 1 => "roberto", 2 => "andrea", 3 => "dante");
$array_due = array("mario => "mario", "andrea" => "dante", "mario" => "giacomo");

// Viene eleminato l'elemento 3 [indice [2]=andrea]
unset($array_uno[2]);

// array_merge() rindicizza gli indici quindi in $array_uno() 'dante' diventa [2]
$risultato_uno = <b>array_merge($array_uno)</b>;
$risultato_due = <b>array_merge($array_due)</b>;

print_r($risultato_uno);
print_r($risultato_due);

$result = array_merge($array_uno, $array_due);
?>
CODICE;

    echo htmlentities($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$array_uno = array(0 => "mario", 1 => "roberto", 2 => "andrea", 3 => "dante");
$array_due = array("mario" => "mario", "andrea" => "dante", "mario" => "giacomo");

// Viene eleminato l'elemento 3 [indice [2]=andrea]
unset($array_uno[2]);

echo '// $risultato_uno = <b>array_merge($array_uno)</b>;',$nl;
echo '// array_merge() rindicizza gli indici quindi dante diventa [2]',$nl;
$risultato_uno = array_merge($array_uno);
print_r($risultato_uno);

echo $nl,'$risultato_due = <b>array_merge($array_due)</b>;',$nl;
$risultato_due = array_merge($array_due);
print_r($risultato_due);

echo $nl,'<b>$result = array_merge($array_uno, $array_due);</b>',$nl;
$result = array_merge($array_uno, $array_due);
print_r($result);
?>
</pre>
        
</body>
</html>