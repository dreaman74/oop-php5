<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 35 - Scorrere gli Array - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 35</strong>
	</p>
	
	<h1>[35] Scorrere gli Array - parte 2 di 8</h1>

        <ul>
            <li><p>ciclo <b>for</b> cosa sono - PHP.net Reference (Types) 
                    <a href="http://php.net/manual/en/language.types.array.php" title="Cosa sono gli Array">http://php.net/manual/en/language.types.array.php</a></p></li>
            <li><p>ciclo <b>foreach</b> esempi vari - PHP.net Reference (Arrays / Array Functions) 
                    <a href="http://php.net/manual/en/control-structures.foreach.php" title="foreach degli Array" target="_blank">http://php.net/manual/en/control-structures.foreach.php</a></p></li>
            <li><p><a href="http://php.net/manual/en/function.array.php" title="array functions" target="_blank">Funzioni per gli Array</a></p>
        </ul>

        <hr />

        <h2>Scorrere gli Array</h2>
        
        <h3>Creazione Array con Aliquote IRPEF</h3>
        <p>Fonte <b>Fisco e Tasse</b>: 
            <a href="https://www.fiscoetasse.com/approfondimenti/12069-scaglioni-e-aliquote-irpef-2014.html" title="Scaglioni e aliquote IRPEF" target="_blank">scaglioni e aliquote Irpef 2015 e 2016</a></p>

        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
$irpef = array(
    array("reddito" => 0, "aliquota" => 23),
    array("reddito" => 15000, "aliquota" => 27),
    array("reddito" => 28000, "aliquota" => 38),
    array("reddito" => 55000, "aliquota" => 41),
    array("reddito" => 75000, "aliquota" => 43)
    );

print_r($irpef);
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$irpef = array(
array("reddito" => 0, "aliquota" => 23),
array("reddito" => 15000, "aliquota" => 27),
array("reddito" => 28000, "aliquota" => 38),
array("reddito" => 55000, "aliquota" => 41),
array("reddito" => 75000, "aliquota" => 43)
);
        
echo '<pre>';
var_dump($irpef);
echo '</pre>';
?>
        <h3 class="esempio">for - scorrere un Array Bidimensionale</h3>
        <p><b>Il ciclo for è definito un ciclo enumerativo</b> perché basato sull'enumerazione del contatore (usando una variabile come indice da incrementare)
            (da un minimo ad un massimo, sapendo a priori quante volte il ciclo sarà eseguito).</p>
        <p style="margin: 10px 0px;font-weight: bold;">Esegue le istruzioni contenute, sino a quando l'espressione logica restituisce True.</p>
        
        <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
echo '<ul>';
// Contatore - Indice; Espressione Logica; operatore di postincremento (la variabile viene incrementata dopo che le istruzioni sono eseguite)
// COUNT_NORMAL (Default) conteggio non ricorsivo
for($indice=0; $indice < count($irpef, COUNT_NORMAL); $indice++)
    echo ($indice+1 < count($irpef)) ? 
    "<li>Reddito da {$irpef[$indice]['reddito']} a {$irpef[$indice+1]['reddito']} > Aliquota {$irpef[$indice]['aliquota']}%</li>" :
    "<li>Reddito da {$irpef[$indice]['reddito']} in su > Aliquota {$irpef[$indice]['aliquota']}%</li>";
echo '</ul>';
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
echo '<pre>';
echo '<ul>';
// Contatore - Indice; Espressione Logica; operatore di postincremento
// COUNT_NORMAL (Default) conteggio non ricorsivo
for($indice=0; $indice < count($irpef, COUNT_NORMAL); $indice++)
    echo ($indice+1 < count($irpef)) ? 
    "<li>Reddito da {$irpef[$indice]['reddito']} a {$irpef[$indice+1]['reddito']} > Aliquota {$irpef[$indice]['aliquota']}%</li>" :
    "<li>Reddito da {$irpef[$indice]['reddito']} in su > Aliquota {$irpef[$indice]['aliquota']}%</li>";
echo '</ul>';
echo '</pre>';
?>
        
    <h3 class="esempio">foreach - scorrere un Array Bidimensionale</h3>
    <p>Vari esempi <a href="http://php.net/manual/en/control-structures.foreach.php" title="foreach su PHP.net" target="_blank">foreach</a> su PHP.net Reference</p>
    
     <h4>Codice</h4>
<?php
$codice = <<< 'CODICE'
// Crea un nuovo Array - forma contratta.
// sovrascrivendo quello precedente - se presente - con lo stesso nome
$irpef = Array();
$irpef[]['reddito'] = 0;
$irpef[]['aliquota'] = 23;
$irpef[]['reddito'] = 15000;
$irpef[]['aliquota'] = 27;
$irpef[]['reddito'] = 28000;
$irpef[]['aliquota'] = 38;
$irpef[]['reddito'] = 55000;
$irpef[]['aliquota'] = 41;
$irpef[]['reddito'] = 75000;
$irpef[]['aliquota'] = 43;

echo '<ul>';
foreach($irpef as $arr){
    foreach ($arr as $chiave => $valore){
        echo "<li>$chiave > $valore</li>";
    }
}
echo '</ul>';
CODICE;
    
    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
     <h4>Visualizzato nel Browser</h4>
<?php
// Crea un nuovo Array - forma contratta.
// sovrascrivendo quello precedente - se presente - con lo stesso nome
$irpef = Array();
$irpef[]['reddito'] = 0;
$irpef[]['aliquota'] = 23;
$irpef[]['reddito'] = 15000;
$irpef[]['aliquota'] = 27;
$irpef[]['reddito'] = 28000;
$irpef[]['aliquota'] = 38;
$irpef[]['reddito'] = 55000;
$irpef[]['aliquota'] = 41;
$irpef[]['reddito'] = 75000;
$irpef[]['aliquota'] = 43;

echo '<pre>';
echo '<ul>';
foreach($irpef as $arr){
    foreach ($arr as $chiave => $valore){
        echo "<li>$chiave > $valore</li>";
    }
}
echo '</ul>';
echo '</pre>';
?>
</body>
</html>