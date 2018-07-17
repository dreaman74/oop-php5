<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 45 - OOP - Costruttori, Distruttori e Overloading - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
include("lezione-45/class.static.php");
include("lezione-45/class.prodotto.php");
?>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 45</strong>
	</p>
	
	<h1>[45] Object Oriented Programming - Parte 4 di 10</h1>
        <p>I metodi magici <strong>_construct()</strong> e <strong>_destruct()</strong>, e <strong>overloading</strong>.</p>
        
        <ul>
            <li><p>Il metodo magico <a href="#construct" title="il metodo __construct()">__construct()</a>;</p></li>
            <li><p><a href="#costruttori" title="overloading">Utilizzo di più costruttori</a> tramite l'utilizzo di Metodi Pubblici Statici;</p></li>
            <li><p>Il metodo magico <a href="#destruct" title="il metodo __destruct()">__destruct()</a>;</p></li>
        </ul>
        
        <hr />

        <h2 id="construct">__construct()</h2>
        <p>Uno dei punti fondamentali che sta alla base della filosofia della programmazione ad Oggetti è la possibilità, da parte dell'utente, di validare correttamente 
            lo stato iniziale di un oggetto in fase di creazione.</p>
        
        <p style="margin: 10px 0px;">Nessuno vieta di creare dei metodi Setter che valorizzino le proprietà di una classe da invocare manualmente, dall'utente, 
            dopo la creazione di un oggetto. Questo sistema purtroppo ha uno svantaggio operativo: l'utente, il programmatore, potrebbe dimenticare 
            di invocare questi metodi quindi il risultato sarebbe un oggetto con uno stato iniziale non correttamente validato.</p>
        
        <p>Per questo motivo, ci viene in aiuto il metodo <strong>__construct()</strong> (<strong>costruttore di una classe</strong>), un <strong><i>metodo magico</i></strong> 
            dell'engine ZEND di PHP, che viene invocato ed eseguito automaticamete nel momento in cui l'utente, il programmatore, 
            crea un nuovo oggetto (istanziare una classe).</p>
            
        <p style="margin: 10px 0px;">Il <strong>costruttore della classe</strong> è rappresentato da una funzione invocata automaticamente che esegue tutto il codice 
            in essa contenuto.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Il metodo magico <strong>__construct()</strong> assume lo stato di accesso 
            <strong>Public</strong> di <strong>DEFAULT</strong>, se non viene specificato alcun indicatore di visibilità.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">In PHP è possibile dichiarare <strong>solo 1 costruttore per classe</strong>.</p>
        
        <p>Il costruttore può avere il compito di effettuare tutti i controlli sulla sicurezza, con il fine di restituire un oggetto con uno stato iniziale correttamente 
            validato. Un esempio potrebbe essere quello di controllare gli argomenti passati in ingresso; invocare i metodi setter - già presenti nella classe - per impostare 
            le proprietà della stessa).</p>
       
        <h3 class="esempio">Esempio</h3>
        
        <h4>Codice della Classe</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Prodotto {
    
    // Stato Interno
    // Blocco che contiene tutte le proprietà (variabili membro ) della classe
    private $nome,
            $prezzo,
            $validoFinoAl;

    // Costruttore PUBLIC
    // Di DEFAULT Assume lo stato 'public' se non specificato l'Indicatore di visibilità
    function __construct($nome, $prezzo, $validoFinoAl){
        $this->nome = $nome;
        $this->setPrezzo($prezzo, $validoFinoAl);
    }
    
    // Altri metodi
}
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        <h4>Codice che istanzia la classe</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$prodotto = New Prodotto("Occhiali", 85, "2016-10-10");
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>

        <hr />
        
        <h2 id="costruttori">Utilizzare più Costruttori di Classe</h2>
        
        <p class="codice">Vedi la Reference ufficiale di PHP.net per la 
            <a href="http://php.net/manual/en/language.oop5.decon.php" title="gestione di più costruttori" target="_blank">gestione di più costruttori e distruttori</a> per
            altri esempi e metodi.</p>
        
        <p>Come scritto sopra, il PHP non accetta che ci siano più costruttori per classe. Però possiamo aggirare questo ostacolo, utilizzando <b>i metodi pubblici statici</b> che 
            <b>restituiscono come valore l'oggetto che si vuole creare invocando il costruttore</b>, l'unico presente nella classe.</p>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;"><b>Usando i metodi pubblici statici per costruttori</b>, è importante 
            ricordare che <b>il metodo __construct() dovrà assumere lo stato private</b> di visibilità.</p>

        <h3 class="esempio">Esempio</h3>
        
        <h4>Codice della Classe</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Prodotto {
    
    // Stato Interno
    // Blocco che contiene tutte le proprietà (variabili membro ) della classe
    private $nome,
            $prezzo,
            $validoFinoAl;

    // Metodi Pubblici Statici che definiscono Più Costruttori
    // che restituiscono un nuovo oggetto richiamando l'unico Costruttore presente
    
        public static function da_dati_minimi($nome, $prezzo){
            return New Prodotto( $nome, $prezzo, date("Y-m-d") );
        }

        public static function da_dati_completi($nome, $prezzo, $validoFinoAl){
            return New Prodotto( $nome, $prezzo, $validoFinoAl );
        }
    
    // ----- Fine dei Metodi Pubblici Statici

    // Unico Costruttore
    private function __construct($nome, $prezzo, $validoFinoAl){
        $this->nome = $nome;
        $this->setPrezzo($prezzo, $validoFinoAl);
    }
    
    // Altri metodi
}
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        <h4>Codice che istanzia la classe</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$prodotto = Prodotto::da_dati_minimi("Stampante Epson Workforce Pro WF-8510", 970);

$prodotto = Prodotto::da_dati_completi("Stampante Xerox WorkCentre 6505", 370, "2016-10-10");
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        
        <hr />
        
        <h2 id="destruct">__destruct()</h2>
        <p>Il <strong>metodo _destruct() non accetta argomenti in ingresso</strong>. Il suo compito è quello di <b>rilasciare le risorse, liberando la memoria del sistema</b>. 
            <b>L'Engine esegue in automatico le istruzioni in esso contenute quando un oggetto muore</b>, ovvero quando termina l'esecuzione dello script o termina una funzione che lo 
            ha creato (Possono essere eseguite anche altre istruzioni, ad esempio salvare in un database alcuni dati, etc.).</p>
        
        <h3 class="esempio">Esempio</h3>
        
        <h4>Codice della classe</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Prodotto {
    
    // Stato Interno
    // Blocco che contiene tutte le proprietà (variabili membro ) della classe
    private $nome,
            $prezzo,
            $validoFinoAl;
            
    // ...
    
    // Distruttore
    public function __destruct()
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        
</body>
</html>