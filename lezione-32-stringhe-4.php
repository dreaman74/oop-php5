<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 32 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	ol,ul{line-height:1.5em;}
	
        h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;}
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
        
        .celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
        .esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
</style>
</head>

<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 32</strong>
	</p>
	
	<h1>[32] Tutto sulle stringhe - parte 4 di 5</h1>
	
        <p>Creiamo una Form, usiamo i suoi dati ed elaboriamoli per:</p>
        <ul>
            <li><a href="#substr" title="substr">substr()</a> - estrarre una parte di una stringa;</li>
            <li><a href="#substr_count" titlesubstr_countrtrim">substr_count()</a> - controllare che la password non contenga per più di N volte un carattere/stringa;</li>
            <li>cercare occorrenze nelle stringhe, campo password non contenga una certa parola:<br />
                <ul>
                    <li><a href="#strpos" title="strpos()">strpos()</a> - restituisce la prima occorrenza di una stringa in un'altra stringa (Case Sensitive);</li>
                    <li><a href="#stripos" title="stripos()">stripos()</a> - restituisce la prima occorrenza di una stringa in un'altra stringa (Case inSensitive);</li>
                    <li><a href="#strrpos" title="strrpos()">strrpos()</a> - restituisce l'ultima occorrenza di una stringa in un'altra stringa (Case Sensitive);</li>
                    <li><a href="#strripos" title="strripos()">strripos()</a> - restituisce l'ultima occorrenza di una stringa in un'altra stringa (Case inSensitive).</li>
                </ul>
            </li>
            <li><a href="#altre_funzioni" title="altre funzioni per le stringhe">Altre funzioni per le stringhe</a>:
                <ul>
                    <li><b>strstr()</b></</li>
                    <li><b>strpbrk()</b></li>
                    <li><b>preg_match()</b></li>
                </ul>
        </ul>

	
	<hr />
        
        <h2>Form</h2>
        
        <h3>Pagina del Form di esempio</h3>
        <h4>Codice</h4>
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
<form name="test" action="estringhe02.php" method="post" enctype="application/x-www-urlencoded">
Cognome <input type="text" id="cognome" name="cognome" value="" size="40" maxlength="40" /><br />
Nome <input type="text" id="nome" name="nome" value="" size="40" maxlength="40" /><br />
Cod. Fiscale <input type="text" id="cf" name="cf" value="" size="16" maxlength="16" /><br />
Password <input type="password" id="psw" name="psw" value="" size="16" maxlength="16" /><br />
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
Password <input type="password" id="psw" name="psw" value="" size="16" maxlength="16" /><br />
<input type="submit" /> <input type="reset" />
</form>
CODICE;

        echo "<pre>".$codice."</pre>";
?>
        <hr />
        
        <h2 id="substr">substr()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.substr.php" title="substr()" target="_blank">http://php.net/manual/en/function.substr.php</a></p>
        <p style="margin-top: 10px;">La funzione permette di <b>estrarre del testo da una stringa</b>.</p>
        <p style="margin-top: 10px;">If start is non-negative, the returned string will start at the start'th position in string, counting from zero.<br />
            For instance, in the string 'abcdef', the character at position 0 is 'a', the character at position 2 is 'c', and so forth.</p>
        <p style="color:#ff0000;margin-top: 10px;"><b>If string is less than start</b> characters long, <b>FALSE will be returned</b>.</p>

        <h3 class="celeste">Sintassi</h3>
        <pre>string substr ( string $string , int $start [, int $length ] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>string</b> Stringa dalla quale estrarre il contenuto;</li>
            <li><b>start</b> Posizione da cui iniziare l'estrazione, <b>1° carattere è 0 [ZERO]</b>;</li>
            <li><b>length</b> [OPZIONALE] Numero di Caratteri da restituire.</li>
        </ol>
        
        <h3 class="celeste">Valore di Ritorno</h3>
        <p>Returns the extracted part of string; or FALSE on failure, or an empty string.</p>
        
        <h3 class="celeste">Changelog</h3>

        <ul>
            <li>
                <p><b>PHP 7</b></p>
                <p>If string is equal to start characters long, an empty string will be returned. Prior to this version, FALSE was returned in this case.</p>
            </li>
            <li>
                <p><b>PHP 5.2.2 - 5.2.6</b></p>
                <p>If the start parameter indicates the position of a negative truncation or beyond, false is returned. Other versions get the string from start.</p>
            </li>                
        </ul>
        
        <hr />
        
        <h3 class="esempio">Esempio 1</h3>
        <p>[Pagina: estringhe02.php] <b>Estrae 6 caratteri partendo dalla prima posizione 0 [ZERO].</b></p>
        
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
    $CF = $_REQUEST['cf'];
    echo "La codifica cognome-nome del Codice Fiscale è -> ".
        substr($CF, 0, 6);
?>
</body>
</html>
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        $CF = isset($_REQUEST['cf']) ? $_REQUEST['cf'] : '';
        echo "<pre>";
        echo "La codifica cognome-nome del Codice Fiscale è -> <b>".
            substr($CF, 0, 6).
            "</b>";
        echo "</pre>";
        ?>

        <h3 class="esempio">Esempio 2</h3>
        
        <p>[Pagina: estringhe02.php] <b>Estrae tutti i caratteri partendo dalla 7ma posizione [prima posizione uguale a zero].</b></p>
        
        <h4>Codice</h4>
        
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
<?php
    $CF = $_REQUEST['cf'];
    echo "Tutti i caratteri a partire dalla 7ma posizione -> ".
        substr($CF, 6);
?>
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        $CF = isset($_REQUEST['cf']) ? $_REQUEST['cf'] : '';
        echo "<pre>";
        echo "Tutti i caratteri a partire dalla 7ma posizione -> ".
            substr($CF, 6);
        echo "</pre>";
        ?>
        
        <h3 class="celeste">Start</h3>
        
        <p>Usando un <b>numero negativo</b> per l'argomento <b>start</b>, il <b>conteggio inizia da 1</b> partendo dalla fine (da destra) della stringa.</p>
        <p style="margin-top: 10px;"><b>If start is negative</b>, the returned string will start at the start'th character from the end of string.</p>
        
        <h4 class="esempio">Esempio 3</h4>
        
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
<?php
// Restituisce 1 Carattere partendo dalla Fine della Stringa
$rest = substr("abcdef", -1);    // returns "f"

// Restituisce 2 Caratteri partendo dalla Fine della Stringa
$rest = substr("abcdef", -2);    // returns "ef"

// Restituisce solo il 3° Carattere partendo dalla fine della Stringa
$rest = substr("abcdef", -3, 1); // returns "d"
?>
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h3 class="celeste">Length</h3>
        
        <ul>
            <li>If length is given and is positive, the string returned will contain at most length characters beginning from start (depending on the length of string).</li>
            <li>If length is given and is negative, then that many characters will be omitted from the end of string (after the start position has been calculated when a start is negative). 
                If start denotes the position of this truncation or beyond, FALSE will be returned.</li>
            <li>If length is given and is 0, FALSE or NULL, an empty string will be returned.</li>
            <li>If length is omitted, the substring starting from start until the end of the string will be returned.</li>
        </ul>

        <h4 class="esempio">Esempio 4</h4>

<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
<?php
$rest = substr("abcdef", 0, -1);  // returns "abcde"
$rest = substr("abcdef", 2, -1);  // returns "cde"
$rest = substr("abcdef", 4, -4);  // returns false
$rest = substr("abcdef", -3, -1); // returns "de"
?>
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <hr />
        
        <h2 id="substr_count">substr_count()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.substr-count.php" title="substr()" target="_blank">http://php.net/manual/en/function.substr-count.php</a></p>
        <p style="margin-top: 10px;">La funzione restituisce un intero che indica quante volte una determinata stringa (<b>needle</b>) è presente in un'altra (<b>haystack</b>).</p>
        
        <p style="background-color:red;margin:10px 0px;padding:5px;">IMPORTANTE: La Funzione è CASE SENSITIVE!</p>
        <p style="background-color:yellow;margin:10px 0px;padding:5px;">IMPORTANTE: This function doesn't count overlapped substrings (sovrapposizione di stringhe). See the example below!</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>int substr_count ( string $haystack , string $needle [, int $offset = 0 [, int $length ]] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>haystack (pagliaio)</b> la stringa in cui cercare;</li>
            <li><b>needle (ago)</b> la stringa da cercare;</li>
            <li><b>offset (posizione di partenza)</b> [OPZIONALE] La posizione da cui inziare la ricerca;</li>
            <li><b>length (caratteri da restituire)</b> [OPZIONALE] Il numero di caratteri da restituire. <b>Restituisce un warning</b> se length è maggiore della stringa in cui cercare (haystack).</li>
        </ol>
        
        <h3 class="celeste">Valore restituito</h3>
        <p>La funzione substr_count() restituisce un integer (numero intero).</p>
        
        <h3 class="celeste">Changelog</h3>
        <ul>
            <li><p><b>PHP 5.1.0</b></p>
                <p>Added the offset and the length parameters</p>
            </li>
        </ul>
        
        <hr />
        
        <h3 class="esempio">Esempi vari</h3>
        
<?php
$codice=<<<'CODICE'
$text = 'This is a test';
echo strlen($text); // 14

// 'is' è presente 2 volte
echo substr_count($text, 'is'); // 2

// the string is reduced to 's is a test', so it prints 1
echo substr_count($text, 'is', 3); // 1

// the text is reduced to 's i', so it prints 0
echo substr_count($text, 'is', 3, 3); // 0

// generates a warning because 5+10 > 14
echo substr_count($text, 'is', 5, 10); // Warning

// prints only 1, because it doesn't count overlapped substrings
$text2 = 'gcdgcdgcd';
echo substr_count($text2, 'gcdgcd'); // 1
CODICE;

        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h3 class="esempio">Esempio 1</h3>
        <p>[Pagina: estringhe02.php] <b>Conta quante ripetizioni di un carattere ci sono nella password.</b></p>
        
        <h4>Codice</h4>
<?php
// Costrutto NOW DOC
$codice=<<<'CODICE'
<?php
$psw = isset($_REQUEST['psw']) ? $_REQUEST['psw'] : '';
$ripetizioni = 3;
    
echo "<pre>";
echo "Conta quante ripetizioni di un carattere ci sono nella password.";
        
if ($psw)
    for ($pos=0; $pos < strlen($psw); $pos++)
        if (strsub_count($psw,$psw[$pos]) > $ripetizioni)
        {
            echo "Errore! Il carattere '$psw[$pos]' è presente più di $ripetizioni volte";
            break; // Esce dal ciclo for
        }
?>
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h4>Visualizzato nel Browser</h4>
        <?php
        $psw = isset($_REQUEST['psw']) ? $_REQUEST['psw'] : '';
        $ripetizioni = 3;
        $nl = "<br />";
    
        echo "<pre>";
        echo "Conta quante ripetizioni di un carattere ci sono nella password $psw.$nl$nl";
        
        if ($psw)
            for ($pos=0; $pos < strlen($psw); $pos++)
                if (substr_count($psw,$psw[$pos]) > $ripetizioni)
                {
                    echo "Errore! Il carattere '$psw[$pos]' è presente più di $ripetizioni volte.";
                    break; // Esce dal ciclo for
                }
        echo "</pre>";
        ?>
        
        <hr />
        
        <h2 id="strpos">strpos()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.strpos.php" title="strpos()" target="_blank">http://php.net/manual/en/function.strpos.php</a></p>
        <p style="margin-top: 10px;">La funzione <b>strpos()</b> <span style=color:red;">Case Sensitive</span> restituisce la posizione numerica della prima occorrenza 
            di una stringa (<b>needle</b>) all'interno di un'altra (<b>haystack</b>).</p>
        
        <h3 class="celeste">Sintassi</h3>
        <pre>mixed strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )</pre>
        <p style="margin-top: 10px;">Argomenti:</p>
        <ol>
            <li><b>haystack (pagliaio)</b> la stringa in cui cercare;</li>
            <li><b>needle (ago)</b> la stringa da cercare.<br /><span style="color:red;">Se <b>needle</b> non è una stringa</span>, viene convertito in integer (numero intero) 
                ed usato come valore ordinale di un carattere;</li>
            <li><b>offset (posizione di partenza)</b> [OPZIONALE] La posizione da cui inziare la ricerca;</li>
        </ol>

        <pre>IMPORTANTE: La Funzione è <span style="color:red;">CASE SENSITIVE e Binary-safe!</span></pre>
                
        <h3 class="celeste">Valore restituito</h3>
        <p>Restituisce la posizione (integer) della <b>prima occorrenza partendo da sinistra ( da 0 [ZERO] )</b> di <b>needle</b> nella stringa <b>haystack</b>.</p>
        <p style="margin-top: 10px;">Restituisce FALSE se <b>needle</b> non viene trovato.</p>
        
        <hr />
        
        <h3 class="esempio">Esempio 1</h3>
        <p><b>Confronto Stretto</b><br />Utilizzare l'operatore di confronto stretto (strict, === o !==) per il confronto Binary-Safe di valori Booleani.</p>
        
        <h4>Codice</h4>
<?php
// Documento Now Doc
$codice=<<<'CODICE'
// Pagliaio - Stringa in cui cercare
$haystack = "francesco";

// Ago - Stringa da cercare
$needle = "francesco";

// Restituisce posizione > 0 [ZERO]
$pos = strpos($haystack, $needle);

// [ERRORE] - Confronto DEBOLE espressione logica è FALSE
if ($pos)
    echo "<b>needle</b> rilevato alla posizione $pos";
    
// [CORRETTO] Confronto FORTE espressione logica è diverso da FALSE
if ($pos !== false)
    echo "<b>needle</b> rilevato alla posizione $pos";
CODICE;

        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <h4>Visualizzato nel Browser</h4>
        
        <p>Dato che la variabile <b>$pos = 0</b> [ZERO]</p>
        <?php
        $nl = "<br />";
        
        // Pagliaio - Stringa in cui cercare
        $haystack = "francesco";

        // Ago - Stringa da cercare
        $needle = "francesco";

        // Restituisce posizione > 0 [ZERO]
        $pos = strpos($haystack, $needle);

        echo "<pre>";
        echo "[ERRORE]$nl";
        echo "<b>'if (\$pos)' ( Confronto Debole )</b> Espressione Logica restituisce FALSE perché 0 in PHP è FALSE$nl";
        if ($pos)
            echo "<b>needle</b> rilevato alla posizione $pos";
        echo $nl,"[CORRETTO]$nl";
        echo "<b>'if (\$pos !== false)' ( Confronto Forte Bitwise )</b> Espressione Logica restituisce TRUE perché 0 diverso da FALSE$nl";
        if ($pos !== false)
            echo "<b>needle</b> rilevato alla posizione $pos";
        echo "</pre>";
        ?>        
        
        <p style="background-color:red;margin:10px 0px;padding:5px;">Warning: This function may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE. 
            Please read the section on Booleans for more information.<br /><br />
            Use <b>the === strict operator (operatore di confronto stretto)</b> for testing the return value of this function.</p>
        
        <h3 class="esempio">Esempio con ===</h3>
        
        <h4>Codice</h4>
<?php
$codice =<<<'CODICE'
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
if ($pos === false) { // Non esegue
    echo "The string '$findme' was not found in the string '$mystring'";
} else { // Esegue le istruzioni seguenti
    echo "The string '$findme' was found in the string '$mystring'";
    echo " and exists at position $pos";
}
CODICE;

        echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h3 class="esempio">Esempio con !==</h3>
        
        <h4>Codice</h4>
<?php
$codice =<<<'CODICE'
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// The !== operator can also be used.  Using != would not work as expected
// because the position of 'a' is 0. The statement (0 != false) evaluates 
// to false.
if ($pos !== false) {
     echo "The string '$findme' was found in the string '$mystring'";
         echo " and exists at position $pos";
} else {
     echo "The string '$findme' was not found in the string '$mystring'";
}
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        <h3 class="esempio">Esempio con offset</h3>
        
        <h4>Codice</h4>
<?php
$codice =<<<'CODICE'
// We can search for the character, ignoring anything before the offset
$newstring = 'abcdef abcdef';
$pos = strpos($newstring, 'a', 1); // $pos = 7, not 0
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
        
        <hr />
        
        <h2 id="stripos">stripos()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.stripos.php" title="strpos()" target="_blank">http://php.net/manual/en/function.stripos.php</a></p>
        <p style="margin-top: 10px;">La funzione <b>stripos()</b> <span style=color:red;">Case InSensitive</span> restituisce la posizione numerica della <b>prima occorrenza</b> di 
            una stringa (<b>needle</b>) all'interno di un'altra (<b>haystack</b>).</p>
        
        <hr />
        
        <h2 id="strrpos">strrpos()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.strrpos.php" title="strrpos()" target="_blank">http://php.net/manual/en/function.strrpos.php</a></p>
        <p style="margin-top: 10px;">La funzione <b>strrpos()</b> <span style=color:red;">Case Sensitive</span> restituisce la posizione numerica dell'<b>ultima occorrenza</b> 
            di una stringa (<b>needle</b>) all'interno di un'altra (<b>haystack</b>). Quindi, il controllo parte dalla destra di haystack.</p>
        
        <hr />
        
        <h2 id="strripos">strripos()</h2>
        <p>PHP.net Reference <a href="http://php.net/manual/en/function.strripos.php" title="strripos()" target="_blank">http://php.net/manual/en/function.strripos.php</a></p>
        <p style="margin-top: 10px;">La funzione <b>strripos()</b> <span style=color:red;">Case InSensitive</span> restituisce la posizione numerica dell'<b>ultima occorrenza</b> 
            di una stringa (<b>needle</b>) all'interno di un'altra (<b>haystack</b>). Quindi, il controllo parte dalla destra di haystack.</p>
        
        <hr />
        
        <h2 id="altre_funzioni">Altre funzioni di ricerca per le stringhe</h2>
        <ul>
            <li><a href="http://php.net/manual/en/function.strstr.php" title="strstr()" target="_blank"><b>strstr()</b></a> - Find the first occurrence of a string</li>
            <li><a href="http://php.net/manual/en/function.strpbrk.php" title="strpbrk()" target="_blank"><b>strpbrk()</b></a> - Search a string for any of a set of characters</li>
            <li><a href="http://php.net/manual/en/function.preg-match.php" title="preg_match()" target="_blank"><b>preg_match()</b></a> - Perform a regular expression match</li>
        </ul>
</body>
</html>