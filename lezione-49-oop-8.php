<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 49 - OOP - Ereditarietà 4^ Parte - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
            <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 49</strong>
    </p>

    <h1>[49] OOP Ereditarietà 4^ Parte - Parte 8 di 10</h1>
    <ul>
        <li><p>Le Variabili Membro <a href="#protected" title="accedere alla variabili membro">Protected</a>;</p></li>
        <li><p>Invocare con <a href="#parent" title="la keyword parent">parent</a> un metodo ereditato (da una classe genitore, parent class);</p></li>
        <li><p><a href="#overriding" title="Overriding dei metodi ereditati">Overriding</a> dei metodi ereditati;</p></li>
        <li><p><a href="#esempio-pratico" title="esempio del dado truccato">Esempio pratico</a> del Dado Truccato.</p></li>
    </ul>
    
    <h2 id="protected">Protected</h2>
    <p>Le <strong>variabili membro protected</strong> sono accessibili solo nelle classi in cui vengono dichiarate e in quelle che le ereditano (classi figlie e classi che 
        derivano dalle classi figlie, tutte le classi faenti parte dell'albero che si propaga dalla classe madre.).</p>
    
    <h3 class="esempio">Esempio</h3>
    <p style="marin: 10px 0px;">Questo esempio applicato dimostra che la classe figlia eredita dalla classe madre la variabile membro protected '$numeroFacce':</p>
    
    <h4>Codice</h4>
<pre>
// Classe Madre
class dadoNormale {
    // Stato Interno
    protected $numeroFacce = 6, $valoreAttuale = 0 ;

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
    <h4>Spiegazione del codice</h4>
    <p>La proprietà $numeroFacce, della classe dadoNormale, è accessibile dalla classe figlia dadoTruccato che potrà modificare e prelevare il suo valore.</p>
    
    <hr />
    
    <h2 id="parent">parent</h2>
    <p>In una classe figlia possiamo richiamare un metodo ereditato (da una classe madre, parent class) adoperando la parola <strong>parent</strong>.</p>
    
    <h3 class="celeste">Sintassi</h3>
<pre>
parent::metodo($identificatore [, $identificatore [,$identificatore [, ...]]]);
</pre>
    
    <h3 class="esempio">Esempio 1</h3>
    
    <h4>Codice</h4>
<pre>
// Classe Madre
class dadoNormale {
    // Stato Interno
    protected $numeroFacce = 6, $valoreAttuale = 0 ;

    public function __construct($numeroFacce){
        if($numeroFacce>0) $this->numeroFacce = $numeroFacce ;
    }

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
        parent::__construct($numeroFacce);
        
        if($facciaTruccata<$this->numeroFacce && $trucco>0){
            $this->facciaTruccata = $facciaTruccata;
            $this->quantoTruccata = $trucco;
        }
    }
}

$dado = New dadoTruccato(3, 2, 10);
$dado->lancia();
</pre>
    <h4>Spiegazione del codice</h4>
    <p>Nel costruttore della classe figlia, dadoTruccato, invochiamo il costruttore della classe madre, dadoNormale, passando l'argomento $numeroFacce.</p>
    
    <h3 class="esempio">Esempio 2</h3>
    <p>Area di un Quadrato e Area di un cubo.</p>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class quadrato{
    function area($lato){
        if($lato>0) return $lato*$lato;
    }
}

class cubo extends quadrato{    
    function area($lato){ // Override del metodo area()       
        if($lato>0) return parent::area($lato)*6;  // Richiama il metodo della classe madre
    }
}
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
class quadrato{
    function area($lato){
        if($lato>0) return $lato*$lato;
    }
}

class cubo extends quadrato{
    function area($lato){
        if($lato>0) return parent::area($lato)*6;
    }
}

// MAIN CODE
$quadrato = new quadrato;
echo "Area del QUADRATO > {$quadrato->area(10)} (Lato 10)";

echo "<br />";

$cubo = new cubo;
echo "Area del CUBO > {$cubo->area(10)} (Lato 10)";
?>
</pre>
    
    <hr />
    
    <h2 id="overriding">Overriding</h2>
    <p>Con il termine <strong>Override</strong> si fa riferimento alla <b>sostituzione di un metodo ereditato</b>. In pratica, quando in una classe figlia si crea un metodo 
        con un nome funzione identico ad uno presente nella classe ereditata (classe madre), di fatto andiamo a sovrascrivere quel metodo, quindi il comportamento, 
        nella classe figlia.</p>
    
    <p style="margin: 10px 0px;"><b><u>Un oggetto cerca il metodo invocato prima nella classe istanziata</u></b>, <b>in seguito</b>, 
        nel caso non lo trovi, <b>lo cerca nella classe genitore</b>. La ricerca del metodo avviene risalendo l'albero dell'ereditarietà, di classe in classe, 
        fino a fermarsi alla classe madre principale (la superclasse).</p>
    
    <h3 class="esempio">Esempio</h3>
    <p><b>In questo codice viene eseguito il metodo lancia() presente nella classe figlia dadoTruccato, anche se questo è presente in entrambre le classi.</b> 
        In quanto la ricerca di un metodo avviene risalendo la gerarchia delle classi, quindi prima viene cercato nel contesto della classe da cui si è creata 
        l'istanza dell'oggetto.</p>
    
    <h4>Codice</h4>
<pre>
// Classe Madre
class dadoNormale {
    // Stato Interno
    protected $numeroFacce = 6, $valoreAttuale = 0 ;

    public function __construct($numeroFacce){
        if($numeroFacce>0) $this->numeroFacce = $numeroFacce ;
    }

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
        parent::__construct($numeroFacce);
        
        if($facciaTruccata<$this->numeroFacce && $trucco>0){
            $this->facciaTruccata = $facciaTruccata;
            $this->quantoTruccata = $trucco;
        }
    }
}

$dado = New dadoTruccato(3, 2, 10);
$dado->lancia();
</pre>
    
    <hr />
    
    <h2 id="esempio-pratico">DadoTruccato</h2>
    <p></p>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
// Classe Madre
class dadoNormale {

    // Stato Interno
    // Rendo le variabili membro visibili alla classe madre 
    // e a quelle che erditano da essa
    protected $numeroFacce = 6, $valoreAttuale = 0 ;

    public function __construct($numeroFacce){
        if($numeroFacce>0) $this->numeroFacce = $numeroFacce ;
    }

    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce);
        return $this->valoreAttuale;
    }
}

class dadoTruccato extends dadoNormale{

    // Stato Interno
    private $facciaTruccata = 0, $quantoTruccata = 0 ;
    
    function __construct($numeroFacce, $facciaTruccata, $trucco){
        // Invoca il metodo della classe madre
        parent::__construct($numeroFacce);
        
        if($facciaTruccata<$this->numeroFacce && $trucco>0){
            $this->facciaTruccata = $facciaTruccata;
            $this->quantoTruccata = $trucco;
        }

    }
    
    // Override del metodo lancia() della classe madre
    // L'oggetto eseguirà questo metodo
    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce + $this->quantoTruccata);
        
        if($this->valoreAttuale > $this->numeroFacce)
            $this->valoreAttuale = $this->facciaTruccata;
            
        return $this->valoreAttuale;
    }
}

// ---------- Main Script ----------
$dadoTruccato = New dadoTruccato(8, 5, 12);

for($lanci=1; $lanci<=20; $lanci++)
    echo "Lancio $lanci - <b>FACCIA [ {$unDadoTruccato->lancia()} ]</b>".io::NL;
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$unDadoTruccato = New DadoTruccato(8, 5, 10);
?>
CODICE;
echo htmlspecialchars($codice);

include ("lezione-49/classi.dado.php");
echo io::NL, io::linea('-', 70), io::NL;

// Argomenti: Facce del Dado, Faccia Truccata, Livello Trucco
$unDadoTruccato = New DadoTruccato(8, 5, 10);

for($lanci=0; $lanci<=20; $lanci++)
    echo "Lancio $lanci - <b>FACCIA [ {$unDadoTruccato->lancia()} ]</b>".io::NL;
?>
</pre>

</body>
</html>