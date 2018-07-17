<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 46 - OOP - Ereditarietà 1^ Parte - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
            <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 46</strong>
    </p>

    <h1>[46] OOP Ereditarietà 1^ Parte - Parte 5 di 10</h1>
        
    <h2 id="ereditarieta">Ereditarietà</h2>
        
    <p>Introduciamo una situazione non implementabile in modo ottimale con le attuali conoscenze preparando il terreno ad un altro nuovo ed 
        importante concetto OOP: l'<strong>Ereditarietà</strong>.</p>
    
    <hr />

    <h2>Lancio del Dado</h2>
    <p>Il programma restituisce una faccia casuale del dado per n lanci. Nel momento in cui si crea l'oggetto, <b>bisogna specificare al costruttore il numero di facce di cui 
            è composto il dado</b>.</p>

    <h3 class="esempio">Codice di esempio</h3>

    <h4>Classe Dado</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Dado{
    
    // Stato Interno (Proprietà - Variabili Membro)
    private $valoreAttuale = 0, $numeroFacce = 6;
    
    public function __construct($numeroFacce) {
        if($numeroFacce>0) $this->numeroFacce=$numeroFacce;
    }
    
    public function lancia(){
        // rand(x, y) > Restituisce un numero intero casuale prelevato in un range che va da x a y compresi
        $this->valoreAttuale = rand(1, $this->numeroFacce);
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
    <h4>Script che richiama la classe</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
// Include File
include("lezione-46/class.static.php");
include("lezione-46/class.dado.php");

// Argomento indica il numero di facce da cui è composto il dado
$unDado = New Dado(6);
for($lanci=1; $lanci<=10; $lanci++)
    echo "Lancio $lanci > {$unDado->lancia()}".io::NL;
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>

    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
// Include File
include("lezione-46/class.static.php");
include("lezione-46/class.dado.php");

// Argomento indica il numero di facce da cui è composto il dado
$unDado = New Dado(6);
for($lanci=1; $lanci<=10; $lanci++)
    echo "Lancio $lanci > {$unDado->lancia()}".io::NL;
?>
</pre>
    <hr />

    <h2>Lancio del Dado Truccato</h2>
    <p>Il programma restituisce sempre casualmente un faccia del dado per n lanci ma dando preferenza ad una faccia in particolare.</p>
    
    <p style="margin: 10px 0px;">La filosofia del programma che estrae la faccia di un dado truccato è semplice: Il metodo 'lancia' della 'classe dado' restituisce un valore, 
        e contemporaneamente assegna alla proprietà '$valoreAttuale' della stessa istanza, un numero intero recuperato randomicamente (il cui intervallo è compreso 
        tra 1 e (numero di facce + quantita trucco). Se il numero intero random è compreso inferiore o uguale a $numeroFacce, restituisce il numero "estratto", diversamente, 
        se superiore, restituisce il valore di $facciaTruccata.</p>
    
    <h3 class="esempio">Codice di esempio</h3>

    <h4>Classe DadoTruccato</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class DadoTruccato{
    
    // Stato Interno (Proprietà - Variabili Membro)
    private $valoreAttuale = 0, $numeroFacce = 6,
            $facciaTruccata = 0, $quantoTruccata = 0 ;
    
    // Costruttore
    public function __construct($numeroFacce) {
        if($numeroFacce>0) $this->numeroFacce=$numeroFacce;
    }
    
    public function setFacciaTruccata_Trucco($faccia, $trucco){
        if ($faccia>0 && $faccia<=$this->numeroFacce && $trucco>0){
            $this->facciaTruccata = $faccia;
            $this->quantoTruccata = $trucco;
        }
    }
    
    public function lancia(){
        // rand(x, y) > Restituisce un numero intero casuale prelevato in un range che va da x a y compresi
        $this->valoreAttuale = rand(1, $this->numeroFacce + $this->quantoTruccata);
        
        if ( $this->facciaTruccata > 0 && ($this->valoreAttuale > $this->numeroFacce) )
            $this->valoreAttuale = $this->facciaTruccata;
        
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
    <h4>Script che richiama la classe</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
// Include File
include("lezione-46/class.static.php");
include("lezione-46/class.dado.truccato.php");

// Argomento indica il numero di facce da cui è composto il dado
$unDado = New DadoTruccato(6);
$unDado->setFacciaTruccata_Trucco(5, 4)

for($lanci=1; $lanci<=10; $lanci++)
    echo "Lancio $lanci > {$unDado->lancia()}".io::NL;
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>

    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
// Include File
include("lezione-46/class.dado.truccato.php");

// Argomento indica il numero di facce da cui è composto il dado
$unDado = New DadoTruccato(6);
$unDado->setFacciaTruccata_Trucco(5, 5);

for($lanci=1; $lanci<=10; $lanci++)
    echo "Lancio $lanci > {$unDado->lancia()}".io::NL;
?>
</pre>

</body>
</html>