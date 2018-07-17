<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 48 - OOP - Ereditarietà 3^ Parte - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
            <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 48</strong>
    </p>

    <h1>[48] OOP Ereditarietà 3^ Parte - Parte 7 di 10</h1>
    
    <ul>
        <li>Alcuni dei <a href="#limiti-php" title="Alcuni dei limiti di PHP">limiti di PHP</a>:
            <ul>
                <li><b>Passare più argomenti alle funzioni</b>;</li>
                <li><b>Type Casting</b> delle variabili stringa in varibili numeriche.</li>
            </ul>                
        </li>
        <li><a href="#incapsulamento" title="incapsulamento">Incapsulamento</a>
            <ul>
                <li><a href="#ambito-di-visibilita" title="Ambito di Visibilità">Ambito di visibilità</a> delle Variabili Membro Private</li>
                <li>Cosa succede se, in una classe figlia, si tenta di utilizzare una 
                    <a href="#variabili-private" title="Variabile Membro Private ereditata">Variabile Membro Privata ereditata</a> da una parent class.</li>
            </ul>
        </li>
    </ul>

    <h2 id="limiti-php">Alcuni Limiti di PHP</h2>
    <p><b>Prima</b> di passare alla creazione della classe figlia DadoTruccato, <b>è bene sottolineare ed evidenziare alcuni limiti del PHP</b> che, se non ben compresi, 
        potrebbero creare non pochi grattacapi in fase di stesura e gestione del codice.</p>
            
    <h3 id="argomenti" class="celeste">Passare più Argomenti alle funzioni</h3>
    
    <p><b>PHP supporta le funzioni con un numero variabile di argomenti</b>. Avendo un codice come il seguente, in cui vengono passati più argomenti, alla funzione costruttore 
        che accetta un solo argomento, essa prende in esema solo il primo (il numero 4) degli argomenti passati.</p>    
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$unDadoTruccato = New DadoTruccato(4,8,10,15);
[...]
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
    
    <h3 id="type-casting" class="celeste">Type Casting</h4>
    <p>In un <b>confronto logico (es. stringa >= 0)</b>, <b>il PHP tenta di convertire una variabile di tipo stringa in una di tipo numero</b>. Nel caso in cui la conversione 
        non sortisce alcun effetto, ovvero <b><u>se non viene restituito alcun numero valido, la variabile sringa viene convertita in una variabile numerica con valore 0 [zero]</u></b>.<br />
        <span style="color: red;">Per esempio: durante un confronto logico tra la stringa "paperino" e un numero, il PHP converte la stringa nel numero 0</span>.<br /> 
        Questo sistema di <b>auto-conversione dei tipi di dato</b>, in PHP, <strong>è detto Type Casting</strong>.</p>
    
    <p style="margin: 10px 0px;">Inoltre il <b>PHP</b>, nelcaso si voglia sostituire un valore di una variabile, non effettua alcun confronto tra i tipi di dato. Se una variabile 
        contiene un numero, senza alcun controllo, il valore sarà sostituito da quello nuovo anche se di altro tipo.</p>
    
    <p style="margin: 10px 0px;font-weight: bold;">Nel codice seguente vengono evidenziati a livello pratico i limiti del PHP, il type casting degli operandi in un'espressione 
        logica (la conversione di una stronga in confronto numerico) e la sostituzione del valore, in una variabile esistente, senza la verifica del tipo di dato già presente in essa:</p>
    
    <ol>
        <li>La variabile membro $numeroFacce è di tipo numero integer;</li>
        <li>Il costruttore effettua un controllo condizionale che, nel caso l'espressione logica restituisce True, assegna a $numeroFacce 
            senza alcun controllo e confronto sui tipo di dato tra $numeroFacce e argomento passato, quindi il PHP:
            <ol>
                <li><p><b>if($numeroFacce>=0)</b> $this->numeroFacce = $numeroFacce;</p>
                    <p>Cerca di convertire l'operando sinistro (<b>$numeroFacce</b> è "paperino") in un numero, non riuscendoci <b>la converte in 0</b>, e 
                        <b>l'espressione logica restituisce True</b></p></li>
                <li><p>if($numeroFacce>=0) <b>$this->numeroFacce = $numeroFacce;</b></p>
                    <p>L'espressione logica restituisce a True, <b>la variabile $numeroFacce assume il nuovo valore "paperino"</b>.</p></li>
            </ol>        
        </li>
        <li><p>Nel metodo "lancia" è presente la funzione <strong>rand(min, max) che accetta 2 argomenti di tipo numerico</strong>, essa assegna alla variabile $valoreAttuale 
                un dato di tipo numero preso da un intervallo che va da 1 a "$numeroFacce". Essendo quest'ultima un tipo di dato stringa, "paperino", l'Engine restituirà:<br />
            <span style="color: red;"><b>Warning:</b> rand() expects parameter 2 to be long, string given in <b>C:...</b> 
                (percorso del file.php e riga che ha generato l'errore)</span></p></li>
    </ol>

    <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: E' possibile <strong>aggirare il limite del type casting</strong> con il confronto logico 
        <strong>stretto</strong> (<b>0 === false</b>) restituisce <b>False</b>, in quanto (0 == false) restituisce True, .</p>

<pre>
<?php
$codice = <<< 'CODICE'
<?php
class DadoNormale {
    // STATO INTERNO
    private $numeroFacce = 6, $valoreAttuale = 0 ;
    
    public function __construct($numeroFacce){
        if($numeroFacce>=0) $this->numeroFacce = $numeroFacce;
    }
    
    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce);
    }
}

$unDadoTruccato = New DadoTruccato("paperino");
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />

    <h2 id="incapsulamento">Incapsulamento</h2>

    <h3 id="ambito-di-visibilita" class="celeste" style="background-color: red;">Ambito di visibilità delle Variabili Membro Private</h3>
    <p>I membri privati (variabili membro e funzioni interne, dette proprietà e metodi) di una classe madre (parent class) non sono ereditabili dalle classi figlie.</p>
    
    <h4>Codice di Esempio 1</h4>
<pre>
// Classe Madre
class dadoNormale {
    // Stato Interno
    private $numeroFacce = 6;

    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce);
        return $this->valoreAttuale;
    }
}

// Classe Figlia
class dadoNormale extends dadoTruccato {
    function __construct(){
        echo $numeroFacce;
    }
}
</pre>    
    <h4>Significato del Codice</h4>
    <p>Il PHP quando esegue questo codice restituisce un ERRORE perché il costruttore della classe figlia non può accedere alla variabile privata $numeroFacce 
        della classe madre (parent class).</p>
    
    <h3 id="variabili-private" class="celeste" style="background-color: red;">Cosa succede se, in una classe figlia, si tenta di utilizzare una variabile membro privata 
        ereditata da una parent class.</h3>
    <p>Tenendo presente che <b>i membri privati della classe madre non vengono ereditati dalle classi figlie</b> e sapendo che <b>in PHP, 
            usando un identificatore di variabile non precedentemente dichiarato, le variabili sono dichiarate nel stesso momento in cui ad esse vengono assegnati, 
            per la prima volta, dei valori</b>.</p>
            
    <p style="margin: 10px 0px;">Per chiarire questo concetto vediamo il seguente esempio:</p>    
    <h4>Codice di Esempio 2</h4>
<pre>
/ Classe Madre
class dadoNormale {
    // Stato Interno
    private $numeroFacce = 6;

    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce);
        return $this->valoreAttuale;
    }
}

// Classe Figlia
class dadoTruccato extends dadoNormale {
    // Stato Interno
    private $facciaTruccata=0, $quantoTruccata=0 ;
    
    function __construct($numeroFacce, $facciaTruccata, $trucco){
        if($numeroFacce>0) $this->numeroFacce=$numeroFacce;
        
        if($facciaTruccata<$this->numeroFacce && $trucco>0){
            $this->facciaTruccata = $facciaTruccata;
            $this->quantoTruccata = $trucco;
        }
    }
}

$dado = New dadoTruccato(3, 2, 10);
$dado->lancia();
</pre>
    <h4>Significado del Codice</h4>
    <p>Nella classe figlia abbiamo assegnato un valore alla variabile $numeroFacce (usando l'identificatore $this->numeroFacce), convinti di aver modificato il valore 
        della variabile dichiarata nella classe madre. Però, <b>la variabile $numeroFacce della classe madre è privata quindi non visibile nella classe figlia</b>.  
        Il PHP, <b>non trovando alcuna variabile con quell'identificatore</b>, crea/<b>dichiara una nuova variabile $numeroFacce</b> (con ambito di visibilità <b>pubblic</b>) 
        <b>nella classe figlia</b> "slegata" dalla variabile (con stesso identificatore) presente nella classe madre.</p>
    <p style="margin: 10px 0px;">Quando <b>con l'Oggetto $dado</b>, creato istanziando la classe figlia, <b>si invoca il metodo lancia()</b>, presente nella classe madre, 
        il PHP <b>utilizza la variabile $numeroFacce della classe madre</b>.</p>
    
    <p class="codice"><a href="lezione-49-oop-8.php" title="l'ereditarietà">Nella prossima lezione</a> vedremo le soluzioni possibili per aggirare questi ostacoli: Creare un metodo pubblico nella classe madre che va a modificare 
        la variabile $numeroFacce, oppure usare il costruttore della classe figlia da cui eredita.</p>

</body>
</html>