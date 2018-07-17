<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 54 - Le Variabili Superglobali Predefinite e PHP.ini - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	html, body {
		margin: 0px;
		padding: 0px;
	}

    body {
    	/*background-color:#555555;*/
		font-size: 100%;
		font-family: Arial, sans-serif;
		width: 100%;
	}

    form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
        
	ol,ul{line-height:1.5em;}
	li {line-height: 3em;}
	li img {margin: 10px 0px;width: 100%;}
        p img {margin: 10px 0px;width: 100%;}
	
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
        
	#breadcrumb {
		background:#efefef;
		border-bottom:#afafaf 1px solid;
		margin:0px;
		padding:10px 10px;
	}
		
	.celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
	.esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
        
	.titolo_paragrafo {color:#224488;font-size:2.5em;}
	.sottotitolo_paragrafo {color:#44aaee;font-size:2em;}
	
	.box_giallo {background-color: yellow;margin:10px 0px;padding:5px;}
</style>
</head>

<body>
    <p id="breadcrumb">
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 54</strong>
    </p>

    <h1>[54] Le Variabili Superglobali Predefinite e configurazione del PHP.ini</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 3</b></p>
    
    <p class="titolo_paragrafo">Le Variabili Superglobali Predefinite di PHP:</p>
    <ul>
        <li>$_GLOBAL</li>
        <li><a href="#server" title="array $_SERVER">$_SERVER</a></li>
        <li><a href="#enviroment" title="array $_ENV">$_ENV</a></li>
        <li>$_FILES</li>
        <li><a href="#cookie" title="array $_COOKIE">$_COOKIE</a></li>
        <li><a href="#get" title="array $_GET">$_GET</a></li>
        <li><a href="#post" title="array $_POST">$_POST</a></li>
        <li><a href="#request" title="array $_REQUEST">$_REQUEST</a></li>
        <li>$_SESSION</li>
    </ul>
    
    <div class="codice">
        <p class="sottotitolo_paragrafo">Approfondimenti</p>
        <ul>
            <li><p>Consulta la reference di PHP.net per maggiori info sulle 
            <a href="http://php.net/manual/en/language.variables.superglobals.php" title="le variabili superglobali" target="_blank">variabili superglobali predefinite</a> 
            di PHP.</p></li>
            <li><p>Nella lezione viene preso in esame anche il file di configurazione 
            <a href="http://us.php.net/manual/en/ini.core.php#ini.variables-order" title="Abilitare la visualizzazione delle variabili di ambiente nel PHP.ini" target="_blank">
                PHP.ini</a> di PHP, consulta la referense di PHP.net</p></li>
            <li><p><a href="http://php.net/manual/en/reserved.variables.environment.php" title="$_ENV" target="_blank">$_ENV</a> - PHP.net Variabili Predefinite</p></li>
            <li><p><a href="http://php.net/manual/en/function.getenv.php" title="recuperare le variabili di ambiente" title="getenv()" target="_blank">getenv()</a> 
                    - Recupera il valore di una variabile d'ambiente.</p></li>
            <li><p><a href="http://www.vincenzoscognamiglio.it/informatica/2009/07/03/variabili-d-ambiente-apache-ed-estensioni-ssi/" title="" target="_blank">
                        Variabili d'ambiente Apache ed estensioni SSI</a></p></li>
            <li><p><a href="http://www.faqs.org/rfcs/rfc3875.html" title="RFC 3875" target="_blank">RFC 3875</a> - The Common Gateway Interface (CGI) Version 1.1</p></li>
            <li><p><a href="http://www.cgi101.com/book/ch3/text.html" title="" target="_blank">CGI Environment Variables</a></p></li>
        </ul>
    </div>
    
    <hr />
    
    <h2 id="form-esempio">Form di esempio</h2>
    <p>Il <b>Form di esempio</b> utilizzato per gli esempi in questa pagina. Il form invia le <b>query</b> tramite il metodo <b>post</b>.</p>
    
    <h3 class="esempio">Form</h3>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<form name="login" action="" method="post">
    <table>
        <tr>
            <td>Email: </td>
            <td> <input type="email" name="email" value="" /></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td> <input type="password" name="password" value="" autocomplete="off" /></td>
        </tr>
    </table>
    
    <input type="submit" value="ACCEDI" />
    <input type="submit" value="NUOVO UTENTE" />
</form>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    
    <h4>Visualizzato nel Browser</h4>
    <form name="login" action="" method="post" class="codice">
        <table>
            <tr>
                <td>Email: </td>
                <td> <input type="email" name="email" value="" /></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td> <input type="password" name="password" value="" autocomplete="off" /></td>
            </tr>
        </table>

        <input type="submit" value="ACCEDI" />
        <input type="submit" value="NUOVO UTENTE" />
    </form>
    
    <h2 id="server">$_SERVER</h2>
    <p>Fornisce informazioni sul Web Server Apache: tipo di richesta HTTP (GET, POST, etc.), ora del server, Referrer (URL di provenienza), User Agent (Browser), 
        URI, URL, nome del file.php, Cookie, tipi di contenuti accettati, email dell'amministratore, etc. 
    Il Web Server è un software che funziona in un sistema Operativo (Windows, Linux, etc.</p>
    
    <p style="font-weight: bold;margin: 10px 0px;">Tramite l'Array $_SERVER è possibile visualizzare:</p>
    <ul>
        <li>Variabili d’ambiente di Apache</li>
        <li>HTTP Header Variables</li>
        <li>SSI Extensions</li>
    </ul>
    
    <h3 class="esempio">foreach</h3>
    <p style="border-bottom: #a0a0a0 2px solid;margin: 10px 0px;padding-bottom: 10px;">Elenco delle coppie chiave-valore presenti nell'Array Globale $_SERVER:</p>
    
    <div style="padding: 5px;width: 100%;height: 400px;overflow: auto;">
        <?php
        $nl = "<br />";
        foreach($_SERVER as $chiave => $valore){
            echo "<b>$chiave</b>: $valore$nl";
        }
        ?>
    </div>
    
    <h3 class="esempio">Singola Chiave</h3>
    <p>Recuperare il Timestamp, secondi trascorsi dal 1 Gennaio 1970 al momento in cui si effettua la richiesta, e calcolare quanti anni sono passati.</p>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = '<br />';

// Divido i secondi per (secondi in un'ora (60 secondi * 60 minuti) * ore in un giorno * giorni in un anno)
$anni = $_SERVER['REQUEST_TIME'] / (3600 * 24 * 365);
echo 'Anni trascordi dal 1 Gennaio 1970: '. $anni;
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = '<br />';

$anni = $_SERVER['REQUEST_TIME'] / (3600 * 24 * 365);
echo "Anni trascordi dal 1 Gennaio 1970: <b>$anni</b>";
?>
</pre>
</pre>
    
    <h2 id="enviroment">$_ENV</h2>
    <p><strong>$_ENV</strong> è un <strong>Array Associativo</strong> contenente le Variabili d'ambiente del Web Server Apache.</p>
    
    <p style="margin: 10px 0px;">Per visualizzare una variabile di ambiente utilizzare l'array $_ENV con la chiave relativa oppure il ciclo <b>foreach</b> sull' <b>Array di $_ENV</b>. 
        Per Default nel file di configurazione <b>PHP.ini</b>, solitamente, <b>la visualizzazione delle variabili d'ambiente (<b>variables_order</b>) è disabilitata</b>, 
        pertanto <b>l'Array $ENV non viene popolato</b>. Per ovviare è possibile utilizzare la funzione <b>getenv()</b> oppure usare la funzione <strong>phpinfo()</strong> 
        per visualizzare l'elenco completo.<br />
        <span style="color: white;background-color: green;padding: 2px;">Per abilitare la visualizzazione delle variabili di ambiente <b>nell'array $_ENV</b>, vedi la procedura indicata sotto 
            <a href="#abilitare-enviroment-variables" title="come abilitare la visualizzazione delle variabili d'ambiente">
                <span style="color: white;font-weight: bold;">Abilitare $_ENV in PHP.ini</b></a></span>.</p>
    
    <p style="margin: 10px 0px;">These variables are imported into PHP's global namespace from the environment under which the PHP parser is running. 
        Many are provided by the shell under which PHP is running and different systems are likely running different kinds of shells, a definitive list is impossible. 
        Please see your shell's documentation for a list of defined environment variables.</p>

    <p style="margin: 10px 0px;">Other environment variables include the CGI variables, placed there regardless of whether PHP is running as a server module or CGI processor.</p>

    <p style="margin: 10px 0px;">$HTTP_ENV_VARS contains the same initial information, but is not a superglobal. (Note that $HTTP_ENV_VARS and $_ENV are different variables and 
        that PHP handles them as such).</p>
    
    <h3 class="esempio">foreach</h3>
    <div style="padding: 5px;width: 100%;height: 400px;overflow: auto;">
        <?php
        $nl = "<br />";
        foreach($_ENV as $chiave => $valore){
            echo "<b>$chiave</b>: $valore$nl";
        }
        ?>
    </div>
    
    <h3 class="esempio">Getenv()</h3>
    <p>Come visualizzare alcune Variabili d'Ambiente.</p>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = '<br />';

echo 'My COMPUTERNAME is '. @$_ENV['COMPUTERNAME'] .$nl;
echo 'My USERDOMAIN is '. @$_ENV['USERDOMAIN'] .$nl;

echo 'Indirizzo IP dell\'Host '. getenv('REMOTE_ADDR') .$nl;
echo 'My HTTP Referer is '. getenv('HTTP_REFERER') .$nl;
echo 'My Gateway Interface is '. getenv('GATEWAY_INTERFACE') .$nl;
echo 'My Hostname is '. getenv('HTTP_HOST') .$nl;
echo 'My Computername is '. getenv('COMPUTERNAME') .$nl;
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = '<br />';

echo 'My COMPUTERNAME is <b>'. @$_ENV['COMPUTERNAME'] .'</b>'.$nl;
echo 'My USERDOMAIN is <b>'. @$_ENV['USERDOMAIN'] .'</b>'.$nl;

echo 'Indirizzo IP dell\'Host <b>'. getenv('REMOTE_ADDR') .'</b>'.$nl;
echo 'My HTTP Referer is <b>'. getenv('HTTP_REFERER') .'</b>'.$nl;
echo 'My Gateway Interface is <b>'. getenv('GATEWAY_INTERFACE') .'</b>'.$nl;
echo 'My Hostname is <b>'. getenv('HTTP_HOST') .'</b>'.$nl;
echo 'My Computername is <b>'. getenv('COMPUTERNAME') .'</b>'.$nl;
?>
</pre>
    <h3 id="abilitare-enviroment-variables" class="sottotitolo_paragrafo">Abilitare $_ENV in PHP.ini</h3>
    <p>Se, utilizzando $_ENV, viene restituita una stringa vuota, molto probabilmente la visualizzazione delle variabili di ambiente è disabilitata. 
        <b>Per DEFAULT la visualizzazione delle variabili di ambiente è disabilitata</b>, in quanto popolare l'Array $_ENV richiede parecchie risorse al Server APACHE.</p>
    
    <p style="margin: 10px 0px;">Per abilitare la loro visualizzazione, <b>aprire il file PHP.ini</b> e verificare che nella stringa <strong>variables_order</strong> ci sia anche la lettera <b>"E"</b> 
            (modificare da variables_order = "GPCS" in <b>variables_order = "EGPCS"</b>).</p>
    
    <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: Ricordarsi sempre, ogni volta che si effettua una modifica al PHP.ini di PHP o HTTPD.conf di Apache, 
        di <b>riavviare il Server APACHE per attivare le modifiche.</b></p>

    <hr />
    
    <h2 id="cookie">$_COOKIE</h2>
    <p>Visualizzare i cookies salvati nel Browser dell'utente (client).</p>
    
    <p class="codice">Ricordarsi che la funzione <b>setcookie</b>, utilizzata per salvare (creare o modificare) un cookie, <b>deve essere inserita prima di generare gli headers</b> della pagina.</p>
    
    <h3 class="esempio">Creare un Cookie</h3>
    <p>Creiamo un Cookie con validità di un'ora, timeout è ottenuto sommando la data in secondi al momento della creazione + 3600.</p>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
    setcookie("CookieProva", "Valore del Cookie", time()+3600, "/");
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
...
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h3 class="esempio">Visualizzare i Cookie</h3>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = "<br />";
foreach($_COOKIE as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = "<br />";
foreach($_COOKIE as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
</pre>
    
    <hr />
    
    <h2 id="get">$_GET</h2>
    
    <h3 class="esempio">foreach</h3>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = "<br />";
foreach($_GET as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = "<br />";
foreach($_GET as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
</pre>
    
    <hr />
    
   <h2 id="post">$_POST</h2>
    
   <h3 class="esempio">foreach</h3>
    
   <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = "<br />";
foreach($_POST as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = "<br />";
foreach($_POST as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
</pre>
        
    <hr />
    
    <h2 id="request">$_REQUEST</h2>
    <p>Per Default il PHP <b>visualizza</b> solo le Richieste (Query) <b>POST</b> e <b>GET</b>.</p>
    
    <h3 class="sottotitolo_paragrafo">Abilitare la visualizzazione dei Cookie</h3>
    <p>Per abilitare anche la visualizzazione dei Cookie, <b>aprire il file PHP.ini e modificare</b> la variabile <b>request_order</b> aggiungendo alla stringa la lettera <b>"C"</b> 
        (da request_order = "GP"; modificare in <b>request_order = "GPC";</b>). L'ordine di visualizzazione rispetta l'ordine in cui vengono inserite le lettere nella stringa, 
        in questo caso: (G)ET, (P)OST, (C)OOKIE.</p>

    <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: &Egrave; possibile anche abilitare la visualizzazione delle variabili di ambiente, con le lettere "E" e "S".</p>

    <p class="codice">Maggiori info sulla <a href="http://php.net/manual/en/ini.core.php#ini.request-order" title="stringa di request_order" target="_blank">stringa</a> di 
        <strong>request_order</strong> sulla Reference di PHP.net</p>
    
    <h3 class="esempio">foreach</h3>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = "<br />";
foreach($_REQUEST as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h4>Visualizzato nel Browser</h4>
<pre>
<?php
$nl = "<br />";
foreach($_REQUEST as $chiave => $valore)
    echo "<b>$chiave</b>: $valore$nl";
?>
</pre>
</body>
</html>