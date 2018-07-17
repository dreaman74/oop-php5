<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 44 - OOP - Metodi Static e Costanti di Classe - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
include("lezione-44/class.static.php");
include("lezione-44/class.prodotto.php");
?>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 44</strong>
	</p>
	
	<h1>[44] Object Oriented Programming - Parte 3 di 10</h1>
        <ul>
            <li><p><a href="#membri-static" title="membri static">Membri Statici</a>;</p></li>
            <li><p><a href="#self" title="La keyword self">self</a>;</p></li>
            <li><p><a href="#classi-di-servizio" title="classi di dervizio">Le Classi di Servizio</a>;</p></li>
            <li><p><a href="#costanti" title="costanti di classe">Le Costanti di classe</a>;</p></li>
            <li><p><a href="#esempio" title="costanti di classe">Un esempio reale</a>;</p></li>
        </ul>
        
        <hr />

        <h2 id="membri-static">Membri Statici</h2>
        <p><strong>I membri statici non appartenogo ad alcun oggetto</strong>, sono condivisi da tutte le istanze create. 
            <strong>I membri statici</strong> è statico se viene dichiarato tramite la keyword <strong>static</strong> che segue l'indicatore di visibilità 
            (private, protected e public).</p>

        <p style="margin: 10px 0px;"><strong>Se privi di Indicatore di visibilità</strong>, i membri statici, metodi e proprietà, 
            assumono lo stato di <strong>public</strong> per <strong>default</strong>.</p>
        
        <h3 class="celeste">Membri Pubblici Statici</h3>
        <p style="background-color: yellow;margin:10px 0px;padding: 5px;">I membri pubblici statici sono richiamati dall'esterno della classe direttamente 
            senza creare l'oggetto, in quanto gli stessi sono condivisi tra tutte le istanze create e attive.</p>
        
        <h3 class="celeste">Sintassi</h3>
        <p>Esempio di dichiarazione e accesso ai membri statici di una classe:</p>
<pre>
<?php
$codice = <<< 'CODICE'
// Creazione della Proprietà
static $variabile = 0;
// Accesso alla Proprietà (compreso $ - specificatore di variabile)
nome_classe::$variabile;

// Creazione del Metodo Static
static function funzione()
{
...
}
// Accesso al Metodo Static
nome_classe::funzione;

// Creazione della Costante
COSTANTE = 0;
// Accesso alla Costante
nome_classe::COSTANTE;
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        
        <h3 class="esempio">Esempio di una variabile static</h3>
        <p>Un semplice esempio di una variabile static $contatore condivisa con tutte le istanze. <b>Per ogni istanza creata la variabile</b> non assumerà valore 0 ma 
            <b>sarà incrementata di 1</b> perché condivisa con tutti gli oggetti della classe:</p>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Utente {
    
    // Variabile Statica Public
    static $contatore = 0;
    
    // Metodo '_construct()' invocato in automatico quando si crea un oggetto di classe 'Utente'
    public _construct(){

        // la keyword 'self' fa riferimento alla prorpietà o metodo static della classe stessa
        self::contatore++;
    }
}
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        
        <hr />

        <h2 id="self">self</h2>
        <p>Per <strong>accedere</strong> sintatticamente ad un <strong>membro statico della stessa classe</strong> utilizzare la keyword <strong>self</strong>, non la 
            notazione con il puntatore $this, in quanto <strong>per accedere ad un membro statico non si crea un oggetto</strong>, istanza di una classe.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px">Differentemenete da $this, <b>per accedere ad una proprietà statica della classe stessa specificare la variabile con lo specificatore di variabile</b> - segno del $.</p>
        
        <h3 class="celeste">Sintassi</h3>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
// Accedere ad un Metodo Static della stessa classe
self::metodo;

// Accedere ad una Proprietà Static della stessa classe
self::$proprieta;

// Accedere ad una Costante della stessa classe
self::CONST;
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
        <hr />
        
         <h2 id="classe-di-servizio">Classi di Servizio</h2>
        
        <p><strong>Le classi di servizio, contengono <a href="#membri-static" title="membri static">membri statici</a> 
                condivisi da tutti gli oggetti</strong>, non legati ad alcuna istanza di classe (oggetti).         
        
        <h3 class="esempio">Esempio 1</h3>
        <p>I <strong>membri static</strong> se privi di indicatori di visibilità di <strong>DEFAULT</strong> assumono visibilità <strong>public</strong>.</p>
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class io{
    
    // Proprietà Public
    static $nl = "<br />";
    
    // Metodo Public
    static function linea($carattere, $quanti)
    {
        return str_repeat($carattete, $quanti);
    }
    
    // Metodo Public
    static function saltaRighe($quanti)
    {
        echo str_repeat(self::$nl, $quanti);
    }
}
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
        
        <hr />
        
        <h2 id="costanti">Le Costanti</h2>
        <p><strong>Il valore di una costante non può essere modificato, in quanto esso viene assegnato in fase di inizializzazione della stessa.</strong>
            <strong>Le costanti vengono inizializzate con la keyword const</strong>.</p>
            
        <p style="margin: 10px 0px;"><strong>Il rischio principale dell'utilizzo delle variabili membro static public è dato dal fatto di poterne modificare il valore 
                anche esternamente alla classe</strong> in cui esse vengono inizializzate. Uno metodo per evitare che la variabile membro sia modificabile dall'esterno, 
                <strong>&egrave; dichiarare le proprietà static come private</strong>. Purtroppo <strong>recuperare il valore di una variabile membro private 
                    diventa più articolato</strong>, in quanto si deve creare un metodo accessorio Getter nella classe stessa e invocarlo quando 
                    si vuole recuperare dall'esterno il valore in essa contenuto</strong>.</p>

        <div class="codice celeste" style="font-size: 1em;">
            <p>Il metodo più sicuro e veloce <strong>per accedere direttamente ad una proprietà, evitandone la modifica, è utilizzare le costanti di classe</strong> che 
                offrono un doppio vantaggio:</p>
            <ol>
                <li>Essere accessibili dall'esterno alla classe;</li>
                <li>il valore non può essere modificato in quanto esso viene assegnato solo in fase di inizializzazione, all'interno della classe stessa.</li>
            </ol>
        </div>

        <p style="background-color: yellow;padding: 5px;"><strong>La costante è necessariamente Pubblica</strong>, non avendo alcun pericolo di accessibilità 
            data la sua natura di immutabilità. <strong>Per questo motivo non si può specificare alcun indicatore di visibilità.</strong></p>

        <h3 class="esempio">Esempio 2</h3>
        <p>La classe di servizio dell'Esempio 1 viene così modificata con le costanti di classe:</p>
        <ul>
            <li><b>const NL = "&lt;br /&gt;";</b> La Sua inizializzazione e contestuale assegnazione;</li>
            <li><b>self::NL;</b> Accesso Interno alla Costante Statica.</li>
        </ul>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class io{
    
    // Costante Static Public - Inzialiazzazione
    // Non usare l'identificatore $ per le costanti
    // Convenzione, tutte le costanti sono scritte in MAIUSCOLO
    const NL = "<br />";
    
    // Metodo Public
    static function linea($carattere, $quanti)
    {
        return str_repeat($carattere, $quanti);
    }
    
    // Metodo Public
    static function saltaRighe($quanti)
    {
        echo str_repeat(self::NL, $quanti);
    }
}
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
        <hr />
        
        <h2 id="esempio">Un esempio reale</h2>
        <p>Un esempio di scheda prodotto, con verifica della data dell'offerta e modifica del prezzo.</p>
        
        <h3 class="esempio">Esempio 3</h3>
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
// Classi Incluse

include("classi/class.static.php");
include("classi/class.prodotto.php");

// -----------------------------

$prodotto = New Prodotto();
$prodotto->stampa();
//echo io::linea("-", 70);
io::saltaRighe(2);

echo "Prezzo dell'offerta:".io::NL;
$prezzo = $prodotto->getPrezzo();
if($prezzo!==false)
    echo "Prezzo $prezzo";
else
    echo "Prezzo non più valido!";
io::saltaRighe(3);

// Indicare una data posteriore a quella ordierna
$prodotto->setPrezzo(200, "2016-10-31");
$prodotto->stampa();

CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
        <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$prodotto = New Prodotto();
$prodotto->stampa();
//echo io::linea("-", 70);
io::saltaRighe(2);

echo "Prezzo dell'offerta:".io::NL;
$prezzo = $prodotto->getPrezzo();
if($prezzo!==false)
    echo "Prezzo $prezzo";
else
    echo "Prezzo non più valido!";
io::saltaRighe(3);

// Indicare una data posteriore a quella ordierna
$prodotto->setPrezzo(200, "2016-10-31");
$prodotto->stampa();
?>
</pre>

</body>
</html>