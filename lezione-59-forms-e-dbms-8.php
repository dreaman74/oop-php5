<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 59 - Redirect e Variabili di Sessione - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 58</strong>
    </p>

    <h1>[59] Redirect e Variabili di Sessione</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 8</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione, 
        <a href="lezione-59/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione</h2>
    <ul>
        <li>Il Redirect con il comando <b>header("location: main.php")</b> e <b>header("Location: login.php")</b> ;</li>
        <li>Come gestire lo <strong>State Less</strong>, la mancanza del passaggio di informazioni stato;</li>
        <li>Recuperare la sessione utente con <a href="#session_id" title="il comando session_id()">session_id()</a>;</li>
        <li>Gestire la sessioni:
            <ul>
                <li>Preparare lo script a gestire le sessioni con il comando <a href="#session_start" title="il comando session_start()">session_start()</a>;</li>                
                <li>Assegnare e Gestire i valori delle chiavi dell'Array Superglobale <a href="#session" title="il comando $_SESSION">$_SESSION['nome_chiave']</a>;</li>
                <li>Eliminare una specifica variabile di sessione indicando la chiave relativa con <a href="#unset" title>unset($_SESSION['chiave'])</a></li>
                <li>Azzerare tutte le chiavi dell'Array $_SESSION annullando tutti i valori dalle chiavi con  
                    <a href="#session_unset" title="il comando session_unset()">session_unset()</a>;</li>
                <li>Distrugge la Sessione attiva con <a href="#session_destroy" title="il comando session_destroy()">session_destroy()</a>;</li>
                <li>Eliminare tutte le variabili di sessione con <a href="#session_array" title="$_SESSION=array()">$_SESSION = array()</a>;</li>
            </ul>
        </li>        
        <li>Come Funziona l' <a href="#applicazione-pratica" title="codice esplicativo dell'applicazione">Applicazione Login Utente</a> con il Redirect e le Sessioni.</li>
    </ul>

    <hr />

    <h2 id="header">Header()</h2>
    <p>Con la funzione <b>header</b>, <b>si effettua il redirect verso un'altra pagina</b>.</p>
    
    <p style="margin: 10px 0px;"><b>Prima di questa funzione non deve essere stato eseguito alcun comando che effettui l'output al browser</b> (non devono essere stati creati 
        TAG head, html, body tantomeno il contenuto). Diversamente, verrà creata un'eccezione ed il PHP restituirà un errore.</p>
    
    <h3 class="celeste">Sintassi</h3>
<pre>
header("location: pagina_di_destinazione.html");        
</pre>
    
    <h3 class="esempio">Esempio di Redirect in elogin.php</h3>
    <p><b>Codice presente nello script di elogin.php</b> che effettua il redirect a main.php se l'autenticazione ha esito positivo, </p>
<pre class="black">
<?php
$codice = <<< 'CODICE'
[...]
// Redirect
if($autenticato){
    header("Location: main.php");
}
else
    header("Location: login.php");
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h2>Persistenza dello stato</h2>
    <p><b>Il funzionamento tipico non prevede un passaggio di informazioni</b> da una pagina ad un'altra, questo comportamento viene definito <b><u>State Less</u></b> 
        (senza stato, senza memoria). Per aggirare i limiti di questo comportamento predefinito, <b>abbiamo bisogno di un sistema di transizione che 
            effettui il passaggio di informazioni di stato</b>.</p>
    
    <hr />
    
    <h2>Le Sessioni</h2>
    <p style="margin: 10px 0px;"><b>Le sessioni</b>, variabili di sessione, offrono un metodo semplice per savlare all'interno di chiavi diversi valori. In questa lezione 
    vediamo sommariamente come funzionano le variabili di sessione. Nelle prossime lezioni dedicate alla Security, andremo ad approfondire i dettagli e i problemi legati 
    alla sicurezza che si celano dietro il loro utilizzo.</p>
    
    <p class="codice">Il seguente contenuto è stato sviluppato prendendo spunto dall' 
        <a href="http://www.mrwebmaster.it/php/sessioni_9507.html" title="le sessioni" target="_blank">articolo pubblicato su www.mrwebmaster.it</a></p>
    
    <p>A differenza dei cookie le sesioni di PHP non scrivono nulla sul computer del utente, ma operano (quasi esclusivamente) sul nostro server scrivendo, 
        all'interno di un'apposita cartella, degli specifici files dove vengono salvati alcuni dati importanti relativamente alla sessione di navigazione del nostro utente.</p>

    <p style="margin: 10px 0px;">Questi file vengono poi "associati" al computer dei nostri utenti mediante due metodi:</p>
    <ol>
        <li><p>Attraverso l'utilizzo di un tipo particolare di cookie detto cookie di sessione;</p></li>
        <li><p>Passando il parametro PHPSESSID all'interno di tutte le URL del sito visitate dallo stesso utente. Ad esempio:</p>
            <p class="codice black">www.miosito.it/pagina.php?PHPSESSID=............</p>
            <p>Nota: Questa tecnica può presentare dei rischi di sicurezza tant'è che molti sviluppatori la disabilitano attraverso il file PHP.INI oppure mediante .htaccess</p>
        </li>
    </ol>
    
    <p style="margin: 10px 0px;">Una volta che la sessione sarà terminata il file con i dati della sessione stessa verrà eliminato così come il cookie di sessione 
        presente sul computer client. Una sessione termina nel momento in cui l'utente chiude il browser (o in un diverso momento eventualmente specificato nelle impostazioni 
        del server o nel codice dell'applicazione).</p>
    
    <p style="margin: 10px 0px;">Le sessioni vengono utilizzate, ad esempio, nella gestione delle autenticazioni (login) degli utenti che, una volta loggati, 
        verranno identificati come tali da tutte le pagine (.php) del sito.</p>
    
    <p style="margin: 10px 0px;">La prima cosa da fare <b>se vogliamo lavorare con le sessioni</b> è impostare nel file di configurazione del PHP <b>("php.ini") 
            la direttiva session.save_path</b>, indicando <b>la directory nella quale verranno salvate le informazioni sulle sessioni dei nostri utenti</b> 
            (se avete un sito in hosting non dovete fare nulla in quanto questo tipo di configurazione è già stato effettuato dal vostro provider di servizi).</p>

    <hr />

    <h3 id="session_id" class="sottotitolo_paragrafo">Session ID</h3>
    <p style="margin: 10px 0px;"><b>Quando un visitatore si collega per la prima volta ad una pagina di un sito, al Suo Browser viene associato un ID di sessione 
            (identificatore numerico).</b> Questo ID seguirà l'utente per tutto il tempo in cui naviga nel sito. Il PHP è in grado di memorizzare un insieme 
    di valori diversi per ogni Sessione. Questi valori sono associati a delle Chiavi. In qualsiasi momento lo sviluppatore potrà creare, leggere, modificare e cancellare 
    qualsiasi coppia CHIAVE-VALORE legata all'istanza di quella sessione.</p>
    
    <h4 class="esempio">Recuperare la Session ID Utente</h4>
    <p>Per recuperare <b>il valore contenuto nella Session ID</b> bisogna utilizzare il comando <b>session_id()</b>.</p>
<pre class="black">
&lt;?php
echo "Session ID: ".session_id();
?&gt;
</pre>
    
    <hr />
    
    <h3 id="session_start" class="sottotitolo_paragrafo">session_start()</h3>
    <p><b>Per ogni script, che deve accedere alle sessioni, si deve obbligatoriamente inserire nella prima riga</b>, solo una volta, il comando <b>session_start();</b> 
    di inizializzazione.</p> 
<pre class="black">
&lt;?php
session_start();
...
?&gt;
</pre>

    <hr />
    
    <h3 id="session" class="sottotitolo_paragrafo">$_SESSION</h3>
    <p>Tramite il comando <b>$_SESSION['chiave']</b> è possibile <b>memorizzare un valore</b> che sarà legato alla sessione dell'utente. Questo valore, differentemtente 
        dalla chiave, sarà diverso per ogni sessione utente.</p>
<pre class="black">
&lt;?php
$_SESSION['iduser'] = $riga['iduser'];
?&gt;
</pre>
    
    <h4 class="esempio">Ciclare l'Array $_SESSION</h4>
    <p>&Egrave; bene precisare che <b>la variabile superglobale $_SESSION</b> non è altro che un semplice Array Associativo e, come tale, può essere gestito. 
        Se, ad esempio, vogliamo vedere tutti i valori salvati nella session potremmo utilizzare uno dei metodi seguenti:</p>
    
    <h5>foreach()</h5>
<pre class="black">
foreach ($_SESSION as $chiave => $valore){
    echo "\$_SESSION['$chiave'] => ($valore)",$nl;
}
</pre>
    
    <h5>print_r()</h5>
<pre class="black">
print_r($_SESSION);
</pre>
    
    <h5>var_dump()</h5>
<pre class="black">
var_dump($_SESSION);
</pre>
    
    <hr />
    
    <h3 id="session_unset" class="sottotitolo_paragrafo">session_unset()</h3>
    <p>Per svutare tutte le chiavi dell'Array di sessione dell'utente, utilizzare il comando <strong>session_unset()</strong> che annulla tutti i valori delle variabili di sessione.</p>

    <hr />
    
    <h3 id="unset" class="sottotitolo_paragrafo">unset($_SESSION['chiave'])</h3>
    <p>Per eliminare una specifica variabile di sessione useremo:</p>
<pre class="black">
unset($_SESSION['username']);
</pre>
    
    <hr />
    
    <h3 id="session_destroy" class="sottotitolo_paragrafo">session_destroy()</h3>
    <p>Il comando <strong>session_destroy()</strong> distrugge la sessione utente corrente.</p>
    
    <hr />
    
    <h3 id="session_array" class="sottotitolo_paragrafo">$_SESSION = array()</h3>
    <p>Per eliminare tutte le variabili di sessione useremo:</p>
<pre class="black">
$_SESSION = array();
</pre>
    
    <hr />
    
    <h2 id="applicazione-pratica">Applicazione di esempio</h2>
    <p>Nei passi seguenti sono descritte le modifiche apportate all'Applicazione Login Utente.</p>
    
    <h3 class="sottotitolo_paragrafo">elogin.php</h3>
    <ol>
        <li>Il comando <strong>session_start()</strong> deve essere inserito prima di qualsiasi istruzione di output al Browser.</li>
        <li>Se email presente nel Database e password inserita nel form corrisponde alla password presente nel database per quell'email, la variabile con identificatore 
            <b>autenticazione</b> assume <b>TRUE</b>.</li>
        <li>Nel controllo condizionale se <b>autenticazione è TRUE</b> viene assegnato alla sessione la cui chiave <b>iduser</b> l'ID UTENTE (iduser) prelevato dal Database.</li>
        <li>Subito dopo viene effettuato il Redirect alla pagina <b>main.php</b>.</li>
        <li>Nel caso <b>autenticazione</b> sia <b>FALSE</b>, viene effettuato il redirect alla pagina login.php</p></li>
    </ol>
    
<pre class="black">
<?php
$codice = <<< 'CODICE'
<?php
session_start();

[...]
// Se email è presente nel Database
if ($riga = mysqli_fetch_assoc($risultato) ){
    // TRUE se psw del Form e del Database sono identiche
    $autenticato = ($psw === $riga['psw']);
}
else
    $autenticato = false;

// Redirect
if($autenticato){
    $_SESSION['iduser']=$riga['iduser'];
    header("Location: main.php");
    
    // Bloccare il parsing del resto del codice
    exit; // oppure die
}else    {
    header("Location: login.php"); // Redirect al Login.php se Autenticato FALSE
    
    // Bloccare il parsing del resto del codice
    exit;
}
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">main.php</h3>
    <ol>
        <li>Nella prima riga, viene subito chiamta l'istruzione <b>session_start()</b> per la gestione delle sessioni nello script;</li>
        <li>Tramite il controllo condizionale <b>if( !isset($_SESSION['iduser']) )</b> verifichiamo se la chiave <b>iduser</b> è presente 
            nell'Array Superglobale di sessione $_SESSION;</li>
        <li>Nel caso non sia presente la chiave <b>iduser</b> nell'Array $_SESSION viene effettuato il Redirect verso la pagina <b>login.php</b>, inserire un comando 
            che blocchi l'inteprete a proseguire il parsing dello script (die o exit) subito dopo l'<b>header</b>, in quanto questa funzione non blocca l'esecuzione dello script.</li>
        <li>Nel caso sia presente la chiave <b>iduser</b> nell'Array $_SESSION, viene eseguito lo script senza redirect ed in seguito distruggiamo le chiavi che 
            abbiamo creato nell'Array $_SESSION precedentemene nella pagina <b>elogin.php</b> da cui l'utente proviene.</li>
    </ol>
    
<pre class="black">
<?php
$codice = <<< 'CODICE'
<?php
session_start();

[...]

if ( !isset($_SESSION['iduser']) )
    header("Location: login.php");
?>
        
[...]
        
<div class="codice">
Benvenuto!
<?php
    // Annulla tutti i valori delle Variabili Session
    // azzernado tutte le chiavi dell'Array collegato alla sessione utente
    session_unset();

    // Distrugge la Sessione
    session_destroy();
?>
</div>

[...]
CODICE;

echo htmlspecialchars($codice);
?>
</body>
</html>