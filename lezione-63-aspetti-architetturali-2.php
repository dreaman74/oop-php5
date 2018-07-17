<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 63 - Metodo Procedurale - Modello di Accesso ai Dati e Logica Business - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
        
        .sottolineato {text-decoration: underline;}
        
        .evidenziatore_giallo {background-color: yellow;}
</style>
</head>

<body>
    <?php
    $nl = "<br />";
    ?>
    
    <p id="breadcrumb">
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 63</strong>
    </p>

    <h1>[63] Aspetti Architetturali 2 di 4</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Modello di Accesso ai Dati e Logica Business</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione,
        <a href="lezione-63/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione:</h2>
    <ul>
        <li>separiamo la logica business (che varia da applicativo ad applicativo) da quella di accesso ai dati per riutilizzare facilmente quest'ultima;</li>
        <li>rendiamo i nostri applicativi indipendenti da variazioni all'interfaccia programmatica di accesso al db</li>
    </ul>
    <p class="codice">Approfondimenti sulla libreria di <a href="http://php.net/manual/it/book.mysqli.php" title="la librearia di MySQLi" target="_blank">MySQLi</a> su PHP.net</p>

    <hr />

    <h2>Query Errori</h2>
    <p>Sappiamo che la nostra app riporta l'utente alla pagina <b>login.php</b> in uno dei seguenti casi:</p>
    <ul>
        <li>Errori di autenticazione, email o password errata;</li>
        <li>Nuovo Utente, inserimento di un'email esistente in fase di registrazione;</li>
        <li>Accesso diretto alle pagine elogin.php o main.php, senza passare dalla pagina login.php</li>
    </ul>
    <p>Nel caso si verifichi uno dei casi sopra riportati, verrà passata una query (GET) con chiave <b>errore</b> contenente un valore numerico. In seguito la pagina 
        login.php tramite un blocco condizionale switch, legge il valore e restituisce a video un messaggio di errore.</p>
    
    <p style="margin: 10px 0px;">Possiamo semplificare la gestione degli errori, creando un file .INI, composto da coppie di chiavi-valori, che contiene i messaggi 
        da restituire nel caso uno degli scenari sopra citati si verifichi. Il file che andiamo a creare lo nominiamo <b>messaggi_errore.ini</b> e salviamo 
        nella cartella <b>my_ini</b></p>
    
    <h2>messaggi_errore.ini</h2>
    <p>Aggiungiamo alcune chiavi e valori al file <b>messaggi_errore.ini</b> presente nella cartella <b>my_ini</b>:</p>
<pre>
; Messaggi di Errore
[errori]
connessione_fallita = "Connessione al Server MySQL fallita: Impossibile procedere. Contattare il reparto IT."
db_non_trovato = "Il Database richiesto non è stato trovato..."
autenticazione_fallita = "nome utente o password errati"
email_gia_inserita = "user con questa email già regitrato"
inserimento_fallito = "Inserimento del Nuovo Utente è fallito"
autenticazione_richiesta = "Per accedere a questa pagina è necessario autenticarsi!"
</pre>
    
    <h3 class="sottotitolo_paragrafo">Sostituiamo i valori numerici con le chiavi del file.INI</h3>
    <p>Nel codice di elogin.php e main.php, per tutte le query <b>errore</b> sostituiamo i valori numerici con le chiavi relative presenti nel file.INI 
        in base all'errore che si presenta.</p>
    
    <h4>errore 1 con autenticazione_fallita</h4>
    <p>Pagina <b>elogin.php</b>, Errore che si presenta nel momento in cui l'email inserita nel form di Login non è presente nel database.</p>
<pre>
//redirect
if($autenticato){
    $_SESSION['iduser']=$riga['iduser'];         
    header("Location: main.php");
}else
    // header("Location: login.php?errore=1");
    header("Location: login.php?errore=autenticazione_fallita");

// Blocca il parsing del codice dopo uno dei 2 redirect
exit;
</pre>
    
    <h4>errore 2 con email_gia_inserita</h4>
    <p>Pagina <b>elogin.php</b>, Errore che si presenta quando un utente vuole registrarsi ma l'email inserita è presente nel database.</p>
<pre>
//BOTTONE NUOVO UTENTE
if ( mysqli_fetch_assoc( $risultatoRicercaEmail ){
    mysqli_close($conn);

    // header("Location: login.php?errore=2");
    header("Location: login.php?errore=email_gia_inserita");

    exit;
}
</pre>
    
    <h4>errore 3 con inserimento_fallito</h4>
    <p>Pagina <b>elogin.php</b>,</p>
<pre>
$comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
$esito = mysqli_query($conn, $comandoSQL);

if ($esito){
    $_SESSION['iduser'] = mysqli_insert_id( $db );
    mysqli_close($conn);
    header("Location: main.php");
}else{
    mysqli_close($conn);
    // header("Location: login.php?errore=3"); //inserimento fallito
    header("Location: login.php?errore=inserimento_fallito");
}

exit;
</pre>
    
    <h4>errore 4 con autenticazione_richiesta</h4>
    <p>Nel caso in cui si <b>accede direttamente</b> nella pagina <b>elogin.php</b> senza passare da login.php</p>
<pre>
// Prima di tutto un po' di controllo sui dati in ingresso
if($_SERVER['REQUEST_METHOD'] == 'POST' && $host_origine == $host && $pagina == 'login.php'){
    [...]
}else{
    // header("Location: login.php?errore=4"); //non autenticato
    header("Location: login.php?errore=autenticazione_richiesta"); //non autenticato
    exit;
}
</pre>

    <p>Pagina <b>main.php</b>, effettua il redirect nel caso in cui la variabile SESSION non è presente.</p>    
<pre>
// if ( !isset($_SESSION['iduser']) ) header("Location: login.php?errore=4");
if ( !isset($_SESSION['iduser']) ) header("Location: login.php?errore=autenticazione_richiesta");
</pre>
    
    <h4>login.php</h4>
    <p>Apportare le modifiche alla pagina <b>login.php</b> perché possa leggere le chiavi passate come valore nella Query <b>errore</b>.</p>
    
    <h5>Leggere i messaggi di errore</h5>
    <p>Inserendo il file <b>setup.php</b> includiamo anche lo script <b>messaggi_errore.ini</b>. Inseriamo l'include nella prima riga:</p>
<pre>
include($_SERVER['DOCUMENT_ROOT'].'/miei_test/fcamuso/lezione-63/my_include/setup.php');
</pre>
    
    <h5>Leggere la chiave dell'errore</h5>
    <p>Inseriamo come indice dell'Array <b>$messaggi_errore</b> il valore passato nella <b>query</b> GET <b>errore</b>.</p>
<pre>
echo $messaggi_errore[$_GET['errore']];
</pre>
    
    <hr />
    
    <h2>setup_con_db.php - Modello di Accesso ai Dati</h2>
    <p>Non ci resta che creare <b>una nostra funzione che ingloba tutte le funzioni della libreria MYSQLI</b> per la gestione e l'accesso al Database. 
        In questo modo divideremo la Logica Business dal <b>Modello di Accesso ai Dati</b>, rappresentato quest'ultimo dalla nostra funzione. 
        Così facendo tutte le dipendenze alla libreria MYSQLI sono racchiuse nel nostro Modello e tutte le pagine dipenderanno da esso. <b>Supponiamo che in futuro 
    la libreria MYSQLI non sia più supportata o vorremmo utilizzare un altro ADAPTER per gestire le nostre connessioni, ci basterà modificare le istruzioni 
    contenute nel Modello.</b></p>
    
    <p style="margin: 10px 0px;">La pagina <b>setup_con_db.php</b> contiene il nostro <b>Modello di Accesso ai Dati</b>, ovvero le funzioni dedicate all'interazione, 
        operazioni di connessione e gestione, con il Database.</p>
    
    <h3 class="sottotitolo_paragrafo">Funzione db_connettiti()</h3>
    <p><b>Per convenzione il prefisso (notazione) della funzione indica l'ambito di utilizzo della funzione stessa.</b> In questo caso la funzione è identificata con 
        la <em class="sottolineato evidenziatore_giallo">notazione</em> <b>db_</b> perché le istruzioni in essa contenute sono delegate alla comunicazione e interazione con il Database.</p>
<pre>
// ---------- Modello di Accesso ai Dati ----------
function db_connettiti($messaggi_errore){
    
    global $cartella_ini, $nl;
    
    // Recupero credenziali da file .INI
    $accessData=parse_ini_file($cartella_ini.'/configDB.ini');
    
    //1 stabilire una (o più) connessione/i con un server
    //NB: con @ si sopprimono i warning/errori del comando
    $conn = @mysqli_connect($accessData['host'],$accessData['username'],$accessData['password']);
    
    if(!$conn){
        // Errore di Connessione al Server MySQL
        die($messaggi_errore['connessione_fallita']);
    }
    
    // Seleziona il Database
    if(!@mysqli_select_db($conn, $accessData['dbname'])){
        echo $messaggi_errore['db_non_trovato'].$nl;
        echo mysqli_sqlstate($conn).$nl;
        echo mysqli_connect_errno($conn).$nl;
        echo mysqli_connect_error($conn).$nl;
        die;
    }
    
    return $conn;
}
</pre>
    
    <h4 class="celeste">Come Funziona</h4>
    
    <h5 class="sottotitolo_paragrafo">Information Hiding</h5>
    <p>Tutte le variabili e Array esterni non sono visibili all'interno delle funzioni per il principio dell'Informnation Hiding: Le funzioni devono essere 
        indipendenti e non interferire con le istruzioni esterne ad esse.</p>
    
    <h6 class="esempio">configDB.ini</h6>
    <p style="margin: 10px 0px;">Tenendo presente questo, spostiamo <b>$accessData</b> - l'array in cui memorizziamo il risultato del parsing 
        del file configDB.ini che contiene le credenziali di accesso al Server MySQL e il nome del Database - all'interno della funzione. 
        Facciamo questo perché le credenziali di configDB.ini sono strettamente relazionate a questa funzione perché il suo utilizzo è fortemenete demandato 
        alla creazione della connessione con con il Database.</p>
    
    <h6 class="esempio">$cartella_ini e $nl</h6>
    <p>Per le variabili esterne <b>$cartella_ini</b>, che indica il percorso della cartella <b>my_ini</b>, e <b>$nl</b> invece aggiungiamo il riferimento 
        tramite la keyword <b>global</b>, in questo modo ampliamo l'ambito di visibilità (lo scope) all'interno della funzione stessa.</p>

    <h6 class="esempio">$messaggi_errore</h6>
    <p>L'array <b>$messaggi_errore</b>, in cui memorizziamo il risultato del parsing del file <b>messaggi_errore.ini</b>, lo passiamo invece come argomento quando 
        invochiamo la funzione stessa.</p>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">Funzione db_sanifica()</h3>
    <p>Questa funzione restituisce la query sanificata per la stringa SQL nella variabile $comandoSQL.</p>
<pre>
function db_sanifica($conn, $stringa){
    return mysqli_escape_string($conn, $stringa);
}
</pre>    

    <hr />
    
    <h3 class="sottotitolo_paragrafo">Funzione db_select()</h3>
    <p>La funzione ritorna le tuple restituite dal Result Set della Query SQL.</p>
<pre style="overflow-x: auto;">
function db_select($conn, $querySQL){
    
    global $nl;
    
    // Restituisce FALSE in caso di errore oppure un Result Set composto da 0, 1, 2, etc. records
    $risultato_query = mysqli_query($conn, $querySQL);
    
    if($risultato_query === false){
        echo "Problemi con il Server MySQL...".$nl;
        echo mysqli_sqlstate($conn).$nl;
        echo mysqli_connect_errno($conn).$nl;
        echo mysqli_connect_error($conn).$nl;
        die;
    }
    
    $righe_estratte = array();
    // Tramite l'iterazione salviamo in ogni elemento dell'Array una riga del Result Set
    while ($riga = mysqli_fetch_assoc($risultato_query)){
        $righe_estratte[] = $riga;
    }
    
    return $righe_estratte;
}
</pre>
    
    <h4 class="celeste">Come Funziona</h4>
    <p>La funzione <b>mysqli_query</b> restituisce false se l'interrogazione fallisce: il Server non soddisfa la query SQL, per esempio un errore di sintassi SQL. 
        In questo caso la funzione blocca stampa a video un avviso e l'errore MySQL e blocca l'esecuzione dello script.</p>
    
    <p style="margin: 10px 0px;">Diversamente, la funzione restituisce un Result Set composto da 0 o più righe che corrispondo ai Records che soddisfano la richiesta 
        SQL. Tramite il ciclo while, leggiamo ogni tupla (record) del Recordset e la salviamo in un elemento dell'array <b>$righe_estratte</b>. 
        Ogni elemento di quest'Array sarà composto da coppie chiave-valore che corrispondono ai rispettivi campi-valori del database indicati nella Query SQL. 
    In questa Applicazione la query restituisce una sola riga, ovvero il record che corrisponde all'email inserita, se trovata, nel form di login.php</p>

    <hr />
    
    <h3 class="sottotitolo_paragrafo">Funzione db_insert()</h3>
    <p>La funzione inserisce un nuovo record, nel caso di Nuovo Utente. In caso l'operazione è andata a buon fine restituisce l' ID appena inserito, 
        questo viene recuperato dall'istanza della connessione relativa. Ogni utente ha una propria istanza della connessione. Nel caso l'operazione di inserimento 
        dovesse fallire <b>mysqli_query</b> restituisce <b>false</b> ed anche la funzione <b>db_insert()</b> restituisce false.</p>
<pre style="overflow-x: auto;">
function db_insert($conn, $querySQL){
    $esito = mysqli_query($conn, $querySQL);
    
    if($esito)
        return mysqli_insert_id($conn);
    else
        return false;

}
</pre>

    <hr />
    
    <h3 class="sottotitolo_paragrafo">Funzione db_close()</h3>
    <p>Chiude la connessione all'istanza della connessione.</p>
<pre style="overflow-x: auto;">
function db_close($conn){
    mysqli_close($conn);
    //mysql_free_result($conn);
    //unset($conn);
}
</pre>
    
    <hr />
    
    <h2>login.php - La Logica Business</h2>

    <h3 class="sottotitolo_paragrafo">Verifica della Richiesta HTTP</h3>
    <p>Prima di tutto verifichiamo da dove proviene la richiesta HTTP: Se rileviamo che la richiesta non è di tipo POST e proviene da una pagina 
        diversa da login.php non presente sullo stesso HOST effettuiamo il redirect alla login.php passando il tipo di errore rilevato. Invece, 
        <b>se</b> le espressioni sono tutte <b>true</b> <u>proseguiamo con l'esecuzione dello script</u> <b>elogin.php</b>.</p>
<pre>
// Prima di tutto un po' di controllo sui dati in ingresso
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $host_origine == $host && $pagina == 'login.php'){

    ...

}else{
  header("Location: login.php?errore=autenticazione_richiesta"); //non autenticato
  exit;
}
</pre>
    
    <p>Adesso, inseriamo nella pagina <b>elogin.php</b> le istruzioni che richiamano le funzioni create nel Modello di Accesso ai Dati presenti nel file 
        <b>setup_con_db.php</b>.</p>
    
    <h3 class="sottotitolo_paragrafo">$conn = db_connettiti($messaggi_errore);</h3>
<pre>
// Stabilire una (o più) connessioni/i con il Server MySQL
$conn = db_connettiti($messaggi_errore);
</pre>
    <p>La funzione <b>db_connettiti</b> nel caso riscontri un'eccezione stampa a video l'errore e blocca l'esecuzione dello script, 
        diversamente restituisce l'istanza della connessione che viene memorizzata nella variabile <b>$conn</b>.</p>

    <h3 class="sottotitolo_paragrafo">db_sanifica($conn, $email)</h3>
<pre>
// Query SQL
$comandoSQL =
  "select iduser, psw from users where email ='".db_sanifica($conn, $email)."'";
</pre>
    <p>La funzione restituisce la query sanificata da passare al comando SQL.</p> 
    
    <h3 class="sottotitolo_paragrafo">$righe_estratte = db_select($conn, $comandoSQL);</h3>
<pre style="overflow-x: auto;">
// 2 inviare il comando alla Funzione che
// restituisce Array delle Tuple Estratte o blocca l'esecuzione dello script stampando l'errore
$righe_estratte = db_select($conn, $comandoSQL);
</pre>
    <p>Con la funzione <b>db_select</b> interroghiamo il Database e nel caso di FALSE, errore dal Server MySQL, blocchiamo l'esecuzione dello script e stampiampo 
    il messaggio di errore. In caso la Query SQL va a buon fine restituisce un ARRAY con indice numerico pari al numero di records trovat, ogni elemento dell'array 
    contiene delle coppie chiave-valore corrispondenti ai campi-valore del database indicati nella Query SQL.</p>
    
    <p style="margin: 10px 0px;">Se la query SQL viene eseguita con successo, <b>la funzione db_select restituisce sempre un array con un elemento perché 
            l'email che cerchiamo può essere presente nella tabella users solo una volta</b> - ricordiamo l'indice UNIQUE assegnato al campo email 
            in fase di creazione del Database quizmaker.</p>
    
    <p>Adesso non ci resta che verificare quale pulsante è stato premuto, tramite il costrutto condizionale IF:</p>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">ACCEDI</h3>
<pre style="overflow-x: auto;">
//quale bottone è stato premuto, 'accedi' o 'nuovo utente'?
if (isset($_POST['btnAccedi'])){

    //3 elaborare il risultato
   if (count($righe_estratte)>0) //mail trovata, confrontiamo psw
   {
      //echo "Trovata".$nl;
      $riga = $righe_estratte[0];
      $autenticato = ($psw === $riga['psw']);
   }
   else
     $autenticato = false;

   //4 chiudere la/le connessione/i
   db_close($conn);

   //redirect
   if($autenticato){
    $_SESSION['iduser']=$riga['iduser'];
    header("Location: main.php");
   }
   else
    header("Location: login.php?errore=autenticazione_fallita");

   // Blocca il parsing del codice dopo uno dei 2 redirect
   exit;
}else{
    //BOTTONE NUOVO UTENTE
    ...
}
</pre>
    <h4>Come Funziona</h4>
    <p>Se l'Array <b>$righe_estratte</b> non contiene alcun array, significa che <b>non è stata trovata alcuna email</b> uguale a quella inserita nel form 
        di autenticazione  Pertanto la variabile <b>$autenticato</b> assume valore <b>false</b>. Viene effettuato il redirect alla pagina login.php passando 
    la query GET errore con valore 'autenticazione_fallita'.</p>
    
    <p style="margin: 10px 0px;">Invece nel caso di successo l'array avrà solo un elemento, quindi COUNT resituisce 1. Adesso viene confrontata 
        la password del database corrispondente all'email trovata con quella inserita nel form. <b>Nel caso le due stringhe corrispondono</b>, 
        la variabile <b>$autenticato</b> conterrà <b>la password</b>, <b>in caso negativo</b> viene restituito <b>false</b> dall'espressione di confronto strict 
        tra i due operandi.</p>
    
    <P style="margin: 10px 0px;">Dopo la verifica della password, chiudiamo la connessione al Database e al Server MySQL con la funzione <b>db_close($conn)</b>.</p>
    
    <p style="margin: 10px 0px;">Adesso, con un altro confronto condizionale leggiamo il valore presente nella variabile <b>$autenticato</b>:</p>
    <ul>
        <li>Se <b>False</b> effettuiamo il <b>redirect</b> alla pagina <b>login.php</b> passando '<b>autenticazione_fallita</b>' alla query <b>errore</b>;</li>
        <li>Se contiene la <b>password</b>, viene creata alla variabile di sessione con chiave 'iduser' il valore ID dell'utente corrispondente recuperato 
            dal campo 'iduser'. Ed inseguito viene effettuato il redirect a main.php.</li>
    </ul>
    <p><b>In entrambi i casi blocchiamo l'esecuzione dello script</b> dopo il redirect con l'istruzione <b>exit</b>.</p>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">NUOVO UTENTE</h3>
<pre style="overflow-x: auto;">
if (isset($_POST['btnAccedi'])){

    ...

}else{
  //BOTTONE NUOVO UTENTE
  if (count($righe_estratte)>0)
  {
    db_close($conn);
    header("Location: login.php?errore=email_gia_inserita"); //email gia' presente
    exit;
  }

  //insert into users values (null, 'e@j.com','eee')
  $comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
  $esito = db_insert($conn, $comandoSQL);

  if ($esito){
    $_SESSION['iduser'] = $esito;
    db_close($conn);
    header("Location: main.php");
  }else{
    db_close($conn);
    header("Location: login.php?errore=inserimento_fallito"); //inserimento fallito
  }

  exit;
}
</pre>
    <h4>Come Funziona</h4>
    <p>Nel caso l'utente abbia premuto il pulsante di registrazione per un Nuovo Utente, viene verificato prima se l'Array $righe_estratte contiene elementi. 
        <b>Nel caso COUNT($righe_estratte) restituisca 1</b> viene effettuato il <b>redirect alla pagina login.php
        </b> passando la chiave di errore '<b>email_gia_inserita</b>' nella query <b>errore</b>.</p>
    
    <p style="margin: 10px 0px;">Invece se il COUNT restituisce 0, non ci sono email uguali a quella inserita nel form pertanto si può procedere 
        con la registrazione del Nuovo Utente:</p>
    
    <p style="margin: 10px 0px;">Alla variabile <b>$esito</b> assegnamo il <b>risultato</b> dell'operazione di <b>inserimento del nuovo record</b> 
        svolta dalla funzione <b>db_insert</b>:</p>
    
    <ul>
        <li>Se <b>$esito</b> contiene l'<b>ID dell'utente appena creato</b> viene assegnato <b>ID dell'utente</b> alla <b>Session['iduser']</b>, 
            chiusa la connessione al Database e al Server MySQL ed effettuato il <b>redirect alla pagina main.php</b>;</li>
        <li>Se <b>$esito</b> è uguale a <b>false</b> viene chiusa la connessione ed effettuato il <b>redirect a login.php</b> con la query Get 
            <b>errore</b> contenente la chiave '<b>inserimento_fallito</b>'.</li>
    </ul>

</html>