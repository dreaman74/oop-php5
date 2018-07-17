<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 62 - Aspetti Architetturali 1 di 4 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
	h2 {color:#ffffff;background-color:#224488;padding:5px;margin:10px 0px;}
	h3, h4, h5, h6 {margin: 10px 0px;}
        /* Dimensione Caratteri */
        h2, h3 {font-size:2em;}
        h4, h5 {font-size:1.5em;}
        h6 {font-size:1.2em;}
	
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
        .black {color: lightgrey;background-color: #222222;}
        .black a {color: lightgreen;}
        
	.titolo_paragrafo {color:#224488;font-size:2.5em;}
	.sottotitolo_paragrafo {color:#44aaee;font-size:2em;}
	
	.box_giallo {background-color: yellow;margin:10px 0px;padding:5px;}
</style>
</head>

<body>
    <?php
    $nl = "<br />";
    ?>
    
    <p id="breadcrumb">
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 62</strong>
    </p>

    <h1>[62] Aspetti Architetturali 1 di 4</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Document Root e Gerarchia di Include.</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione,
        <a href="lezione-62/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione:</h2>
    <ul>
        <li>La <a href="#document-root" title="La Cartella Root dove punta APACHE">DocumentRoot</a> è la cartella dove APACHE punta per eseguire i <b>file web</b>;</li>
        <li>Maggiore leggibilità del codice, maggiore manutenibilità e maggiore facilità di riutilizzo;
            <ul>
                <li><a href="#wrapper" title="il Wrapper">Wrapper</a> - La funzione che gestisce la connessione a MySQL e al Database;</li>
                <li><a href="#code-page" title="il Code Page">Code Page</a> - La pagina che raccoglie tutte le funzioni comuni alle pagine dell'Applicazione Web;</li>
                <li>Organizzare una <a href="#gerarchia-include" title="gerarchia di include">Gerarchia di 'include'</a>;</li>
            </ul>
        </li>
        <li>I comandi di PHP per includere file esterni in uno script:
            <ul>
                <li><a href="#include" title="include e include_once">include e include_once</a>;</li>
                <li><a href="#require" title="require e require_once">require e require_once</li>
            </ul>
        </li>
    </ul>
    <p class="codice">Approfondimenti sulla libreria di <a href="http://php.net/manual/it/book.mysqli.php" title="la librearia di MySQLi" target="_blank">MySQLi</a> su PHP.net</p>

    <hr />

    <h2 id="document-root">DocumentRoot</h2>
    <p>La <strong>DocumentRoot</strong> è la <b>cartella dove APACHE punta per eseguire i Siti Web</b>. Per Configurazione di <b>DEFAULT</b>, APACHE punta 
        alla cartella <u><strong>htdocs</strong></u>, essa è situata nella cartella di installazione di APACHE.</p>
    
    <h3 class="sottotitolo_paragrafo">httpd.conf</h3>
    <p style="margin: 10px 0px;"><b>&Egrave; possibile modificare il percorso delle pagine web</b> che APACHE deve eseguire. Aprire, con un editor di testi, 
        il file <strong>httpd.conf</strong> posto nella sotto cartella <b>conf</b> di <b>APACHE</b>. Il <b>percorso di default</b>, su <u>ASUS-Z97PRO</u>, 
        è <b>C:\webserver\apache24\conf\httpd.conf</b></p>

    <h4 class="celeste">Modificare la DocumentRoot in httpd.conf</h4>
    <p>Una volta aperto il file <b>httpd.conf</b> cercare la direttiva <b>DocumentRoot</b> che indica la cartella dei Siti Web:</p>
<pre class="black">
[...]
# ------ Default Web Site Path:
# DocumentRoot "c:/Apache24/htdocs"
# &lt;Directory "c:/Apache24/htdocs">
[...]
</pre>
    <h4 class="esempio">Esempio di DocumentRoot modificata</h4>
    <p>Su <b>ASUS-Z97PRO la DocumentRoot è stata modificata</b> come segue nel file di configurazione <b>httpd.conf</b>:
<pre class="black">
# ------ CUSTOM WEB SITE PATH:
DocumentRoot "c:/webserver/www"
&lt;Directory "c:/webserver/www">
</pre>
    
    <h3 class="sottotitolo_paragrafo">PHP: Come recuperare la Document Root</h3>
    <p>In PHP, il comando <strong>$_SERVER['DOCUMENT_ROOT']</strong> restituisce il percorso fisico completo della Document Root di APACHE.</p>

    <h4 class="esempio">Codice di Esempio</h4>
    <p>La Document Root di ASUS-Z97PRO:</p>
<pre>
<?php
$codice = <<< 'CODICE'
// Istruzione PHP che restituisce la Document Root di APACHE
echo $_SERVER['DOCUMENT_ROOT'];
CODICE;
echo htmlspecialchars($codice);

echo $nl,$nl,'// DocumentRoot di APACHE su questo computer',$nl;
echo "<b>{$_SERVER['DOCUMENT_ROOT']}</b>";
?>
</pre>
    
    <h3 class="sottotitolo_paragrafo">Muoversi nel File System dalla Document Root</h3>
    <p >Ricordiamoci che il comando <b>$_SERVER['DOCUMENT_ROOT']</b> restituisce il percorso della <b>cartella Pubblica</b> (Document Root) dove APACHE punta 
        per eseguire i <b>Siti WEB</b>. Concatenando un stringa composta da forward slash, puntini e nomi delle cartelle, possiamo muoverci nel del file system.</p>
    
    <h4 class="esempio">Alcuni esempi:</h4>
    <ul>
        <li>
            <h5>Contenuto della Document Root:</h5>
            <p><b>$cartella_ini=$_SERVER['DOCUMENT_ROOT'].'/';</b></p>
<pre class="black">
<?php
$cartella = $_SERVER['DOCUMENT_ROOT'].'/';
echo "Contenuto di $cartella$nl\n";

visualizza_contenuto_cartella($cartella)
?>
</pre>
        </li>
        <li>
            <h5>Risalire di 1 livello la Document Root:</h5>
            <p><b>$cartella = $_SERVER['DOCUMENT_ROOT'].'/../';</b></p>
<pre class="black">
<?php
$cartella = $_SERVER['DOCUMENT_ROOT'].'/../';
echo "Contenuto di $cartella$nl\n";

visualizza_contenuto_cartella($cartella)
?>
</pre>
        </li>
        <li>
            <h5>Risalire di 2 livelli la Document Root:</h5>
            <p><b>$cartella = $_SERVER['DOCUMENT_ROOT'].'/../../';</b></p>
<pre class="black" style="overflow-x: auto;">
<?php
$cartella = $_SERVER['DOCUMENT_ROOT'].'/../../';
echo "Contenuto di $cartella$nl\n";

visualizza_contenuto_cartella($cartella)
?>
</pre>
        </li>
        <li>
            <h5>Contenuto della cartella di installazione di APACHE:</h5>
            <p>Il contenuto della cartella di installazione di APACHE.</p>
            <p><b>$cartella = $_SERVER['DOCUMENT_ROOT'].'/../apache24/';</b></p>
<pre class="black">
<?php
$cartella = $_SERVER['DOCUMENT_ROOT'].'/../apache24/';
echo "Contenuto di $cartella$nl\n";

visualizza_contenuto_cartella($cartella)
?>
</pre>
        </li>
    </ul>
    
<?php
function visualizza_contenuto_cartella($cartella){
    if (is_dir($cartella)) {
        if ($dh = opendir($cartella)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..")
                    echo "filename: $file : filetype: " . filetype($cartella.$file) . "\n";
            }
            closedir($dh);
        }
    }
}
?>

    <hr />

    <h3 class="sottotitolo_paragrafo">Come visualizzare il contenuto delle Directory</h3>

    <h4>id_dir</h4>
    <p class="codice">Vedi la Reference ufficiale di PHP.net per la funzione  
        <a href="http://php.net/manual/it/function.is-dir.php" title="File System Function > is_dir" target="_blank">is_dir</a> del File System.</p>

    <h4>opendir</h4>
    <p class="codice">Vedi la Reference ufficiale di PHP.net per la funzione  
        <a href="http://php.net/manual/it/function.opendir.php" title="File System Function > opendir" target="_blank">opendir</a> del File System.</p>

    <h4>readdir</h4>
    <p class="codice">Vedi la Reference ufficiale di PHP.net per la funzione  
        <a href="http://php.net/manual/it/function.readdir.php" title="File System Function > readdir" target="_blank">readdir</a> del File System.</p>
    
    <h4>glob</h4>
    <p class="codice">Vedi la Reference ufficiale di PHP.net per la funzione  
        <a href="http://php.net/manual/en/function.glob.php" title="File System Function > glob" target="_blank">glob</a> del File System.</p>

    <hr />

    <h2 id="wrapper">Wrapper</h2>
    <p style="margin: 10px 0px;">&Egrave; consigliato creare una <b>funzione che gestisce tutte le connessioni al Server MySQL e le interrogazioni al database 
            'quizmaker'.</b> Questa funzione viene detta <strong><u>Wrapper</u></strong> e salvata in un file richiamabile tramite inclusione da tutte quelle pagine che hanno bisogno di interfacciarsi 
        al Database. La creazione del wrapper è comodo per centralizzare tutte le funzioni di manipolazione, in questo modo tutte le modifiche ad essa si riflettono 
        a tutte le pagine che la richiamano. Un altro motivo dell'utilizzo di una funzione comune è la facilità di aggiornamento, per esempio, se l'Adapter MySQLi 
        dovesse essere deprecato, o peggio non supportato dalle versioni future di PHP, sarà possibile modificare il metodo di connessione, l'oggetto e i relativi 
        metodi e classi nella funzione senza che questo si rifletta sulle istruzioni esterne che la richiamano.</p>
   
    <hr />
    
    <h2 id="code-page">Code Page</h2>
    <p style="margin: 10px 0px;">Questo discorso è valido anche per tutte quelle istruzioni comuni a molte pagine dell'Applicazione Web: meglio concentrarle in 
        un'unica pagina esterna.<br />
        <b>La pagina che ingloba tutte le funzioni comuni viene definita <strong><u>Code Page</u></strong>.</b></p>
    
    <hr />
    
    <h2 id="gerarchia-include">Gerarchia di Include</h2>
    <p>Le <b><u>credeziali di accesso</u> a MySQL e Database</b>, sono presenti nel file <b>configDB.ini</b> salvato in una cartella esterna alla Document Root di Apache 
        - cartella pubblica.</p>
        
    <h3 class="sottotitolo_paragrafo">Schema di elogin.php</h3>
    <p>Segue lo schema esplicativo della gerarchia di include con realtiva descrizione per l'app Quiz Maker che stiamo sviluppando.</p>
    <ol>
        <li>
            <p>il file <b>elogin.php</b>, tramite il codice sotto riportato, <u>include</u> il file <b>setup_con_DB.php</b>:</p>
<pre>
include($_SERVER['DOCUMENT_ROOT'].'/miei_test/fcamuso/lezione-62/my_include/setup_con_DB.php');
</pre>
        </li>
        <li>
            <p>il file <b>'setup_con_DB.php'</b> <u>include</u> i files <b>setup.php</b> e <b>configDB.ini</b>:</p>
<pre>
// Setup Standard
include($_SERVER['DOCUMENT_ROOT'].'/miei_test/fcamuso/lezione-62/my_include/setup.php');

// Recupero credenziali da file .INI
$accessData=parse_ini_file($cartella_ini.'/configDB.ini');
</pre>
        </li>
        <li>
            <p>il file <b>setup.php</b> assegna alla variabile <b>$cartella_ini</b> il percorso della cartella <b>my_ini</b> e 
                <u>include</u> il file <b>messaggi_errore.ini</b>:</p>
<pre>
session_start();

$nl="&lt;br /&gt;";

$cartella_ini=$_SERVER['DOCUMENT_ROOT'].'/miei_test/fcamuso/lezione-62/my_ini';

//recupero messaggi di errore da File .INI
$messaggi_errore=parse_ini_file($cartella_ini.'/messaggi_errore.ini');
</pre>
        </li>
        <li>
            <p>Il contenutdo del file <b>confiDB.ini</b>:</p>
<pre>
[mysql] ; Etichetta - Credenziali di Accesso a MySQL Server
host = localhost
username = web_visitor
password = 007

[database] ; Etichetta - Nome del Database
dbname = quizmaker                
</pre>
        </li>
        <li>
            <p>Il contenuto del file <b>messaggi_errore.ini</b>:</p>
<pre>
; Messaggi di Errore
[errori]
connessione_fallita = "Connessione al Server MySQL fallita: Impossibile procedere. Contattare il reparto IT."
db_non_trovato = "Il Database richiesto non è stato trovato..."
</pre>
        </li>
    </ol>
    
    <div class="box_giallo">
        <p>i file <b>confidDB.ini</b> e <b>messaggi_errori.ini</b> sono nella cartella <b>my_ini</b> esterna alla Document Root Pubblica;</p>
        <p>i file <b>setup_con_DB.php</b> e <b>setup.php</b> sono nella cartella <b>my_include</b>, anche questa, esterna alla Document Root Pubblica.</p>
    </div>
    
    <h3 class="sottotitolo_paragrafo">Schema Visivo degli Include</h3>
    <p style="text-align: center;">
        <img src="lezione-62/immagini/schema-include.gif" alt="schema degli include" style="max-width: 1276px;" />
    </p>
    
    <hr />
    
    <h2 id="include">include / include_once</h2>
    <p>L'istruzione <strong>include</strong>, come abbiamo visto in precedenza, <b>carica un file esterno</b> il cui percorso viene indicato come argomento. 
        In caso di gerarchia e gruppi di file esterni, si corre il rischio di inserire più volte lo stesso file. Per ovviare, evitando questa possibilità,  
        usare il comando <strong>include_once</strong>.</p>
    
    <p class="box_giallo"><u>Nel caso i file indicati negli include non siano disponibili</u>, l'<b>esecuzione dello script prosegue ugualmente</b> e 
        viene <b>visualizzato un <u>WARNING</u></b>.</p>
    
    <hr />
    
    <h2 id="require">require / require_once</h2>
    <p>I comandi <strong>require</strong> e <strong>require_once</strong> <u>bloccando l'esecuzione dello script</u> nel caso in cui 
        i file da includere non siano disponibili.<br />
        Il resto del comportamento è identico a quello delle istruzioni <b>include</b> e <b>include_once</b>.</p>

</html>