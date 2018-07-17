<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 58 - Il file configDB.ini e arginare la SQL Injection con mysqli_escape_string - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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

    <h1>[58] Il file configDB.ini e arginare la SQL Injection con mysqli_escape_string</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 7</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione, 
        <a href="lezione-58/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione</h2>
    <ol>
        <li><p><a href="#file-ini" title="il file.ini"><b>Il file configDB.ini - Nascondere le Credenziali di Accesso</b></a>, Più sicurezza con le credenziali di accesso in una cartella non pubblica;</p></li>
        <li>Cosa è la <strong>SQL Injection</strong>;</li>
        <li>Prima linea di difesa contro la SQL Injection: sanificare le stringhe con <strong>mysqli_escape_string</strong>.</li>
        <li><strong>Prepared Statements</strong>, i <strong>PDO</strong> e la classe <strong>safemysql di colshrapnel</strong>, 
            questi argomenti saranno materia di studio dell prossime lezioni sulla sicurezza.</li>
    </ol>

    <hr />

    <h2 id="file-ini">file .ini</h2>
    <p><b>&Egrave; assolutamente sconsigliato, in quanto a rischio sicurezza, inserire le credenziali di accesso nel codice PHP salvato nelle cartella pubblica sotto htdocs.</b></p>
    
    <p style="margin: 10px 0px;">Infatti, in caso di errore e/o blocco del Server Apache o di PHP, potrebbe accadere che il nostro script, contenente le credenziali di accesso, verrebbe 
        visualizzato sul client dell'utente (Browser) come semplice file di testo. In questo scenario, un malintenzionanto non avrebbe problemi nel recuperare 
        le nostre credenziali di accesso.</p>
    
    <p style="margin: 10px 0px;">Ne deriva che l'<b>uso di <u>credenziali cablate Hard Coded</u></b>, in un file salvato in una cartella pubblica, 
        <b>espone l'Applicazione ad attacchi esterni</b>.</p>
    
    <p style="margin: 10px 0px;">Per cautelarsi da questo pericolo <b>è consigliabile inserire le Credenziali di Accesso in un file.ini salvato in una cartella privata.</b></p>
    
    <p class="codice">Nota: Consiglio anche, per una maggiore sicurezza, di filtrare l'accesso al Server MySQL tramite IP. In questo modo solo i client con gli IP indicati, 
        avrebbero accesso al Server MySQL.</p>
    
    <h3 class="sottotitolo_paragrafo">Formattazione del testo</h3>
    <ol>
        <li><p>Per commentare le righe usare il punto e virgola ( ; )</p></li>
        <li><p>L'intestazione deve essere racchiusa tra parentesi quadre, nell'esempio che segue ci sono due intestazioni [mysql] e [database]</p></li>
        <li><p>Le variabili sono composte da coppie chiave = valore.</p></li>
        <li><p>Se il valore delle variabili definite nel file .ini è rappresentato da una stringa (costante lettarale) è preferibile comprenderla tra virgolette o 
                apici perché si potrebbe assistere a dei comportamenti strani, ad esempio la concatenazione di un valore con la chiave successiva.</p>
        </li>
    </ol>
    
    <h4 class="esempio">configDB.ini</h4>
    <p>Il codice seguente, rappresenta un esempio di formattazione di file .ini</p>
<pre class="black">
; Questo è un commento

[mysql]
host = localhost
username = web_visitor
password = 007

; Questo è un commento

[database]
database = quizmaker

; Questo è un commento
</pre>
    
    <h3 class="sottotitolo_paragrafo">parse_ini_file</h3>
    <p><b>Il file .ini viene richiamato con la funzione apposita di PHP <strong>parse_ini_file</strong></b>. Questa funzione effettua il parsing automatico dell' .ini file. 
        Come argomento la funzione accetta il nome del file .ini con il percorso (questo percorso è relativo al file che invoca la funzione).</p>
    
    <p style="margin: 10px 0px;"><b><u>La funzione restituisce un Array Associativo</u></b>, le cui coppie chiave-valore corrispondono agli identificatori e rispettivi valori 
        delle variabili usate nel file .ini stesso.</p>
    
    <p style="margin: 10px 0px;"><b>Il file</b>, come anticipato, per motivi di sicurezza <b>deve essere inserito in una cartella privata</b> (non pubblica). 
        <b>Il percorso da passare</b>, come argomento alla funzione di parsing, <b>deve essere relativo</b> alla posizione del file che lo richiama.</p>
    
    <h4 class="esempio">Formattazione del percorso</h4>
    <p>Quando si specifica il percorso in parse_file_ini è meglio usare il Forward slash (/)in quanto il Backslash (\) attiva delle sequenze di escape se 
                il file in questione inizia con alcuni caratteri particolari.</p>
    <p style="margin: 10px 0px;">Quindi parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../../my_ini/errors.ini") è preferibile a parse_ini_file($_SERVER["DOCUMENT_ROOT"]."\..\..\my_ini\errors.ini") 
        altrimenti bisognerebbe intervenire nei singoli casi aggiungendo uno backslash in modo che il secondo backslash venga interpretato come carattere, 
                questa si rivela una soluzione non code-friendly.</p>
            
    <h4 class="esempio">Array Associativo</h4>
    <p>Gli elementi che compongono l'Array Associativo sono composti dalle corrispondenti coppie <b>KEYWORDS</b> (identificatori) - <b>VALORI</b> del file <b>configDB.ini</b></p>
<pre class="black">
// Risale di tre livelli
$arrAccessData = parse_ini_file('..\..\..\configDB.ini');

// Sottocartella
$arrAccessData = parse_ini_file('private\configDB.ini');
</pre>

    <h3 class="sottotitolo_paragrafo">Connessione a MySQL e selezione del Database</h3>
    <p>Esempio dello script PHP che utilizza l'Array Associativo popolato tramite la funzione parse_ini_file che effettua il parsing del file configDB.ini</p>
    
    <h4 class="esempio">Il File.PHP</h4>
    <p>Recupero le credenziali di accesso al Server MySQL e il nome del Database dal file.ini ESTERNO alla cartella pubblica del sito. <b>Passare alla funzione 
            parse_ini_file il percorso relativo del file .INI rispetto al file PHP che lo richiama.</b> I siti web, con le rispettive sottocartelle e file 
        (PHP, css, HTML, Javascript, etc.), sono salvati nella directory <b>htdocs</b> (wwwroot) che <b>rappresenta la root (la radice di tutti i siti web di Apache)</b>.</p>
<pre class="black">
// Crea un Array Associativo dato dal Parsing del file configDB.ini
$arrAccessData = parse_ini_file('private\configDB.ini');

#1 Connessione al Server di MySQL
// con @ si sopprimono eventuali warning/errori che la funzione
// mysqli_connect restituisce in caso di fallimento
$conn = @mysqli_connect($accessData['host'],$accessData['username'],$accessData['password']);

// Gestione di eventuali errori di connessione
if(!$conn){
  //echo mysqli_connect_errno() . $nl;
  //echo mysqli_connect_error() . $nl;
  //echo mysqli_sqlstate( $conn ) . $nl;
  echo "Connessione al server fallita. Impossibile procedere. Contattare ...";
  die; // oppure exit
}

#2 Seleziona il db con cui lavorare
// Se la connessione è avvenuta con successo
if ( @mysqli_select_db($conn, $accessData['database']) ){

    [...]

}else{
    //fallita mysqli_select_db ...
    echo mysqli_sqlstate( $conn ) . $nl;
    echo mysqli_errno( $conn ) . $nl;
    echo mysqli_error( $conn ) . $nl;
}
</pre>
    
    <hr />
    
    <h2 id="sql-injection">SQL Injection</h2>
    <p>Attacchi di SQL Injection consistono nell'introdurre nei form combinazioni di caratteri potenzialmente dannosi. L'SQL Injection, si basa nell'utilizzo di stringhe 
    SQL che portano al blocco, quindi alla lettura e modifica dei dati presenti nel database. Lo scopo è quello di introdurre comandi non previsti dall'Applicazione ma 
    una forzatura.</p>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">Esempio di SQL Injection</h3>
    <p>Lo screen-shot sottoriportato descrive uno scenario comune di attacco con SQL Injection, tramite il quale un malintezionato inserisce una stringa nel form, 
        che farà risultare sempre TRUE il controllo sull'email. Come si vede la stringa è rappresentata da un porizione di sintassi SQL.</p>
    
    <h4 class="esempio">Screen-shot</h4>
    <p><img src="lezione-58/sql-injection-01.png" alt="SQL Injection" /></p>
    
    <h4 class="esempio">Codice SQL della Nostra Applicazione</h4>
<pre class="black">
$comandoSQL = "select psw from users where email ='". mysqli_escape_string($conn, $email) ."'";

//2 inviare il comando
$risultato = @mysqli_query($conn, $comandoSQL);

echo "Comando: ".$comandoSQL.$nl;

if ($risultato) //la mail e' stata trovata
{
    //3 elaborare il risultato
    if ($riga = mysqli_fetch_assoc($risultato) ) //confrontiamo psw
    {
        echo "Trovata".$nl;

[...]
</pre>

    <h4 class="esempio">Spiegazione</h4>
    <p>La nostra Sintassi SQL prevede una query 'email' come condizione WHERE in entrata, la verifica e restituisce TRUE se l'email è presente nel Database.</p>
    
    <p>Con la stringa riportata nello screen-shot di esempio, il malintenzionato, forza la ricerca dell'email <b>z@a.com</b> ma aggiunge un operatore logico <b>or</b> seguito da 
        un'espressione <b>1=1</b> rstituisce <b>TRUE</b>. In questa situazione <b>la nostra stringa SQL restituisce TRUE</b>, in quanto il controllo con <b>il WHERE è una condizione 
        composta da due espressioni legate con OR: in questo caso la seconda espressione è vera!</b></p>
        
    <p style="margin: 10px 0px;"><a href="lezione-58/login.php" title="form login" target="_blank">Se testiamo il FORM</a> con questa stringa nell'email, vedremo nel browser stampato:</p>
<pre class="black">
Comando: select psw from users where email ='z@a.com' or'1=1'
Trovata
OK, superato check ...
</pre>
    
    <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Nota: Per testare il codice, ricordati di <b>cambiare nell'input di email il valore dell'attributo 
            type da input="email" a input="text"</b>, in questo modo saltiamo il preliminare sul formato della stringa inserita nell'input del form. 
            Altra cosa, <b>non tutti i browser supportano 'email' pertanto nel caso di mancato supporto l'attributo assumerà valore input="text".</b></p>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">mysqli_escape_string</h3>
    <p>Tramite la funzione <styrong>mysqli_escape_string</strong> sanificare la Stringa SQL che accetta le query ricevute dai form. <b>Questa funzione effettua l'escape 
        dei limitatori di stringa.</b> <b>Gli APICI centrali di cui si è effettuato l'escape saranno considerati parte integrante della stringa</b>, non verranno più 
            interpretati come delimitatori.</p>
    
    <h4 class="esempio">Codice Esempio</h4>
<pre class="black">
// Sanificazione della Stringa
$comandoSQL = "SELECT psw FROM users WHERE email ='".mysqli_escape_string($conn, $email)."'";
</pre>
    
    <h4 class="esempio">Spiegazione</h4>
    <p>La sanificazione produce questo risultato:</p>
<pre class="black">
Comando: SELECT psw FROM users WHERE email ='z@a.com\' or\'1=1'
Autenticazione fallita ...
</pre>
    <p>Dal risultato notiamo che viene ricercata l'email <b>z@a.com\' or\'1=1</b>, in quanto gli apici con l'escape sono visti come parte integrante 
        della query ricevuta dal form. <b>Adesso l'espressione rstituisce FALSE</b> perché l'email non è presente nel database.</p>
    
    <hr />
    
    <h2>Altri sistemi di sicurezza</h2>
    <p>Nelle prossime lezioni scopriremo dei sistemi che garantiscono un livello superiore sulla sicurezza:</p>
    
    <h3 class="sottotitolo_paragrafo">Prepared Statements</h3>
    <hr />
    <h3 class="sottotitolo_paragrafo"><strong>PDO</strong></h3>
    <p>I PHP Data Objects, che adottano un approccio ad oggetti (OOP),  forniscono un sistema di sicurezza maggiore ripsetto ai precedenti Prepared Statements.</p>
    <hr />
    <h3 class="sottotitolo_paragrafo">safemysql</h3>
    <p>Infine, faremo pratica con la classe 
        <a href="https://github.com/colshrapnel/safemysql" title="A real safe and convenient way to handle MySQL queries." target="_blank"><b>safemysql</b></a>, 
        di <a href="https://github.com/colshrapnel" title="safemysql di colshrapnel" target="_blank">colshrapnel</a>, 
        che fornisce un livello di sicurezza superiore rispetto a tutti gli altri metodi.</p>

</body>
</html>