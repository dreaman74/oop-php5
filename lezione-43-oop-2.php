<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 43 - OOP - Parte 2 di 10 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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

        form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
        
	ol,ul{line-height:1.5em;}
        li {line-height: 3em;}
	
        h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;}
        p {line-height: 1.5em;margin:0px;padding:0px;}

	table, th, td {border-collapse:collapse;padding:5px;}
	th {border: 1px solid red;text-align:center;}
	td {border: 1px solid grey;text-align:center;}

        pre, .codice {
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
        .codice {
            margin: 15px 0px;
        }
        
        .celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
        .esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
        
        .titolo_paragrafo {color:#224488;font-size:2.5em;}
        .sottotitolo_paragrafo {color:#44aaee;font-size:2em;}
        
        
</style>
</head>

<body>
<?php
include("include/utility.php");
include("include/array.php");
?>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 43</strong>
	</p>
	
	<h1>[43] Object Oriented Programming - Parte 2 di 10</h1>
        <ul>
            <li><p><a href="#incapsulamento" title="Introduzione alla Object Oriented Programming">Incapsulamento</a>;</p></li>
            <li><p>il puntatore e l'operatore <a href="#this" title="la prima classe in PHP">$this-></a>;</p></li>
        </ul>
        
        <hr />
        
        <h2 id="incapsulamento">Incapsulamento</h2>
        
        <p>L'<strong>incapsulamento</strong>, detto anche <b>Information Hiding</b>, è la capacità di un oggetto (istanza attiva di una classe) di nascondere al suo interno 
            i processi implementativi, metodi e proprietà specificate all'interno della classe attiva istanziata.</p>
        
        <h3 class="titolo_paragrafo">Indicatori di visibilità</h3>
        <p style="margin: 10px 0px;"><strong>Gli indicatori di visibilità</strong>, detti anche specificatori di accesso, identidificati con le keywords 
            <strong>private, protected e public</strong>, posti davanti ai membri della classe (proprietà, variabili membro, e metodi, funzioni), 
            <strong>si specifica l'ambito di visibilità del membro stesso</strong>: Aaccessibile solo nella classe stessa, accessibile nella classe e quelle derivate o 
            accessibile dall'esterno.</p>
        
        <p style="margin: 10px 0px;"><strong>gli indicatori di visibilità</strong> nelle <strong>proprietà &egrave; obbligatorio specificarli</strong>, 
                diversamente dai <strong>metodi</strong> che, <strong>se non specificati</strong> (in quanto non obbligatori), 
                <strong>di default assumono public</strong>.</p> 
        
        <p class="codice">Nota: &Egrave; <strong>sconsigliabile rendere le proprietà public</strong>, meglio usare Private o Protected, 
            al fine di evitare conflitti e/o comportamenti inattesi.</p>

        <h2 id="this">$this</h2>
        <p>La keyword <strong>$this</strong> identifica il <strong>puntatore</strong> che fa riferimento alla locazione di memoria dove la variabile membro è stata creata. Quindi, con 
            $this->identificatore della variabile senza $ (il cui significato di <b>'$this->processo' è puntatore, operatore di accesso e riferimento al processo interno</b>) si fa riferimento alla variabile dell'istanza attiva per quell'oggetto 
            (per esempio la proprietà 'nome' contiene un valore diverso indipendente per ogni oggetto creato - un oggetto è un'istanza attiva della classe. &Egrave; possibile avere 
            più oggetti diversi che istanziano la stessa classe.</p>
        
        <p class="codice">Nota: quando si fa riferimento ad una proprietà della stessa classe è importante ricordare che l'<strong>identificatore di variabile 
                deve essere messo solo davanti al puntatore 'this' ($this) e non alla variabile membro</strong>.</p>
                
        <h3 class="esempio">Esempio $this</h3>
        <p>Concatenamento e Interpolazione.</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Prodotto{
    // stato interno
    private $nome = 'Occhiali',
            $prezzo = 12.5,
            $iva = 22,
            $validoFinoAl = "2016-12-31",
            $prezzoBloccato = true;

    public function stampa(){
        // Esempio di concatenamento e interpolazione delle proprietà
        echo date("d-m-Y")." - Scheda Prodotto di $this->nome<br/>";
    }
}

$prodotto = New Prodotto();
$prodotto->stampa();
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
        
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
class Prodotto{
    // stato interno
    private $nome = 'Occhiali',
            $prezzo = 12.5,
            $iva = 22,
            $validoFinoAl = "2016-12-31",
            $prezzoBloccato = true;

    public function stampa(){
        // Esempio di concatenamento e interpolazione delle proprietà
        echo date("d-m-Y")." - Scheda Prodotto di <b>$this->nome</b><br/>";
    }
}

$prodotto = New Prodotto();
$prodotto->stampa();
?>
</pre>

</body>
</html>