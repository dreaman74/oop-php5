<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 47 - OOP - Ereditarietà 2^ Parte - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
    <p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
            <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 47</strong>
    </p>

    <h1>[47] OOP Ereditarietà 2^ Parte - Parte 6 di 10</h1>

    <ul>
        <li><a href="#ereditarieta" title="ereditarietà">Ereditarietà</a></li>
        <li>Le classi pincipali definite <b>Superclassi</b> o <a href="#classe-madre" title="Le classi Madre">Classi Madre</a></li>
        <li><b>Ereditare</b> tutti i membri di una classe madre con <a href="#extends" title="extends">extends</a></li>
        <li>Come <a href="#richiamare-i-membri" title="richiamare i membri">richiamare i membri</a> da un oggetto creato <b>da un'istanza di una classe figlia</b>.</li>
    </ul>
    
    <h2 id="ereditarieta">Ereditarietà</h2>
    <p>In questa lezione, approfondiamo e mettiamo in pratica il concetto di Ereditarietà di PHP. Creeremo due classi, la classe principale DadoNormale e quella figlia 
        DadoTruccato quest'ultima eredita i membri (costruttori, proprietà e metodi) di quella principale. Quindi nella classe madre, il modello di partenza, devono essere 
        inseriti i membri comuni e utilizzati sia dalla classe stessa sia dalle classi figlie che ereditano da essa.</p>
    
    <hr />    

    <h2 id="classe-madre">La classe Madre</h2>
    <p>Le classi principali sono identificate con vari nomi, alcuni di essi:</p>
    <ul>
        <li>Classe Madre;</li>
        <li>Classe Antenata;</li>
        <li>Classe Base;</li>
        <li>Superclasse.</li>
    </ul>
    
    <h3 class="esempio">La Classe Madre - DadoNormale</h3>
    <p class="codice">Creare la seguente classe madre e salvarla, in un file <b>class.dado.php</b>.</p>
    
    <h4>Classe Madre</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class DadoNormale{

    // Stato Interno
    private $numeroFacce = 6, $valoreAttuale = 0 ;
    
    public function __construct($numeroFacce){
        if( $numeroFacce > 0 ) $this->numeroFacce = $numeroFacce ;
        
        // Stampa a video il messaggio
        echo 'Metodo __construct() eseguito'.io::NL;
    }
    
    public function lancia(){
        $this->valoreAttuale = rand(1, $numeroFacce);
        return $this->valoreAttuale;
    }
    
    public function getValore(){
        return $this->valoreAttuale;
    }
}
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h2 id="extends">extends</h2>
    
    <h3 class="esempio">Ereditare i membri di una classe madre</h3>
    <p class="codice">Per creare la dipendenza tra classe figlia e classe madre, si usa la notazione composta dalla keyword <strong>extends</strong> e nome della classe 
        da cui si vogliono ereditare i membri</strong>.</p>
    
    <h4>Classe Figlia</h4>
    <p>Nel seguente esempio, <b>la classe figlia DadoTruccato eredita dalla classe madre DadoNormale tutti i membri in essa contenuti</b>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class DadoTruccato extends DadoNormale {
        
}
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h2 id="richiamare-i-membri">Oggetto di classe figlia</h2>
    <p>Se proviamo a creare un oggetto istanziando la classe figlia vedremo che, nonostante non sia presente alcun metodo o stato interno nella classe DadoTruccato, 
        saranno usati i membri (compreso il costruttore) della classe madre DadoNormale.</p>
    
    <h3 class="esempio">Esempio</h3>
    
    <h4>Main script che crea l'oggetto</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?
$unDadoTruccato = New DadoTruccato(4);

for($lanci=0; $lanci<=10; $lanci++){
    echo $unDadoTruccato->lancia().io::NL;
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
    
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
include("lezione-47/class.static.php");
include("lezione-47/class.dado.normale.php");
include("lezione-47/class.dado.truccato.php");

$unDadoTruccato = New DadoTruccato(4);

for($lanci=0; $lanci<=10; $lanci++)
    echo "Lancio n.$lanci - {$unDadoTruccato->lancia()}".io::NL;
?>
</pre>

</body>
</html>