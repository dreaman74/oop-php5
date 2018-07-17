<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 36 - Array Associativi, Numerici e Riordinamento degli Indici - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 36</strong>
	</p>
	
	<h1>[36] Array Associativi, Numerici e Riordinamento degli Indici - parte 3 di 8</h1>

        <p>in questa lezione:</p>
        <ol>
            <li>Array con Chiave Associativa</li>
            <li>Array con Indice Numerico</li>
            <li>Creare o Modificare un Array con la forma contratta delle Parentesi Quadre</li>
            <li>Autoincremento degli Indici Numerici</li>
            <li>array_values() - Riordina gli Indici Numerici</li>
            <li>array_keys() - Restituisce tutti gli indici e chiavi associative compresi i subset di chiavi</li>
            <li>array_key_exists - Checks if the given key or index exists in the array</li>
            <li>array_search - Searches the array for a given value and returns the first corresponding key if successful</li>
            <li>Recuperare il numero degli elementi di un Array</li>
        </ol>
        
        <p>Riferimenti Utili di PHP.net</p>
        <ul>
            <li><p>ciclo <b>for</b> cosa sono - PHP.net Reference (Types) 
                    <a href="http://php.net/manual/en/language.types.array.php" title="Cosa sono gli Array">http://php.net/manual/en/language.types.array.php</a></p></li>
            <li><p>ciclo <b>foreach</b> esempi vari - PHP.net Reference (Arrays / Array Functions) 
                    <a href="http://php.net/manual/en/control-structures.foreach.php" title="foreach degli Array" target="_blank">http://php.net/manual/en/control-structures.foreach.php</a></p></li>
            <li><p><a href="http://php.net/manual/en/function.array.php" title="array functions" target="_blank">Funzioni per gli Array</a></p>
        </ul>

        <hr />

        <h2>Array con Chiave Associativa</h2>
        <p>Negli Array Associativi, gli elementi sono salvati con coppie di chiavi (alfanumeriche) / valori. Pertanto la ricerca non si effettua ricercando l'indice numerico, ma in
            base alla chiave associata.</p>
        
        <h3 class="esempio">Numero dei Giorni in un mese Mese</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
// Array con Chiave Associativa
$GiorniDelMese = array('Gennaio'=>31, 'Febbraio'=>28, 'FebbraioBisesitile'=>29, 'Marzo'=>31);
// Accedere all'elemento, indicando la chiave associativa
echo $GiorniDelMese['Marzo'];
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h2>Array con Indice Numerico</h2>
        <h3 class="esempio">Numero dei Giorni in un mese Mese</h3>
        <h4>Codice</h4>                
<?php
$codice = <<< 'CODICE'
// Array con Indice Numerico
$GiorniDelMese2 = array(31,28,29,31);
// Recuperare l'elemento con indice numerico usando la rappresentazione a chiave associativa (stringa)
echo $GiorniDelMese2['0'];
// Recuperare l'elemento con chiave numerica
echo $GiorniDelMese2[0];
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
                
        <h2>Riferimento ad un Indice Numerico o Chiave Associativa non presente</h2>
        <p style="color: white;background-color: red;padding: 5px;">Un riferimento ad un indice numerico o chiave non validi procura il seguente messaggio di NOTICE_E:</p>
        
        <h3>Riferimento ad un indice e chiave non presenti</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
$GiorniDelMese = array('Gennaio'=>31, 'Febbraio'=>28, 'FebbraioBisesitile'=>29, 'Marzo'=>31);
echo $GiorniDelMese['Maggio'];
echo $GiorniDelMese[5];
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        
<?php
$GiorniDelMese = array('Gennaio'=>31, 'Febbraio'=>28, 'FebbraioBisesitile'=>29, 'Marzo'=>31);

echo '<pre>';
echo $GiorniDelMese['Maggio'];
echo $GiorniDelMese[5];
echo '</pre>';
?>
        <h2>Creare un Array</h2>
        <p>Dal PHP 5.4 è possibile utilizzare la forma contratta per creare e/o modificare un elemento di un Array, utilizzando le Parentesi Quadre (Square Brackets)</p>
<?php
$codice = <<< 'CODICE'
// Nuovo Array con Indice Numerico [0]
$GiorniDelMese3[] = 31;

// Non è obbligatorio iniziare dal primo indice, quando si crea un Array
// Primo Indice Numerico è 5 -> Giugno
$GiorniDelMese4[5] = 30;

// Nuovo Array con Chiave Associativa
$GiorniDelMese5['Gennaio'] = 31;

// Oppure Iniziare da una qualsiasi Chiave Associativa
$GiorniDelMese6['Settembre'] = 30;
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h2>Creare Array con Indice Numerico con Incremento Automatico</h2>
        <p>Non specificando l'indice tra le parentesi quadre, PHP autoincrementerà l'indice. Quando si crea il primo elemento, nel caso in cui non si specifichi l'indice,
            il numero assegnato per l'indice stesso sarà 0.</p>
        <p style="background-color: yellow;margin: 10px 0px;padding:5px;">Con l'autoincremento, l'indice numerico è dato dalla somma di 1 + l'indice numerico precedente con 
        valore più alto.</p>
        <p>Il valore dell'indice può essere assegnato nei seguenti modi:</p>
<?php
$codice = <<< 'CODICE'
// [OPZIONALE] Specificare Primo Indice 0
// Se omesso il PHP assegnerà il numero 1 (integer) al primo indice numerico
$arrNumerico[] = 'Primo indice 0';

// [OPZIONALE] Specifiare gli Indici Successivi
// Per aggiungere altri indici numerici, non è obbligatorio specificare il numero
// PHP preleverà l'indice Numerico più alto e lo incrementerà di 1
$arrNumerico[] = 'Secondo indice 1';
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h3 class="celeste">Indice Numerico con Incremento Automatico</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$arrNumerico[] = 'Primo indice 0'; // Autoincremtento
$arrNumerico[] = 'Secondo indice 1'; // Autoincremtento
$arrNumerico[] = 'Terzo indice 2'; // Autoincremtento
$arrNumerico[7] = 'Ottavo indice 7'; // Indice Specificato Esplicitamente
$arrNumerico[] = 'Nono indice 8'; // Autoincremtento
?>
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
// Azzera Array
$arrNumerico = array();

$arrNumerico[] = 'Primo indice 0';
$arrNumerico[] = 'Secondo indice 1';
$arrNumerico[] = 'Terzo indice 2';
$arrNumerico[7] = 'Ottavo indice 7';
$arrNumerico[] = 'Nono indice 8';

echo '<pre>';
print_r($arrNumerico);
echo '</pre>';
?>
        <hr />
        
        <h2 id="array_values">array_values</h2>
        <p style="margin: 10px 0px;">La funzione <b>array_values()</b> riorganizza e resetta (partendo da Indice 0), gli indici numerici di un Array.</p>
        
        <p>Per approfondimenti, vedi anche:</p>
        <ul>
            <li><p>Vedi anche <a href="lezione-34-array-1.php#array_values" title="array_values()">array_values()</a> nella lezione 34;</p></li>
            <li><p>La Reference di PHP.net su <a href="http://php.net/manual/en/function.array-values.php" title="array_values() su PHP.net" target="_blank">array_values()</a> .</p></li>            
        </ul>        
       
        <p style="background-color: yellow;margin: 10px 0px;padding:5px">NOTA: Con <b>unset()</b>, si eliminano gli elementi, ma l'indice non viene riorganizzato: utilizzare la funzione <b>array_values()</b> per riorganizzare l'indice numerico.</p>
        <p style="background-color: yellow;margin: 10px 0px;padding:5px">NOTA: Quando si invoca la funzione array_values(), le chiavi associative sono convertite in Indici Numerici.</p>
        
        <h3 class="esempio">Ordinamento degli indici numerici</h3>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
<?php
$arrNumerico[2] = 'Terzo indice 2';
$arrNumerico[] = 'Quarto indice 3';
$arrNumerico['nome'] = 'Francesco';
$arrNumerico[] = 'Quinto indice 4';
$arrNumerico[7] = 'Ottavo indice 7';
$arrNumerico['Cognome'] = 'Tomei';
$arrNumerico[] = 'Nono indice 8';

// Prima dell'invocazione di array_values()
print_r($arrNumerico);

// array_values()
// Riordina gli Indici e converte le Chiavi Associative precedenti in Indici Numerici
$arrNumerico = array_values($arrNumerico);
print_r($arrNumerico);
?>
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$nl = '<br />';
// Azzera Array
$arrNumerico = array();

$arrNumerico[2] = 'Terzo indice 2';
$arrNumerico[] = 'Quarto indice 3';
$arrNumerico['nome'] = 'Francesco';
$arrNumerico[] = 'Quinto indice 4';
$arrNumerico[7] = 'Ottavo indice 7';
$arrNumerico['Cognome'] = 'Tomei';
$arrNumerico[] = 'Nono indice 8';

echo '<pre>';

echo '<b>Prima dell\'invocazione di array_values()</b>',$nl;
print_r($arrNumerico);

echo $nl,'<b>array_values()</b>',$nl;
echo 'Riordina gli Indici e converte le Chiavi Associative precedenti in Indici Numerici',$nl;
$arrNumerico = array_values($arrNumerico);
print_r($arrNumerico);

echo '</pre>';
?>
        
        <hr />
        
        <h2 id="array_keys">array_keys</h2>
        <p><a href="http://php.net/manual/en/function.array-keys.php" title="array_keys su PHP.net" target="_blank">array_keys()</a> su PHP.net</p>
        <p style="margin:10px 0px;">La funzione ritorna tutte le chiavi assoicative e indici numerici, compresi i subset, di un array.</p>
        
        <h3 class="celeste">Sintassi</h3>
<pre>
array array_keys ( array $array [, mixed $search_value = null [, bool $strict = false ]] )
</pre>
       
        <hr />
        
        <h2 id="array_key_exists">array_key_exists()</h2>
        <p><a href="http://php.net/manual/en/function.array-key-exists.php" title="array_key_exists su PHP.net" target="_blank">array_key_exists()</a> su PHP.net</p>
        <p style="margin: 10px 0px;">Checks if the given key or index exists in the array.</p>
        
        <hr />
        
        <h2 id="array_search">array_search()</h2>
        <p><a href="http://php.net/manual/en/function.array-search.php" title="array_search su PHP.net" target="_blank">array_search()</a> su PHP.net</p>
        <p style="margin: 10px 0px;">Searches the array for a given value and returns the first corresponding key if successful.</p>
        
        <hr />
        
        <h2>Numero di Elementi di un Array</h2>
        <p>&Egrave; possibile recuperare il numero di elementi presenti in un Array utilizzando una delle 2 Funzioni per gli Array seguenti:</p>
        
        <h3 class="celeste">count()</h3>
        <p><a href='http://php.net/manual/en/function.count.php' title="count() su PHP.net" target="_blank">count()</a> su PHP.net</p>
        
        <h3 class="celeste">sizeof()</h3>
        <p><a href="http://php.net/manual/en/function.sizeof.php" title="sizeof() su PHP.net" target="_blank">sizeof()</a> su PHP.net</p>
        
</body>
</html>