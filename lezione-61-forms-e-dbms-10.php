<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 61 - Login e Nuovo Utente, rivisti utilizzando OOP di MySQLi - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
    <p id="breadcrumb">
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 61</strong>
    </p>

    <h1>[61] Login e Nuovo Utente, rivisti utilizzando OOP di MySQLi</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 10</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione,
        <a href="lezione-61/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione:</h2>
    <ul>
        <li>$db = @new mysqli(host,username,password)</li>
        <li>$db->connect_error</li>
        <li>@$db->select_db(database name)</li>
        <li>$risultatoRicercaEmail = @$db->query(SQL)</li>
        <li>$risultatoRicercaEmail->fetch_assoc()</li>
        <li>$db->close()</li>
    </ul>
    <p>Gestione degli Errori:</p>
     <ul>
        <li>$db->connect_errno</li>
        <li>$db->connect_error</li>
        <li>$db->sqlstate</li>
    </ul>    
    <p class="codice">Approfondimenti su PHP.net della librearia di <a href="http://php.net/manual/it/book.mysqli.php" title="la librearia di MySQLi" target="_blank">MySQLi</a></p>

    <hr />

    <h2>Utilizzo di MySQLi in OOP</h2>
    
    <h3 class="sottotitolo_paragrafo">$db = new mysqli - Oggetto Connessione</h3>
    <p>Creiamo l'oggetto connessione, salvandolo nella variabile $db. <b>Anteponiamo la A commerciale ( @ )</b> alla Keyword <b>new</b> in fase di creazione dell'istanza per <b>bloccare</b> 
        la visualizzazione automtica dei Messaggi di Errore (<b>Warning</b>).</p>
<pre class="black">
&lt;?php
[...]
// Oggetto Connessione
$db = @new mysqli($accessData['host'],$accessData['username'],$accessData['password']);
[...]
?&gt;
</pre>

    <hr />
    
    <h3 class="sottotitolo_paragrafo">$db->connect_error</h3>
    <p>Una volta creata l'istanza di mysqli, tramite la proprietà <b>connect_error</b> è possibile verificare lo stato della connessione:</p>
    <ul>
        <li><b>TRUE</b>, Connessione Attiva;</li>
        <li><b>FALSE</b>, Non avvenuta in quanto si è presentato un errore di connessione con il Server MySQL.</li>
    </ul>
    <p class="box_giallo"><u>L'Oggetto new mysqli viene sempre creato</u> a prescindere dall'esito della connessione. <b>Per verificare lo stato</b> usare la proprietà <b>connect_error</b> che 
        <b>restituisce TRUE o FALSE</b>.</p>
    
    <h4 class="esempio">Errore di Connessione</h4>
    <p>Se la proprietà <b>connect_error</b> è <b>FALSE</b>, possiamo <b>recuperare il tipo di errore</b> tramite le proprietà dell'oggetto $db (istanza di mysqli):</p>
    <ul>
        <li>$db-><b>connect_errno</b></li>
        <li>$db-><b>connect_error</b></li>
        <li>$db-><b>sqlstate</b></li>
    </ul>
    
    <p>Con il codice seguente verifichiamo lo stato della connessione tramite la proprietà dell'oggetto $db:</p>
<pre class="black">
&lt;?php
[...]
if( $db->connect_error ){
    // FALSE - Gestione dell'errore
    echo $db->connect_errno . $nl;
    echo $db->connect_error . $nl;
    echo $db->sqlstate . $nl;
    echo "Connessione al server fallita. Impossibile procedere. Contattare ...";
    die;
}
[...]
?&gt;
</pre>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">$db->select_db</h3>
    <p>Selezioniamo il Database con cui lavorare. <b>Il metodo restituisce TRUE</b> o, nel caso di errore, <b>FALSE</b>. Anteporre la chiocciola, A commerciale, per inibire la generazione 
        dei messaggi di Warning. Infatti inserendo il metodo <b>select_db</b> come espressione condizionale, in caso questa <b>restituisce FALSE viene eseguito il codice del blocco</b>.</p>
    
    <p class="box_giallo">Attenzione: L'<b><u>operatore logico</u></b> <b>!</b>, il Simbolo di Punto Interrogativo anteposto all'espressione da verificare, equivale a <b><u>diverso da True</u></b>, 
        in questo caso <b>le istruzioni vengono eseguite</b> solo se l'<b>espressione restituisce FALSE</b>.</p>
    
    <p class="codice">Elenco degli <a href="http://php.net/manual/it/language.operators.logical.php" title="" target="_blank">Operatori Logici di PHP</a> su PHP.net</p>
    <h4 class="esempio">Selezione e Gestione Errore</h4>
<pre class="black">
&lt;?php
[...]
if ( ! @$db->select_db($accessData['dbname']) )
{
  echo "Non trovo il data base ...".$nl;

  echo $db->sqlstate . $nl;
  echo $db->connect_errno . $nl;
  echo $db->connect_error . $nl;
  die;
}
[...]
?&gt;
</pre>

    <hr />
    
    <h3 class="sottotitolo_paragrafo">$db->query</h3>
    <p>Reference di PHP.net su <a href="http://php.net/manual/it/mysqli.query.php" title="mysqli::query" target="_blank">mysqli::query</a></p>
    
    <p>Con l'approccio OOP di mysqli, al metodo <b>query</b> dell'<b>oggetto $db</b> si deve <b>passare</b> solo un argomento, <b>la query SQL</b>.</p>
    <p style="margin: 10px 0px;">Il metodo restituisce uno STATO LOGICO:</p>
    <ul>
        <li>Restituisce un <b>OGGETTO</b> di tipo <b>Resultset</b> (SELECT, SHOW, DESCRIBE or EXPLAIN), composto da <b>0 o più righe</b> (<b>ROWS</b>, i records trovati);</li>
        <li><b>FALSE</b> (valore booleano) in caso di <b>errore</b>, sintassi errata per esempio.</p></li>
    </ul>
    <p class="box_giallo">Attenzione: Il metodo <b>query</b> dell'oggetto connessione ($db), <b>restituisce un oggetto resultset</b> anche nel caso non vengano restituite righe [<b>ZERO RIGHE</b>].</p>
    <p class="codice">Nota: Con la funzione <b>mysqli_escape_string($db, $email)</b> effettuo l'<b>escape</b> (sanificazione) della <b>query email</b> presa dal form.</p>

    <h4 class="esempio">Invio e Gestione Errore</h4>
<pre class="black">
&lt;?php
[...]
$comandoSQL =
    "select iduser, psw from users where email ='" . mysqli_escape_string($db, $email) ."'";

//2 inviare il comando
$risultatoRicercaEmail = @$db->query($comandoSQL);

if ($risultatoRicercaEmail){
    // OGGETTO - La Query ha avuto successo
}else{
    // FALSE - La Query SQL ha provocato un errore di esecuzione

    echo "Errore nell'esecuzione della query ".$nl;
    echo $db->sqlstate . $nl;
    echo $db->connect_errno . $nl;
    echo $db->connect_error . $nl;
    die;
}
[...]
?&gt;
</pre>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">$risultatoRicercaEmail->fetch_assoc()</h3>
    <p>Reference di PHP.net su <a href="http://php.net/manual/it/mysqli-result.fetch-assoc.php" title="mysqli::query" target="_blank">mysqli::query</a></p>
    <p>Utilizzare il metodo <b>fetch_assoc</b> per leggere una per una l'insieme delle righe (fieldset) restituite dall'oggetto resultset <b>$risultatoRicercaEmail</b>.</p>
    <p style="margin: 10px 0px;">Il metodo <b>fetch_assoc()</b>, ogni volta che viene chiamato, <b>legge una riga</b>, restituisce un <b>ARRAY ASSOCIATIVO</b> e si blocca a quella successiva 
        senza leggerla. Inserire in un ciclo il metodo per leggere automaticamente un resultset di più fieldset (più righe).</p>
    <p style="margin: 10px 0px;">Le coppie chiave-valore dell'array Associativo, corrispondono alle coppie colonna-valore della tabella presente nel resultset. 
    Se il resultset è composto da 2 o più fields (campi, colonne) con lo stesso nome, l'ultimo field ha la precedenza quindi viene restituito solo l'ultimo valore. 
    Per poter leggere distintamente tutti i fields, utilizzare il metodo <b>fetch_row()</b> dell'oggetto <b>resulset</b> che restituisce un <b>Array con Indice Numerico</b>.</p>
    <p class="box_giallo">Il metodo <b>fetch_assoc</b> restituisce <b>NULL</b>, se <b>non ci sono righe</b> o nel momento in cui si raggiunge la <b>fine del resultset</b>.</p>
<pre class="black">
&lt;?php
[...]
if ($risultatoRicercaEmail){
    // OGGETTO - La Query ha avuto successo

    //3 elaborare il risultato
    if ($riga = $risultatoRicercaEmail->fetch_assoc() ){
        $autenticato = ($psw === $riga['psw']);
    }else
        $autenticato = false;

    [...]
}else{
    // FALSE - La Query SQL ha provocato un errore di esecuzione

    echo "Errore nell'esecuzione della query ".$nl;
    echo $db->sqlstate . $nl;
    echo $db->connect_errno . $nl;
    echo $db->connect_error . $nl;
    die;
}
[...]
?&gt;
</pre>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">Insert into</h3>
    <p>Il metodo <b>$db->query</b> con la query SQL di <b>inserimento</b>, restituisce:</p>
    <ul>
        <li><p><b>TRUE</b> se viene <b>creato il nuovo records</b>;</p></li>
        <li><p><b>FALSE</b> in caso di <b>errore</b>.</p></li>
    </ul>
    
<pre class="black">
&lt;?php
[...]
//BOTTONE NUOVO UTENTE
if ( $riga = $risultatoRicercaEmail->fetch_assoc() ){
    $db->close();
    header("Location: login.php?errore=2"); //email gia' presente
    exit;
}

//insert into users values (null, 'e@j.com','eee')
$comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
$esito = $db->query($comandoSQL);

if ($esito){
    $_SESSION['iduser'] = mysqli_insert_id( $db );
    $db->close();
    header("Location: main.php");
}else{
    $db->close();
    header("Location: login.php?errore=3"); //inserimento fallito
}
[...]
?&gt;
</pre>
    <hr />
    
    <h3 class="sottotitolo_paragrafo">$db->close()</h3>
    <p>Viene chiusa la connessione al Database e al Server MySQL.</p>
<pre class="black">
&lt;?php
[...]
$db->close();
[...]
?&gt;
</pre>
</body>
</html>