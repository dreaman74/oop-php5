<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 38 - Array - Le Funzioni Built-in 1 di 4 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	ol,ul{line-height:1.5em;}
	
        h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;}
        p {margin:0px;padding:0px;}
	
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
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 38</strong>
	</p>
	
	<h1>[38] Array (5 di 8) - Le Funzioni Built-in 1 di 4</h1>
        <p>Riprendiamo la carrellata delle funzioni predefinite per gli array già iniziata prima della parentesi sul ciclo for/foreach</p>
        <ul>
            <li><p><a href="#range" title="la funzione range() built-in di PHP">range()</a> - crea un array di elementi, i cui valori sono rappresentati da uno specifico intervallo;</p></li>
            <li><p><a href="#array_pad" title="la funzione array_pad() built-in di PHP">array_pad()</a> - Crea una copia dell'Array gonfiato di nuovi elementi con un valore specificato;</p></li>
            <li><p><a href="#list" title="la funzione list() built-in di PHP">list()</a>;</li>
        </ul>
        
        <hr />
        
        <h2 id="range">range()</h2>
        <p>Reference <a href="http://php.net/manual/en/function.range.php" title="" target="_blank">range()</a> di PHP.net in Arrays / Array Functions</p>
        <p style="margin:10px 0px;">La funzione <b>range()</b> crea un array di elementi con una sequenza di numeri o caratteri, dato un intervallo composto da un valore iniziale e finale.</p>
        
        <h3 class="celeste">Sintassi</h3>
<pre>
array range ( mixed $start , mixed $end [, number $step = 1 ] )
</pre>
        
        <h3 class="celeste">Argomenti</h3>
        <ul>
            <li><p><b>start</b> - Valore Iniziale dell'intervallo;</p></li>
            <li><p><b>end</b> - Valore Finale dell'intervallo (La sequenza viene terminata al raggiungimento del valore finale)</p></li>
            <li><p><b>step</b> - [opzionale] (<b>Valore di DEFAULT 1</b>) Se specificato, <b>indica l'incremento della sequenza tra il vaore iniziale e finale.</b>. 
                    Il valore di STEP dovrebbe essere positivo.</p></li>
        </ul>

        <h3 class="celeste">Valore Restituito</h3>
        <p>Restituisce un Array di Elementi con un intervallo di valori, compresi quello iniziale e finale.</p>
        
        <h3 class="esempio">Esempi Vari</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
// array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
foreach (range(0, 12) as $number) {
    echo $number;
}

// The step parameter
// array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100)
foreach (range(0, 100, 10) as $number) {
    echo $number;
}

// Usage of character sequences
// array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i');
foreach (range('a', 'i') as $letter) {
    echo $letter;
}

// array('c', 'b', 'a');
foreach (range('c', 'a') as $letter) {
    echo $letter;
}
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>

        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = '<br />';
$trattini = str_repeat('-', 70);

echo $trattini,$nl,'// Crea un Array di elementi con valori numerici',$nl,$trattini,$nl;
echo '<b>// range(0, 12)</b>',$nl;
print_r(range(0, 12));

echo $trattini,$nl,'// Crea un Array di elementi specificando l\'indice numerico e rispettivi valori numerici',$nl,$trattini,$nl;
echo '<b>//array_combine(range(11,14),range(1,4))</b>',$nl;
print_r(array_combine(range(11,20),range(1,10)));

echo $trattini,$nl,'// Utilizzo di una sequenza di caratteri in ordine alfabetico',$nl,$trattini,$nl;
echo '<b>// range(\'a\', \'i\')</b>',$nl;
print_r(range('a', 'i'));

echo $trattini,$nl,'// Crea un Array con una sequenza di caratteri in ordine inverso',$nl,$trattini,$nl;
echo '<b>// range(\'e\', \'a\')</b>',$nl;
print_r(range('e', 'a'));

echo $trattini,$nl,'// Viene restituita solo la prima lettera della sequenza di caratteri',$nl,$trattini,$nl;
echo '<b>// range(\'Bari\', \'Milano\')</b>',$nl;
print_r(range('Bari', 'Milano'));

echo $trattini,$nl,'-- Uso di STEP - Valido sia per Sequenze di Numeri sia di Caratteri --',$nl,$trattini,$nl;

echo $trattini,$nl,'// Crea un Array di elementi con intervallo numerico, con uno STEP di 10',$nl,$trattini,$nl;
echo '<b>// range(0, 100, 10)</b>',$nl;
print_r(range(0, 100, 10));

echo $trattini,$nl,'// Utilizzo di una sequenza di caratteri in ordine alfabetico con STEP di 5',$nl,$trattini,$nl;
echo '<b>// range(\'a\', \'z\', 5)</b>',$nl;
print_r(range('a', 'z', 5));

echo $trattini,$nl,'// Utilizzo di una sequenza di caratteri in ordine inverso con STEP di 5',$nl,$trattini,$nl;
echo '<b>// range(\'z\', \'a\', 5)</b>',$nl;
print_r(range('z', 'a', 5));
?>
</pre>
        
    <p style="background-color: yellow;margin-bottom: 10px;padding: 5px;"><b>NOTA:</b> Le sequenze di caratteri sono limitate alla lunghezza di uno, ogni elemento contiene stringhe composte da un carattere. 
        Se viene specificata una lunghezza maggiore, la sequenza conterrà solo il primo carattere.</p>

    <h3 class="esempio">Esempio con Caratteri ASCII</h3>

    <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
$nl = '<br />';
$arrCharASCII = range(chr(0), chr(255));
    foreach($arrCharASCII as $carattere)
        echo utf8_encode($carattere).$nl;
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
    <h4>Visualizzato nel Browser</h4>
<p class='codice'>
<?php
$nl = '<br />';
$arrCharASCII = range(chr(0), chr(255));
foreach($arrCharASCII as $carattere)
    echo utf8_encode($carattere),' ' ;
?>
</p>
    <p style="background-color: yellow;padding: 5px;"><b>NOTA:</b> <b>utf8_encode</b> Converte il Character Set di una stringa con Codifica ISO-8859-1 a una UTF-8 (utilizzando il Character Set in standard Unicode).</p>
    
    <hr />
    
    <h2 id="array_pad">array_pad()</h2>
    <p>Reference <a href="http://php.net/manual/en/function.array-pad.php" title="array_pad" target="_blank">array_pad()</a> di PHP.net in Arrays / Array Functions</p>
    <p style="margin:10px 0px;">La funzione <b>array_pad()</b> restituisce una copia dell'Array gonfiata di tanti elementi, contenente il valore specificato, quanti indicati. 
    Il Numero di elementi da aggiungere, comprende anche quelli esistenti - il valore di questi ultimi resterà invariato.</p>

    <h3 class="celeste">Sintassi</h3>
<pre>
array array_pad ( array $array , int $size , mixed $value )
</pre>

    <h3 class="celeste">Argomenti</h3>
    <ul>
        <li><p><b>array</b> - Array Iniziale da gonfiare;</p></li>
        <li><p><b>size</b> - (iniziando a contare da 1) il numero di elementi totali che comporranno l'Array, compresi quelli esistenti. 
                <b>Anteponendo il segno meno a SIZE, il padding viene fatto alla sinistra degli elementi esistenti</b>;</p></li>
        <li><p><b>value</b> - Il valore contenuto negli elementi da aggiungere.</p></li>
    </ul>
    <p style="background-color: yellow;padding: 5px;">NOTA: Se SIZE è inferiore o uguale al numero di elementi presenti nell'Array da gonfiare, nessun elemento sarà aggiunto.</p>

    <h3 class="celeste">Valore Restituito</h3>
    <p>Restituisce una copia dell'Array riempito con il numero di elementi specificato (size) Returns a copy of the array padded to size specified by size with value value. If size is positive then the array is padded on the right, if it's negative then on the left. 
        If the absolute value of size is less than or equal to the length of the array then no padding takes place.</p>

    <h3 class="esempio">Esempi Vari</h3>
    
    <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$input = array(12, 10, 9);

$result = array_pad($input, 5, 0);
// result is array(12, 10, 9, 0, 0)

$result = array_pad($input, -7, -1);
// result is array(-1, -1, -1, -1, 12, 10, 9)

$result = array_pad($input, 2, "noop");
// not padded
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
    
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = '<br />';
$trattini = str_repeat("-", 70);

echo $trattini,$nl,'<b>Dato un Array > array(12, 10, 9)</b>',$nl,$trattini,$nl;
$input = array(12, 10, 9);
print_r($input);
echo $trattini,$nl,$nl;

echo '# Array composto da 5 elementi, gli elementi aggiunti a destra conterranno il valore 0',$nl;
echo '<b>array_pad($input, 5, 0)</b>',$nl;
print_r(array_pad($input, 5, 0));

echo $nl,'# Array composto da 7 elementi, gli elementi aggiunti a sinistra conterranno il valore -1',$nl;
echo '<b>array_pad($input, -7, -1)</b>',$nl;
print_r(array_pad($input, -7, -1));
// result is array(-1, -1, -1, -1, 12, 10, 9)

echo $nl,'# Array composto da 3 elementi, non saranno aggiunti o sottratti elementi',$nl,'# perché il valore di size è inferiore agli elementi dell\'Array da gonfiare.',$nl;
echo '<b>array_pad($input, 2, "noop")</b>',$nl;
print_r(array_pad($input, 2, "noop"));
// not padded
?>
</pre>
    
    <h3 class="esempio">Altri Esempi di PHP.net</h3>
    <p style='background-color: yellow;padding: 5px;'><b>Attenzione:</b> Se si prova ad effettuare il padding su un Array Associativo, senza indici numerici, 
        gli elementi di padding avranno l'indice numerico partendo da 0. Invece, effettuando il padding su un Array misto, indici numerici e chiavi associative, 
        gli elementi con indice numerico esistenti saranno rindicizzati partendo da 0, gli indici dei nuovi elementi di padding seguiranno la numerazione, 
        invece gli elementi a chiave associativa esistenti non subiranno modifiche e spostamenti.</p>
    
    <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$nl = '<br />';
$trattini = str_repeat("-", 70);

echo "<b># Array Originale:</b>$nl";
echo "<b># \$a = array('size'=>'large', 'number'=>20, 'color'=>'red')</b>",$nl;
$a = array('size'=>'large', 'number'=>20, 'color'=>'red');
print_r($a);
echo "<b># Padding: array_pad(\$a, 5, 'foo')</b>",$nl;
print_r(array_pad($a, 5, 'foo')); 

echo $trattini,$nl;
        
echo "<b># Array Originale con Timestamp per indice numerico:</b>$nl";
echo "<b># \$b = array(1229600459=>'large', 1229604787=>20, 1229609459=>'red')</b>",$nl;
$b = array(1229600459=>'large', 1229604787=>20, 1229609459=>'red');
print_r($b);
echo "<b># Padding: array_pad(\$b, 5, 'foo')</b>",$nl;
print_r(array_pad($b, 5, 'foo'));

echo $trattini,$nl;

echo "<b># Array Originale con elementi a chiave associativa e indici numerici disordinati:</b>$nl";
echo "<b># \$c = array(2=>'primo valore con indice numerico 2','nome'=>'Francesco',5=>'secondo valore con indice numerico 5','cognome'=>'Tomei');</b>",$nl;
$c = array(
    2=>'primo valore con indice numerico 2',
    'nome'=>'Francesco',
    5=>'secondo valore con indice numerico 5',
    'cognome'=>'Tomei');
print_r($c);
echo "<b># Padding con SIZE POSITIVO: array_pad(\$c, 6, 'foo')</b>",$nl;
print_r(array_pad($c, 6, 'foot'));
echo "<b># Padding con SIZE NEGATIVO: array_pad(\$c, -10, 'foo')</b>",$nl;
print_r(array_pad($c, -10, 'foo'))
?>
</pre>
    
    <hr />
    
    <h2 id="list">list()</h2>
    <p>Per approfondimenti, guarda anche:</p>
    <ul>
        <li><p>La funzione <a href="http://php.net/manual/en/function.list.php" title="Funzione built-in list() per gli Array" target="_blank">list()</a>, 
                sulla reference di PHP.net</p></li>
        <li><p>Altri esempi sulla funzione <a href="lezione-34-array-1.php#list" title="array_values()">list()</a> nella lezione 34 della presente guida.</p></li>
    </ul>
    <p>Contiene una lista di variabili i cui valori sono rappresentati dagli elementi dell'Array specificato. La funzione list() recupera i valori solo dagli elementi con indice numerico.
        <b>Se l'indice 0 non è presente, in list() inserire un offset vuoto come prima variabile (specificare solo la virgola) nell'elenco delle variabili stesse. 
            Per gli altri indici mancanti, inserire un offest vuoto in corrispondenza dell'indice mancante.</b>
    <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Differentemente dai linguaggi tradizionali, e fortemente tipicizzati, (come C++, etc.) i tipi di dati contenuto negli elementi possono essere misti, 
        sia di tipo stringa sia numerico (float, integer, etc).</p>
    
    <h3 class="celeste">Sintassi</h3>
<pre>
array list ( mixed $var1 [, mixed $... ] )
</pre>
    
    <h3 class="esempio">Esempi Vari</h3>
    
    <h4>Codice e Visualizzazione nel Browser</h4>
<pre>
<?php
$trattini = str_repeat('-',70);
$nl = '<br />';

$arrCliente = array('Rossi', 'Mario', 45);
echo "// \$arrCliente = array('Rossi', 'Mario', 45);$nl";
print_r($arrCliente);

echo "$nl// list(\$cognome, \$nome, \$eta) = \$arrCliente;$nl";
list($cognome, $nome, $eta) = $arrCliente;
echo "\$cognome: $cognome$nl";
echo "\$nome: $nome$nl";
echo "\$eta: $eta";
// Eliminazione della variabili precedenti
unset($cognome, $nome, $eta);

echo $nl,$nl,$trattini,$nl,$nl;

// Resetto l'Array, assegnando un indice numerico arbitrario
$arrCliente = array();

$arrCliente = array(1=>'Rossi', 0=>'Mario', 45);
echo "// \$arrCliente = array(1=>'Rossi', 0=>'Mario', 45);$nl";
print_r($arrCliente);

echo "$nl// list(\$cognome, \$nome, \$eta) = \$arrCliente;$nl";
list($cognome, $nome, $eta) = $arrCliente;
echo "\$cognome: $cognome$nl";
echo "\$nome: $nome$nl";
echo "\$eta: $eta";
// Eliminazione della variabili precedenti
unset($cognome, $nome, $eta);

echo $nl,$nl,$trattini,$nl,$nl;

echo "<b>// Dato un intervallo con indici numerici mancanti (es. 0,1,2,5,7),$nl// in list inserire un offset vuoto ad ogni indice mancante.</b>$nl";
// Resetto l'Array
$arrCliente = array();
// Aggiungo elementi con indice numerico più basso pari a 2
echo "// \$arrCliente = array(8=>4.5, 'indice numerico 3', 2=>'indice numerico 2', 'indice numerico 4', -7, 2=>'indice 2 sovrascritto', 6=>45);$nl";
$arrCliente = array(8=>4.5, 'indice numerico 3', 2=>'indice numerico 2', 'indice numerico 4', -7, 2=>'indice 2 sovrascritto', 6=>45);
print_r($arrCliente);

echo "$nl// list(, , \$seconda, , , , \$sesta, , \$ottava, \$nona) = \$arrCliente;$nl";
list(, , $seconda, , , , $sesta, , $ottava, $nona) = $arrCliente;
echo "\$seconda: $seconda$nl";
echo "\$sesta: $sesta$nl";
echo "\$ottava: $ottava$nl";
echo "\$nona: $nona";
// Eliminazione della variabili precedenti
unset($seconda, $sesta, $ottava, $nona);

echo $nl,$nl,$trattini,$nl,$nl;

echo "<b>// Dato un Array con chiavi associative e indici numerici,$nl// gli elementi possono contenere tipi di dato scalari diversi</b>$nl";

// Resetto l'Array
$arrCliente = array();

// Aggiungo elementi con tipi di dato scalari misti e chiavi associative e indici numerici.
$arrCliente = array('civico'=>"Prima Chiave Associativa 'civico'", 3=>'indice numerico 3', 1=>'indice numerico 1', 0=>'indice numerico 0', 2=>'indice numerico 2');
print_r($arrCliente);

echo "{$nl}// list(\$prima, \$seconda, \$terza) = \$arrCliente;$nl";
list($prima, $seconda, $terza) = $arrCliente;
echo "\$prima: $prima$nl";
echo "\$seconda: $seconda$nl";
echo "\$terza: $terza";
// Eliminazione della variabili precedenti
unset($prima, $seconda, $terza);

echo "{$nl}{$nl}// con SEGNAPOSTO VUOTO [offset vuoto]$nl";
echo "// list(\$prima, , \$terza, \$quarta) = \$arrCliente;$nl";
list($prima, , $terza, $quarta) = $arrCliente;
echo "\$prima: $prima$nl";
echo "\$terza: $terza$nl";
echo "\$quarta: $quarta";
?>
</pre>
    
    <h3 class="esempio">Scorrere un Array con while e list</h3>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$frutti = array("limone", "arancia", "banana", "mela");
        
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
        
while (list($chiave, $valore) = each($frutti)) {
    echo "frutti[" . $chiave . "] = " . $valore . "\n";
}
?>
</pre>
    
    <h3 class="celeste">Vedi anche</h3>
    <ul>
        <li><a href="lezione-40-array-funzioni-built-in-7.php#each" title="funzione built.in each() di PHP per gli array">each()</a>.</li>
    </ul>
</body>
</html>