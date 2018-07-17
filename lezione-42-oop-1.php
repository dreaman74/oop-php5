<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 42 - OOP - La nostra prima classe - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 42</strong>
	</p>
	
	<h1>[42] Object Oriented Programming - Parte 1 di 10</h1>
        <ul>
            <li><p><a href="#oop" title="Introduzione alla Object Oriented Programming">Introduzione alle Classi</a>;</p></li>
            <li><p><a href="#classe" title="la prima classe in PHP">La nostra prima classe</a>;</p></li>
        </ul>
        
        <hr />
        
        <h2 id="oop">Introduzione alle classi</h2>
        
        <p>Uno dei capisaldi della filosofia che sta alla base della OOP - programmazione ad oggetti - è la necessità che lo stato di un oggetto in partenza sia 
            considerato valido. Questo si traduce nella possibilità da parte dell'utente di specificare dei valori in fase di creazione di un oggetto. Un oggetto è 
            un'istanza di una classe.</p>
        
        <p style="margin: 10px 0px;">Una classe è composta da funzioni interne dette <strong>metodi</strong> e variabili interne dette <strong>proprietà</strong>, queste ultime normalmente raggruppate all'inizio della classe, all'interno
            di un blocco detto <strong>stato interno</strong>.</p>
        
        <h3 class="titolo_paragrafo">Proprietà</h3>
        <p>Le <strong>proprietà (property)</strong>, variabili interne alla classe, sono raggruppate in un unico blocco identificato come <b>stato interno</b> della classe.
            Solitamente questo elenco delle proprietà viene posizionato all'inizio della classe stessa.</p>
        <h4 class="sottotitolo_paragrafo">Indicatori di visibilità</h4>
        <p>Gli <b>Specificatori di livello di accesso</b> indicano lo stato di visibilità delle variabili interne della classe:</p>
        <ul>
            <li><strong>private</strong>, propietà accessibili solo internamente alla classe stessa;</li>
            <li><strong>protected</strong>, proprietà accessibili solo alla classe stessa e quelle derivate;</li>
            <li><strong>public</strong>, proprietà accessibili alla classe stessa, quelle derivate e all'esterno.</li>
        </ul>
        
        <h3 class="titolo_paragrafo">Metodi</h3>
        <p>Le <strong>funzioni interne</strong>, definite <strong>metodi</strong>, svolgono vari compiti. <strong>I metodi hanno pieno accesso allo stato interno</strong>, 
            quindi non si devono passare le proprietà della classe si crea un metodo, funzione interna alla classe.<p>
        <h4 class="sottotitolo_paragrafo">Indicatori di visibilità</h4>
        <p>GLi <b>Specificatori di livello di accesso</b> indicano lo stato di visibilità dei membri della classe:</p>
        <ul>
            <li><strong>private</strong>, metodi accessibili solo all'interno della classe stessa;</li>
            <li><strong>protected</strong>, metodi accessibili all'interno della classe e quelle derivate;</li>
            <li><strong>public</strong>, metodi accessibili all'interno della classe stessa, quelle derivate ed esterno.</li>
        </ul>
        
        <hr />
        
        <h2 id="classe">Prima classe</h2>
                
        <h3 class="esempio">Esempio</h3>
        
        <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
// Classe Statica
class io {
    static $nl = '<br />';
}

// Classe
class Prodotto {

    // Stato Interno, Property o Proprietà
    public
        $nome = "Occhiali da vista",
        $prezzo = 12.5,
        $iva = 22;

    // Metodi / Comportamento
    public function stampa(){
        echo "Scheda per il prodotto $this->nome".io::$nl;
        echo str_repeat('-',80).io::$nl;
        echo "Prezzo $this->prezzo euro",io::$nl;
        echo "IVA $this->iva%",io::$nl;
    }
}

// Crea Oggetto (Istanza di una classe)
$prodotto = New Prodotto();
$prodotto->stampa();

// Modifica il prodotto
$prodotto->nome = "Occhiali da sole";
$prodotto->prezzo = "50";
$prodotto->stampa();
?>
CODICE;
    echo htmlspecialchars($codice);
?>
</pre>
        <h4>Visualizzato nel Browser</h4>        
<pre>
<?php
// Classe Statica
class io {
    static $nl = '<br />';
}

// Classe
class Prodotto {

    // Stato Interno, Property o Proprietà
    public
        $nome = "Occhiali da vista",
        $prezzo = 12.5,
        $iva = 22;

    // Metodi / Comportamento
    public function stampa(){
        echo "Scheda per il prodotto <b>$this->nome</b>".io::$nl;
        echo str_repeat('-',50).io::$nl;
        echo "Prezzo $this->prezzo euro",io::$nl;
        echo "IVA $this->iva%",io::$nl;
    }
}

$prodotto = New Prodotto();
echo 'Stampa Prodotto Originale:'.io::$nl;
$prodotto->stampa();

// Modifica il prodotto
$prodotto->nome = "Occhiali da sole";
$prodotto->prezzo = "50";
echo io::$nl,'Stampa Prodotto Modificato:',io::$nl;
$prodotto->stampa();
?>
</pre>
</body>
</html>