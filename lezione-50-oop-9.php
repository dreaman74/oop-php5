<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 50 - OOP - la keyword Final e le Classi Astratte - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
            <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 50</strong>
    </p>

    <h1>[50] OOP - La keyword final e le classi Astratte - Parte 9 di 10</h1>
    <ul>
        <li><p>Con la keyword <strong>final</strong> si <strong>impedisce l' Override dei Metodi e delle implementazioni ereditate</strong> nelle classi figlie:</p>
            <ul>
                <li><p><a href="#metodi-final" title="metodi final">Metodi final</a> per impedire l'Overriding</p></li>
                <li><p>Le <a href="#classi-final" title="classi final">Classi final</a> non possono avere classi derivate (figlie)</p></li>
                <li><p><a href="#classi-abstract" title="classi astratte">Classi astratte</a></p></li>
                <li><p><a href="#metodi-abstract" title="metodi astratte">Metodi astratti</a></p></li>
            </ul>
        </li>
    </ul>
    
    <h2 id="final">final</h2>
    <p class="codice">Vedi la Reference ufficiale di PHP.net per la keyword 
        <a href="http://php.net/manual/en/language.oop5.final.php" title="la keyword final sulla referenze PHP.net" target="_blank">final</a>.</p>
    
    <p>In PHP 5 è stata introdotta la Keyword <strong>final</strong> che impedisce l'overriding dei metodi e l'ereditarietà delle classi.</p>
    
    <p style="color: white;background-color: red;margin: 10px 0px;padding: 5px;"><strong>Le proprietà non possono essere dichiarate final</strong>, 
        a differenza dei metodi e delle Classi.</p>
   
    <h3 id="metodi-final" class="celeste">Metodi final</h3>
    <p>La keyword <strong>final</strong>, applicata alle funzioni di classe, <strong>impedisce l'overriding dei metodi ereditati</strong>, ovvero 
        impedisce la riscrittura di un metodo nelle classi che ereditatno da essa - child class (classe figlia) non può ridefinire un metodo dichiarato final 
        nella classe madre.</p>
        
    <h4 class="esempio">Codice di Esempio</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
class BaseClass {
   public function test() {
       echo "BaseClass::test() called\n";
   }
   
   final public function moreTesting() {
       echo "BaseClass::moreTesting() called\n";
   }
}

class ChildClass extends BaseClass {
   public function moreTesting() {
       echo "ChildClass::moreTesting() called\n";
   }
}
// Results in Fatal error: Cannot override final method BaseClass::moreTesting()
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>    
    <h4>Spiegazione del codice</h4>
    <p><strong>Il Metodo moreTesting()</strong> della classe BaseClass <strong>non può essere ridefinito nella ChildClass</strong>, 
        in quanto questo meotdo <strong>nella classe madre è stato definito final</strong>.</p>
    
    <h3 id="classi-final" class="celeste">Classi final</h3>
    <p style="margin: 10px 0px;">&Egrave; possibile definire final anche le classi che, in questo caso, non potranno avere classi derivate - 
        <strong>nessuna classe può essere figlia di una classe final</strong>.</p>
    
    <h4 class="esempio">Codice di Esempio</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
final class BaseClass {
   public function test() {
       echo "BaseClass::test() called\n";
   }

   // Non è obbligatorio dichiarare il metodo come final, in quanto
   // La classe stessa è definita final
   final public function moreTesting() {
       echo "BaseClass::moreTesting() called\n";
   }
}

class ChildClass extends BaseClass {
}
// Results in Fatal error: Class ChildClass may not inherit from final class (BaseClass)
?>
CODICE;

    echo htmlspecialchars($codice);
?>
</pre>
    <h4>Spiegazione del codice</h4>
    <p><strong>Essendo final</strong>, <strong>la classe BaseClass non può essere ereditata</strong> da altre classi. <b>&Egrave; superflo dichiarare final 
            i metodi</b>, in quanto le classi stesse che li contengono non possono essere estese ad altre classi.</p>
    
    <hr />
    
    <h2 id="abstract">abstract</h2>
    <p class="codice">[ITALIANO] Vedi la Reference ufficiale di PHP.net per le 
        <a href="http://php.net/manual/it/language.oop5.abstract.php" title="astrazioni delle classi su PHP.net" target="_blank">classi astratte</a>.</p>
    
    <p class="codice">[ENGLISH] Vedi la Reference ufficiale di PHP.net per le 
        <a href="http://php.net/manual/en/language.oop5.abstract.php" title="astrazioni delle classi su PHP.net" target="_blank">classi astratte</a>.</p>

    <p>Con il PHP 5 sono stati introdotti i metodi e le classi astratte.</p>

    <h3 id="classi-abstract" class="sottotitolo_paragrafo">Classi Astratte</h3>
<pre>abstract class AbstractClass{ ... };</pre>
    
<p style="margin: 10px 0px;"><strong>Le classi astratte non possono essere istanziate.</strong> <strong>Una classe astratta può contenere sia metodi astratti</strong>, 
    modelli senza implementazione, <strong>sia metodi implementati</strong>. <strong>Una classe per essere dichiarata astratta deve contenere almeno un metodo astratto.</strong></p>
    
    <p><b>I metodi dichiarati astratti non possono avere implementazioni.</b> Lo sviluppatore deve obbligatoriamente definire le implementazioni 
        per i metodi astratti ereditati, nelle classi figlie.</p>
    
    <div class="codice">
        <h4>Caratteristiche delle classi astratte:</h4>
        <ul>
            <li>una classe astratta può contenere variabili e metodi implementati;</li>
            <li>la classe astratta deve contenere almeno un metodo dichiarato abstract;</li>
            <li>i metodi di una classe astratta possono essere definiti con qualsiasi specificatore di visiblità (private, protected e public).</li>
        </ul>
    </div>
    
    <h3 id="metodi-abstract" class="sottotitolo_paragrafo">Metodi Astratti</h3>
<pre>
abstract protected function getValue();
abstract protected function prefixValue($prefix);
</pre>
    <p style="margin: 10px 0px;"><strong>I Metodi Astratti</strong> (presenti solo nelle classi astratte) <strong>sono definiti segnaposto</strong> perché 
        <strong>privi di implementazioni</strong> (<u>funzioni senza istruzioni al proprio interno</u>). Essi rappresentano delle direttive di implementazione per 
        tutte le classi che li ereditano.</p>
    
    <h4 class="esempio">Gli Indicatori di Visibilit&agrave;</h4> 
    <p><strong>&Egrave; consentito estendere ma non restringere l'ambito di visibilità</strong> dei membri astratti.</strong> 
        Per esempio, <span style="color: green;"><strong>è consentito estendere a public l'implementazione</strong> di <strong>un membro astratto protected ereditato</strong></span>, 
        invece <span style="color: red;"><strong>non è consentito restringerne</strong> la visibilità a <strong>private</strong>.</span></p>
            
    <p style="margin: 10px 0px;">Tabella esplicativa degli indicatori di visibilità per i membri astratti:<p>

    <div>
    <table style="border: 1px solid black;border-collapse: collapse;margin: 10px 0px;width: 500px;">
        <caption style="padding:10px;">Indicatore di Visibilità di Partenza dei Membri Astratti</caption>
        <thead>            
            <tr>
                <th>Restringere</th>
                <th>Restringere</th>
                <th>Ereditato</th>
                <th>Estendere</th>
                <th>Estendere</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="2" style="color: red;">Errato</td>
                <td>Stato Iniziale</td>
                <td colspan="2" style="color: green;">Corretto</td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td style="color: red;"></td>
                <td style="color: red;"></td>
                <td>private</td>
                <td style="color: green;">proteced</td>
                <td style="color: green;">public</td>
            </tr>
            <tr>
                <td style="color: red;"></td>
                <td style="color: red;">private</td>
                <td>protected</td>
                <td style="color: green;">public</td>
                <td style="color: green;"></td>
            </tr>
            <tr>
                <td style="color: red;">private</td>
                <td style="color: red;">protected</td>
                <td>public</td>
                <td style="color: green;"></td>
                <td style="color: green;"></td>
            </tr>
        </tbody>
    </table>
    </div>

    <h4 class="esempio">il Modello di implementazione</h4> 
    <p><strong>I Metodi Astratti definiscono dei modelli di configurazione privi di implementazioni che saranno specificate nelle classi derivate.</strong> 
        <strong>I modelli definiscono anche le firme</strong> (numero e argomenti che i metodi accettano). In fase di implementazione, oltre le firme definite nel modello, 
        <strong>&egrave; consentito indicare altri argomenti opzionali</strong> assegnando, ad ognuno di essi, <strong>un valore di default</strong>. 
        <b>Questo vale anche per i costruttori a partire da PHP 5.4.</b> Prima della 5.4 le firme dei costruttori possono essere differenti.</p>

    <h5 style="font-size: 1em;font-weight: bold;">Esempio Pratico</h5>
    <p>Nella classe derivata specificare, in fase di implentazione del metodo, un argomento opzionale oltre le firme accettate dal modello definito dalla classe ereditata:</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
abstract class AbstractClass
{
    // Il modello di implementazione con un argomento richiesto
    abstract protected function prefixName($name);
}

class ConcreteClass extends AbstractClass
{

    // La nostra classe figlio può definire argomenti opzionali non presenti nella firma del padre
    public function prefixName($name, $separator = ".") {
        if ($name == "Pacman") {
            $prefix = "Mr";
        } elseif ($name == "Pacwoman") {
            $prefix = "Mrs";
        } else {
            $prefix = "";
        }
        return "{$prefix}{$separator} {$name}";
    }
}

$class = new ConcreteClass;
echo $class->prefixName("Pacman"), "\n";
echo $class->prefixName("Pacwoman"), "\n";
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h5 style="font-size: 1em;font-weight: bold;">Visualizzato nel Browser</h5>
<pre>
Mr. Pacman
Mrs. Pacwoman
</pre>

</body>
</html>