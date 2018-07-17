<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 51 - OOP - Le Interfacce - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
	
        h1 {margin: 10px 0px;}
	h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;margin:10px 0px;}
	h3, h4, h5, h6 {margin: 10px 0px;}
	
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
            <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 51</strong>
    </p>

    <h1>[51] OOP - Le Interfacce - Parte 10 di 10</h1>
    <ul>
        <li>
            <p><a href="#interface" title="le interfacce">Le interfacce</a></p>
            <ul>
                <li>La keyword <strong>interface</strong> per dichiarare le interfacce;</li>
                <li>La keyword <strong>implements</strong> per implementare l'interfaccia in una classe.</li>
            </ul>
        </li>
        <li><p><a href="#ereditarieta-delle-interfacce" title="ereditarietà delle interfacce">Ereditarietà delle interfacce</a></p>
            <ul>
                <li>Come per le classi, per estendere un'interfaccia in un'altra si usa la keyword <strong>extends</strong>.</li>
                <li><strong>Ereditarietà Multipla</strong> delle interfacce, tramite <strong>extends</strong>.</li>
            </ul>
        </li>
        <li><p>Applicazione pratica, <a href="#applicazione-pratica" title="calcolare l'area di alcune figure geometriche">Calcolare l'area di figure geometriche.</a></p></li>
    </ul>
    
    <h2 id="interface">Le Interfacce</h2>
    <p><strong>Come le classi astratte, <u>le interfacce non possono essere istanziate ma solo implementate</u></strong>. <strong>Le interfacce non contengono variabili</strong>, 
        è possibile specificare <strong>solo costanti e metodi astratti (modelli da implementare)</strong>. Una classe che implementa un'interfaccia deve ridefinire 
        tutti i metodi astratti (i modelli), diversamente deve essere dichiarata astratta. In quest'ultimo caso, l'implementazione di tutti o i restanti modelli sarà affidata 
        ad una sottoclasse derivata dalla classe astratta.</p>
    
    <h3 class="celeste">Interface</h3>
    <p>Un'interfaccia viene definita con la <u>keyword</u> <strong>interface</strong>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
interface Person {
...
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    
    <h3 class="celeste">implements</h3>
    
    <h4 class="esempio">Implementare un'interfaccia in una classe</h4>
    <p><strong>Un'interfaccia viene implementata</strong> in una classe <b>tramite</b> la <u>keyword</u> <strong>implements</strong>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Class implements Interface {
    ...
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    
    <h4 class="esempio">Implementare più interfacce</h4>
    <p>Una classe può implementare più interfacce. Questo è valido se tra esse non esiste alcun conflitto, ovvero non contengono dichiarazioni degli stessi metodi o costanti.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Class implements Interface1, Interface2, Interface3, ... {
    ...
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>

    <h3 class="celeste">Le intefacce in sintesi</h3>
    <div class="codice">    
        <ul>
            <li>un'Interfaccia può contenere solo costanti e metodi senza implementazioni (modelli);</li>
            <li>Tutti i metodi sono dichiarati astratti (abstract) di default;</li>
            <li>L'ambito di visibilità dei metodi è solo public;</li>
        </ul>
    </div>
    
    <h3 class="esempio">Esempio</h3>
    
    <h4>Definizione dell' Intefaccia - Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
// Interfaccia Definizione
interface Person {
    // Solo Costanti, NO Variabili
    const COSTANTE = "valore";
    
    // Metodi Abstract e Public (default)
    public function getName();
    public function setName($nome, $cognome);
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h5 style="font-size: 1em;">Spiegazione del codice</h5>
    <p>Nelle interfacce tutti i metodi sono abstract e public (default), è possbile dichiarare solo le costanti non le variabili.</p>
    
    <h4>Implementazione dell' Interfaccia - Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class Student implements Person {
    // Stato Interno
    private $nome = '', $cognome = '';
    
    // Implementazione dei Metodi
    public function getName(){
        // corpo del metodo
        echo "{$this->nome} {$this->cognome}";
    }
    
    public function setName($nome, $cognome){
        $this->nome = $nome;
        $this->cognome = $cognome;
    }
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h5 style="font-size: 1em;">Spiegazione del codice</h5>
    <p>&Egrave; fondamentale che la classe Student che implementa l'interfaccia Person, ridefinisca il corpo dei metodi astratti getName() e setName() diversamente 
    in mancaza di uno o entrambi PHP restituirà un Fatal Error.</p>
    
    <h4>Main Code - Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$student = new Strudent();
$student->setName("Francesco", "Tomei");
$student->getName();
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>

    <hr />
    
    <h2 id="ereditarieta-delle-interfacce">Ereditarietà delle interfacce</h2>
    <p>Allo stesso modo delle classi, con la keyword <strong>extends</strong> si <strong>estende un'interfaccia in un'altra</strong>.</p>
    
    <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Attenzione: <b>Un'interfaccia può estendere altre interfacce 
            solo se non ci sono conflitti.</b> Per esempio, se Interfaccia A estende B e una delle 2 contiene dei metodi già definiti nell'altra si otterrà errore.</p>
    
    <h3 class="celeste">Ereditarietà Multipla</h3>
    <p><strong>Un'interfaccia può estendere più interfacce</strong>, in questo caso comprenderà tutti i metodi e costanti delle interfacce che estende. Non c'è limite 
        al numero di interfacce che si possono estendere.</p>

    <h4>Codice di esempio</h4>
    <p>Nell'esempio seguente, <b>Interfaccia A estende le Interfacce B, C e D e tutti i metodi e costanti</b>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
interface A extends B, C, D {
    
    // Corpo dell'interfaccia
    ...
    
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>

    <hr />

    <h2 id="applicazione-pratica">Calcolare l'area di figure geometriche.</h2>
    <p></p>
    
    <h3 class="esempio">Esempio pratico</h3>
    
    <h4>Codice dell' Interfaccia</h4>
<pre>
<?php
$codice = <<< 'CODICE'
interface Ordinabile {
    // Metodo Statico Astratto
    public static function confronta($figura1, $figura2);
}
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h4>Codice della Classe Astratta</h4>
<pre>
<?php
$codice = <<< 'CODICE'
abstract class Figure implements Ordinabile {
    
    private
        $colore = '0x0000',
        $lineaTratto = 'solid',
        $lineaSpessore = 1;

    abstract public function area();
    
    public static function confronta($figura1, $figura2){
        if( $figura1->area() == $figura2->area() )
            return 0;

        // Operatore Ternario
        return $figura1->area() < $figura2->area() ? -1 : 1;
    }
}
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h4>Codice delle Classi Figlie</h4>
<pre>
<?php
$codice = <<< 'CODICE'
class Rettangolo extends Figure {
    
    // Stato Interno
    private $lato1 = 0, $lato2 = 0;
    
    public function __construct(){
        $this->lato1 = rand(1,10);
        $this->lato2 = rand(1,10);
    }
    
    public function area(){
        return $this->lato1 * $this->lato2;
    }
}

class Cerchio extends Figure {

    // Stato Interno
    private $raggio = 0;
    
    public function __construct(){
        $this->raggio = rand(1,5);
    }

    public function area(){
        return 3.14 * pow($raggio, 2);
    }
}
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h4>Main Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
$elencoFigure = array();
for($i=0; $i<10; $i++){
    if (rand(1,2) == 1)
        $elencoFigure[$i] = new rettangolo();
    else
        $elencoFigure[$i] = new cerchio();
}

// usort Ordina l'Array $elencoFigure tramite la funzione statica di callback Figure::confronta
usort($elencoFigure, "Figure::confronta");

// Ciclo che Stampa l'Array dopo l'ordinamento con usort
for($i=0; $i<count($elencoFigure); $i++)
    echo $elencoFigure[$i]->area().io::NL
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
</body>
</html>