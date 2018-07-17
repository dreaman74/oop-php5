<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 31 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	ol,ul{line-height:1.5em;}
	p {margin:0px;padding:0px;}
	pre {
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
	table, th, td {border-collapse:collapse;padding:5px;}
	th {border: 1px solid red;text-align:center;}
	td {border: 1px solid grey;text-align:center;}
</style>
</head>
<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 31</strong>
	</p>
	
	<h1>[31] Tutto sulle stringhe - parte 3 di 5</h1>
	
	<p>Creiamo una Form, usiamo i suoi dati ed elaboriamoli per:
		<ul>
                    <li>Eliminare spazi o altri caratteri all'inizio o alla fine di una stringa:
                        <ul>
                            <li><a href="#ltrim" title="ltrim">ltrim</a>;</li>
                            <li><a href="#rtrim" title="rtrim">rtrim</a>;</li>
                            <li><a href="#trim" title="trim">trim</a>.</li>
                        </ul>
                    </li>
                    <li>Passare dal maiuscolo a minuscolo o maiuscoletto:
                        <ul>
                            <li><a href="#strtolower" title="strtolower">strtolower</a>;</li>
                            <li><a href="#mb_strtolower" title=""mb_strtolower">mb_strtolower</a></li>
                            <li><a href="#strtoupper" title="strtoupper">strtoupper</a>;</li>
                            <li><a href="#mb_strtoupper" title=""mb_strtoupper">mb_strtoupper</a></li>
                            <li><a href="#ucfirst" title="ucfirst">ucfirst</a>;</li>
                            <li><a href="#ucwords" title="ucwords">ucwords</a>.</li>
                        </ul>
                    </li>
		</ul>
	</p>
	
	<hr />
        
        <h2>Form</h2>
        
        <h3>Pagina del Form</h3>
        <h4>Codice</h4>
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
<form name="test" action="estringhe02.php" method="post" enctype="application/x-www-urlencoded">
Cognome <input type="text" id="cognome" name="cognome" value="" size="40" maxlength="40" /><br />
Nome <input type="text" id="nome" name="nome" value="" size="40" maxlength="40" /><br />
Cod. Fiscale <input type="text" id="cf" name="cf" value="" size="16" maxlength="16" /><br />
<input type="submit" /> <input type="reset" />
</form>
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
<?php
$codice=<<<'CODICE'
<form name="test" action="" method="post" enctype="application/x-www-urlencoded">
Cognome <input type="text" id="cognome" name="cognome" value="" size="40" maxlength="40" /><br />
Nome <input type="text" id="nome" name="nome" value="" size="40" maxlength="40" /><br />
Cod. Fiscale <input type="text" id="cf" name="cf" value="" size="16" maxlength="16" /><br />
<input type="submit" /> <input type="reset" />
</form>
CODICE;

        echo "<pre>".$codice."</pre>";
?>
        <hr />
        
        <h3>Pagina estringhe02.php</h3>
        <p>Il codice legge e stampa a video le queries Post passate dal form. Non apporta alcuna formattazione alla query in ingresso.</p>
        
        <h4>Codice</h4>
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
    <title>Legge le Query Post del Form</title>
</head>

<body>
<?php
    $cognome = $_REQUEST['cognome'];
    echo $cognome;
?>
</body>
</html>
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>        
        <h4>Visualizzato nel Browser</h4>
        <?php
        $cognome = isset($_REQUEST['cognome']) ? $_REQUEST['cognome'] : '';
        echo "<pre>Cognome [".$cognome."]</pre>";
        ?>
        
        <hr />
        
        <h2 id="ltrim">ltrim</h2>
        <p>URL <a href="http://php.net/manual/it/function.ltrim.php" title="Manuale di PHP.net di ltrim">http://php.net/manual/it/function.ltrim.php</a></p>
        <p style="margin-top:10px;">Restisuisce una stringa privata, a sinistra, di eventuali spazi, caratteri di tabulazione, a capo e tutti quei caratteri che vengono assimilati a caratteri vuoti. 
            <b>Passando un 2° argomento</b> ( $character_mask) [opzionale], <b>è possibile indicare i caratteri specifici che si vogliono eliminare</b> (in questo caso bisogna dichiarare 
        anche eventuali caratteri vuoti da eliminare).</p>
        
        <h3>Eliminare caratteri vuoti</h3>
        
        <p><b>Senza il secondo argomento, la funzione ltrim elimina i seguenti caratteri:</b></p>
        <ul>
            <li>" " (ASCII 32 (0x20)), uno spazio ordinario.</li>
            <li>"\t" (ASCII 9 (0x09)), una tabulazione.</li>
            <li>"\n" (ASCII 10 (0x0A)), una nuova linea (line feed).</li>
            <li>"\r" (ASCII 13 (0x0D)), un ritorno a capo.</li>
            <li>"\0" (ASCII 0 (0x00)), il byte NUL.</li>
            <li>"\x0B" (ASCII 11 (0x0B)), una tab verticale.</li>
        </ul>
        
        <h4>Codice</h4>
<?php
$codice =<<<'CODICE'
$cognome = $_REQUEST['cognome'];
$cognome = ltrim($cognome);
echo $cognome;
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <h4>Visualizzato nel Browser</h4>
        <?php
        $cognome = $_REQUEST['cognome'];
        $cognome = ltrim($cognome);
        
        echo "<pre>Cognome [".$cognome."]</pre>";
?>
        <h3>Eliminare caratteri specifici</h3>
        <p>Come anticipato, è possibile <b>indicare altri caratteri specifici da eliminare passando un 2° argomento ( $character_mask)</b> all'invocazione della funzione ltrim.</p>
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">In questo caso, bisogna dichiarare anche gli spazi vuoti, di tabulazione e altri caratteri non visibili che
            si vogliono eliminare.</p>
        
        <p>Per esempio, eliminare i simboli di cancelletto # e spazi vuoti (spazio ordinario).</p>
        
        <h4>Codice</h4>
<?php
$codice =<<<'CODICE'
$cognome = $_REQUEST['cognome'];
$cognome = ltrim($cognome,'# ');
echo $cognome;
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <h4>Visualizzato nel Browser</h4>
        <?php
        $cognome = $_REQUEST['cognome'];
        $cognome = ltrim($cognome,"# ");
        
        echo "<pre>Cognome [".$cognome."]</pre>";
?>
        <h4>Uscita dalla funzione ltrim per mancata corrispondenza</h4>
        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">Nel caso la stringa inizi con un carattere non menzionato nel 2° Argomento ( $Character_mask ), 
            ci sarà l'uscita immediata dalla funzione, senza che vengano effettuate altre sostituzioni nel resto della stringa per i caratteri specificati.</p>
        
        <p>Nell'esempio seguente <b>saranno eliminati</b></p>
        <ul>
            <li>i simboli di <b>cancelletto</b> e gli <b>spazi ordinari</b>;</li>
            <li>ma <b>NON</b> le lettere <b>o</b> e <b>m</b> perché alla sinistra della stringa è presente prima la lettera <b>T</b>.</li>
        </ul>
        
        
<?php
$codice =<<<'CODICE'
$cognome = "#     #     Tomei";
$cognome = ltrim($cognome,'# om');
echo $cognome;
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <p><b>Visualizzato nel Browser</b></p>
        <?php
        $cognome = "#     #     Tomei";
        $cognome = ltrim($cognome,'# om');
        echo "<pre>".htmlspecialchars($cognome)."</pre>";
        ?>
        
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">Per capire meglio questo concetto, basta ricordare che <b>il trimming</b> si ferma al primo carattere, partendo da sinistra, che non è stato specificato nel $character_mask, 
            quindi i caratteri successivi nella stringa, anche se corrispondono a quelli specificati nel $character_mask, non saranno eliminati.</p>
        
        <p style="margin-top:10px;font-weight: bold;">Altro esempio</p>
<pre>
So in the $string = "Hello world" example with $character_mask = "Hdle", ltrim($hello, $character_mask) goes like this:
1. Check H from "Hello world" => it is in the $character_mask, so remove it
2. Check e from "ello world" => it is in the $character_mask, so remove it
3. Check l from "llo world" => it is in the $character_mask, so remove it
4. Check l from "lo world" => it is in the $character_mask, so remove it
5. Check o from "o world" => it is NOT in the $character_mask, exit the function

Remaining string is "o world".
</pre>
        
        <hr />
        
        <h2 id="rtrim">rtrim</h2>
        <p>URL <a href="http://php.net/manual/it/function.rtrim.php" title="Manuale di PHP.net di ltrim">http://php.net/manual/it/function.rtrim.php</a></p>
        <p style="margin-top:10px;">Vale lo stesso discorso fatto per la funzione ltrim ma l'eliminazione dei caratteri viene fatta partendo dalla destra della stringa.</p>
        
        <hr />
        
        <h2 id="trim">trim</h2>
        <p>URL <a href="http://php.net/manual/it/function.trim.php" title="Manuale di PHP.net di ltrim">http://php.net/manual/it/function.trim.php</a></p>
        <p style="margin-top:10px;">Funzione bivalente, elimina i caratteri vuoti o specificati sia a destra sia a sinistra della stringa (ltrim e rtrim contemporaneamente).</p>
        
        <hr />
        
        <h2>Gestione del testo</h2>
<?php
$codice =<<<'CODICE'
<h3 id="strtolower">%s strtolower()</h3>
<p>PHP.net reference: <a href="http://php.net/manual/en/function.strtolower.php" title="strtolower su php.net" target="_blank">strotolower</a></p>
<p style="margin-top:10px;">Trasforma tutto il testo (lettere - caratteri alfabetici) in minuscolo. <b>Utilizza il Character Encoding Locale.</b></p>

<h4>Sintassi</h4>
<pre>string strtolower ( string $string );</pre>
<p>Returns string with all alphabetic characters converted to lowercase.</p>

<h4>Argomenti</h4>

<p><b>string (1° Argomento)</b></p>
<p>The string being lowercased.</p>

<h4>Valore restituito</h4>
<p>string with all alphabetic characters converted to lowercase.</p>

<p style="background-color:yellow;margin-top:10px;padding:5px;">
Note that 'alphabetic' is determined by the current locale. This means that e.g. in the default "C" locale, characters such as umlaut-A (Ä) will not be converted.
</p>

<hr />

<h3 id="mb_strtolower">%s mb_strtolower()</h3>
<p>PHP.net reference: <a href="http://php.net/manual/en/function.mb-strtolower.php" title="mb_strtolower su php.net" target="_blank">mb_strotolower</a></p>
<p style="margin-top:10px;">Trasforma tutto il testo (lettere - caratteri alfabetici) in minuscolo. <b>Specifica il Character Encoding da utilizzare, con il 2° argomento.</b></p>

<h4>Sintassi</h4>
<pre>string mb_strtolower ( string $str [, string $encoding = mb_internal_encoding() ] );</pre>
<p>Returns string with all alphabetic characters converted to lowercase.</p>

<h4>Argomenti</h4>

<p><b>string (1° Argomento)</b></p>
<p>The string being lowercased.</p>

<p style="margin-top:10px;"><b>encoding (2° Argomento [opzionale])</b></p>
<p>The encoding parameter is the character encoding. If it is omitted, the internal character encoding value will be used.</p>

<h4>Valore restituito</h4>
<p>string with all alphabetic characters converted to lowercase.</p>

<p style="background-color:yellow;margin-top:10px;padding:5px;">
<b>Con il 2° argomento, opzionale, si specifica il Character Encoding da utilizzare; se non presente viene utilizzato il Character Encoding Locale.</b>
</p>

<hr />

<h3 id="strtoupper">%s strtoupper()</h3>
<p>PHP.net reference: <a href="http://php.net/manual/en/function.strtoupper.php" title="strtoupper su php.net" target="_blank">strtoupper</a></p>
<p>Trasforma tutto il testo (lettere - caratteri alfabetici) in maiuscolo. <b>Utilizza il Character Encoding Locale.</b></p>

<p style="background-color:yellow;margin-top:10px;padding:5px;">
Note that 'alphabetic' is determined by the current locale. This means that e.g. in the default "C" locale, characters such as umlaut-A (Ä) will not be converted.
</p>

<hr />

<h3 id="mb_strtoupper">%s mb_strtoupper()</h3>
<p>PHP.net reference: <a href="http://php.net/manual/en/function.mb-strtoupper.php" title="mb_strtoupper su php.net" target="_blank">mb_strotoupper</a></p>
<p style="margin-top:10px;">Trasforma tutto il testo (lettere - caratteri alfabetici) in maiuscolo. <b>Specifica il Character Encoding da utilizzare, con il 2° argomento.</b></p>

<p style="background-color:yellow;margin-top:10px;padding:5px;">
<b>Con il 2° argomento, opzionale, si specifica il Character Encoding da utilizzare; se non presente viene utilizzato il Character Encoding Locale.</b>
</p>

<hr />

<h3 id="ucfirst">%s ucfirst()</h3>
<p>PHP.net reference: <a href="http://php.net/manual/en/function.ucfirst.php" title="ucfirst su php.net" target="_blank">ucfirst</a></p>
<p>Trasforma in maiuscolo la prima lettera solo della prima parola.</p>

<hr />

<h3 id="ucwords">%s ucwords()</h3>
<p>PHP.net reference: <a href="http://php.net/manual/en/function.ucwords.php" title="ucwords su php.net" target="_blank">ucwords</a></p>
<p>Trasforma in maiuscolo la prima lettera di tutte le parole.</p>
CODICE;

printf($codice,"&rtrif;","&rtrif;","&rtrif;","&rtrif;","&rtrif;","&rtrif;");
?>
        
        <hr />
        
        <h3>Importante</h3>
        <p style="background-color:yellow;margin-top:10px;padding:5px;">Importante: Le funzioni <b>ucfirst</b> e <b>ucwords</b> restituiscono il risultato atteso, 
            solo se l'argomento passato è rappresentato da una stringa contenente il testo tutto in minuscolo 
            (tramite la funzione <b>strotolower</b> convertire tutto il testo della stringa in minuscolo, prima di passare la stessa alle funzioni).</p>
        
        <hr />
        
<h3>Esempi vari</h3>
<pre>
<?php
$nl = "<br />";

// Query POST
$cognome = isset($_REQUEST['cognome']) ? $_REQUEST['cognome'] : '';

echo "Query Post in ingresso: <b>$cognome</b> (Testo originale)$nl$nl";

echo "<b>strotolower</b> > trasforma in minuscolo tutto il testo$nl";
echo "Utilizza la codifica Charset Locale$nl";
echo strtolower($cognome).$nl;

echo "<b>// strtolower() > doesn't work for polish chars</b>$nl";
echo "strtolower('mĄkA'')$nl";
echo "Risultato: ".strtolower('mĄkA').$nl.$nl; 
echo "<b>// mb_strtolower() > The Best Solution</b>$nl";
echo "<b>mb_strtolower('mĄkA','UTF-8');</b>$nl"; 
echo "Risultato: <b>".mb_strtolower('mĄkA','UTF-8')."</b>$nl$nl";

echo "<b>strotoupper</b> > trasforma in maiuscolo tutto il testo$nl";
echo strtoupper($cognome).$nl;

echo "<b>ucfirst</b> > trasforma in maiuscolo ";
echo "solo la prima lettera della prima parola$nl";
echo ucfirst(strtolower($cognome)).$nl;

echo "<b>ucwords</b> > trasforma in maiuscolo ";
echo "la prima lettera di tutte le parole$nl";
echo ucwords(strtolower($cognome));
?>
</pre>
</body>
</html>