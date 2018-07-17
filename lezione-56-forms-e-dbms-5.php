<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 56 - Creare un Utente MySQL con permessi limitati e libreria MySQLi - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 56</strong>
    </p>

    <h1>[56] Creare un Utente MySQL con permessi limitati e librearia MySQLi</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 5</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione, 
        <a href="lezione-56/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione</h2>
    <ol>
        <li><p>Creiamo un Account MySQL con permessi limitati per la gestione del Dabatase quizmaker ;</p></li>
        <li><p>Aggiungere users con MySQL Workbench</p></li>
        <li><p>Uso di <b>MySQLi</b> in formato procedurale (non OOP) per connetterci e interagire con il Server MySQL:</p>
            <ul>
                <li>mysqli_connect</li>
                <li>mysqli_select_db</li>
                <li>mysqli_query</li>
                <li>mysqli_fetch_assoc</li>
                <li>mysqli_free_result</li>
                <li>mysqli_close</li>
            </ul>
        </li>
    </ol>

    <hr />
    
    <h2>Creare un Utente con MySQL Workbench</h2>
    <p>In questi passaggi, illustro come a creare un Utente per la connessione al Database 'quizmaker'. Da non confondere con gli utenti presenti nella tabella 'users' dello stesso 
        database.</p>
    <ol>
        <li>
            <p>Menù <b>Server</b> > <b>Users and Privileges</b>, in MySQL Worlbench</p>
            <p><img src="lezione-56/server-users-and-privileges.png" alt="Menù Server > Users and Privileges" /></p>
        </li>
        <li>
            <p>Cliccare sul bottone <b>Add Account</b> posto nella parte bassa della <b>TAB 'Users and Privileges'</b> che viene aperta, 
                <b>sotto l'elenco degli 'User Accounts'</b> (Account Utenti presenti).</p>
            <p><img src="lezione-56/add-account.png" alt="Add Account" /></p>
        </li>
        <li>
            <p><b>TAB 'Login'</b>, Compilare con le <b>seguenti impostazioni</b>:</p>
            <ul>
                <li>Login Name: <b>web_visitor</b></li>
                <li>Authentication Type: <b>Standard</b> (Elenco a discesa)</li>
                <li>Limit to Host Matching: <b>%</b> (Accetta connessioni da qualunque Host, Compresi Localhost / 127.0.0.1 / ::1</li>
                <li>Password: <b>007</b></li>
                <li>Confirm Password: <b>007</b></li>
            </ul>
            <p><img src="lezione-56/login-settings.png" alt="Login Settings" /></p>
        </li>
        <li>
            <p><b>TAB 'Account Limits'</b>, Compilare con le <b>seguenti impostazioni</b>:</p>
            <ul>
                <li>Max. Queries: <b>0</b> [Numero di Query che un Account può eseguire in un'ora.]</li>
                <li>Max. Updates: <b>0</b> [Numero di Updates che l'Account può eseguire in un'ora.]</li>
                <li>Max. Connections: <b>0</b> [Numero di volte in cui l'Account può connettersi in un'ora.]</li>
                <li>Concurrent Connections: <b>0</b> [Numero di connessioni simultane al Server di questo Account.]</li>
            </ul>
        </li>
        <li>
            <p><b>TAB 'Administrative Roles'</b>, per questo Utente <b>Non Attribuire Ruoli</b>, lasciando le impostazioni di default.</p>
        </li>
        <li>
            <p><b>TAB 'Schema Privileges'</b> (Privilegi sul Database), configurare come segue:</p>
            <ul>
                <li>Cliccare sul bottone <b>Add Entry</b></li>
                <li>Attivare la Radio <b>Selected schema</b>, selezionare il database <b>quizmaker</b> e cliccare su <b>OK</b> per <b>salvare le modifiche</b></li>
                <li><b>Object Rights</b> spuntare i seguenti checkbox:
                    <ul>
                        <li>SELECT</li>
                        <li>INSERT</li>
                        <li>UPDATE</li>
                        <li>DELETE</li>
                    </ul>
                </li>
                <li><b>DDL Rights</b> (Data Definition Language), <b><u>non selezionare alcuna voce</u></b> in quanto esse concedono all'Utente i permessi per modificare 
                la struttura del Database e delle Tabelle contenute.</li>
                <li>
                    <p><b>Other Rights</b>, <b><u>non selezionare alcuna voce</u></b> in quanto esse concedono all'Utente i permessi di creare altri account 
                        con diritti uguali o inferiori (ma non superiori) a quello attivo.</p></li>
                    <p><img src="lezione-56/new-user-schema-privileges.png" alt="privilegi database" /></p>
                </li>
            </ul>
        </li>
        <li>Cliccare sul bottone <b>Apply</b></li>
        <li>Uscire da MySQL Workbench</li>
        <li>Per rendere attivo l'utente e aggiornare le modifiche, <b>riavviare il Server MySQL</b></li>
    </ol>
    
    <hr />
    
    <h2>Aggiungere users con MySQL Workbench</h2>
    <p>Tramite MySQL Workbench aggiungiamo 2 utenti alla tabella 'users';</p>
    <ol>
        <li>
            <p>Con il puntatore del mouse, sotto <b>SCHEMAS > quizmaker > Tables</b> ci posizioniamo sulla tabella <b>'users'</b> e <b>clicchiamo sulla 3 icona</b> 
                (simbolo della tabella con fulmine).</p>
            <p>Oppure, <b>Click destro del mouse su 'users'</b> e selezionare <b>'Select Rows - Limit 1000'</b>.</p>
            <p style="margin: 10px 0px;">Si apre la seguente schermata:</p>
            <p><img src="lezione-56/aprire-pannello-query-users.png" alt="Aprire il Pannello Query" /></p>
        </li>
        <li>
            <p>Nella sezione 'Result Grid' aggiungiamo i nuovi utenti, come indicato nella schermata sotto (non compilare il campo iduser!):</p>
            <p><img src="lezione-56/creare-nuovi-utenti-in-users.png" alt="Creare nuovi utenti in users" /></p>
        </li>
        <li>Clicchiamo su <b>Apply</b>, per 2 volte, per creare gli Utenti.</li>
        <li>
            <p>Utenti aggiunti nella tabella 'user'. Notare che gli 'iduser' sono stati aggiunti automaticamente.</p>
            <p><img src="lezione-56/records-in-users.png" alt="utenti aggiunti in users" /></p>
        </li>
    </ol>
    
    <hr />
    
    <h2>MySQLi</h2>
    <p>Da PHP 5.6.0 si è passati direttamente alla versione 7.0.0 ed è stata definitivamente abbandonata la libreria MySQL, già deprecata. 
        <b>Per le nostre prove useremo la libreria MySQLi</b> che può essere utilizzata sia in modo Procedurale sia OOP.</p>
    
    <h3 class="sottotitolo_paragrafo">mysqli_connect</h3>
    <p>La funzione mysqli_connect della libreria MySQLi di PHP viene utilizzata per stabilire una connessione con il Server di MySQL, e facoltativamente al Database.</p>
    
    <p class="codice">Premessa: Nel codice riportato a seguito, vengono incluse alcune logiche di controllo che verificano il buon esito nei vari passaggi. 
    Diversamente, non sono inserite logiche che effettuano la sanificazione delle query in ingresso da passare alle istruzioni SQL per l'interrogazione del Database 
    quizmaker.</p>
    
    <p class="codice">Esempi di PHP.net sull'<a href="http://php.net/manual/en/function.mysqli-connect.php" title="usare mysqli_connect" target="_blank" />
        Approccio Procedurale e OOP di mysqli_connect</a></p>
    
    <h4 class="sottotitolo_paragrafo">Sintassi</h4>
    <p>La funzione <b>mysqli_connect</b> accetta i seguenti argomenti:</p>
<pre>
mysqli_connect($host, $user, $password, [$database [, $port [, $socket]]])
</pre>

    <h4 class="sottotitolo_paragrafo">Spiegazione del Codice</h4>
    <ol>
        <li><p>Il <b>form</b> della pagina <b>login.php</b>, quando viene premuto il bottone <b>ACCEDI</b> o <b>NUOVO UTENTE</b>, chiamata la pagina <b>elogin.php</b> che 
                processa i dati in ingresso.</p></li>
        <li><p><b>Prima di stabilire la connessione con il Server di MySQL</b>, nella pagina <b>elogin.php</b> viene effettuato un controllo condizionale che 
                <b>verifica la provenienza della richiesta POST</b>: Verifichiamo se la <b>Richiesta HTTP utilizza il metodo POST</b> e proviene dal <b>form di login.php 
                    presente sullo stesso Hosting</b>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = "<br />";

if(isset($_SERVER['HTTP_REFERER'])){
    // Host Reale
    $host = $_SERVER['HTTP_HOST'];

    // Recupera Referrer
    $referer = $_SERVER['HTTP_REFERER'];

    // Recupera Host di Origine
    $host_origine = (parse_url($referer, PHP_URL_HOST).':'.parse_url($referer, PHP_URL_PORT));

    // Recupera Pagina di provenienza
    $uri = parse_url($referer, PHP_URL_PATH);
    $pagina = substr($uri, strrpos($uri, '/')+1);
}

// Prima di tutto un po' di controllo sui dati in ingresso
if($_SERVER['REQUEST_METHOD'] == 'POST' && $pagina == 'login.php' && $host_origine == $host){
[...]
}
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
        </li>
        <li><p>Verifichiamo quale bottone è stato premuto e <b>Stabiliamo la connessione con il Server MySQL</b>. Nel caso il controllo precedente abbia restituito <b>TRUE</b>, possiamo procedere con la creazione della 
                connessione verso il Server MySQL.</p>
            
            <p style="margin: 10px 0px;"><b>Non è obbligatorio passare alla funzione mysqli_connect il nome del datatabase</b>, in questo caso <b>sarà specificato 
                    successivamente con 'mysqli_select_db'</b>.</p>
            
            <p style="margin: 10px 0px;">I due metodi di connessione:</p>
            <ul>
                <li><p>Connessione passando il nome del database:</p>
                    <pre class="black">mysqli_connect("localhost", "web_visitor", "007", "quizmaker")</pre>
                </li>
                <li><p>Forma senza passare l'argomento del database:</p>
                    <pre class="black">mysqli_connect("localhost", "web_visitor", "007"))</pre>
                </li>
            </ul>
            
            <p>Con <strong>mysqli_connect</strong> creiamo la <b>connessione al Server MySQL</b> e la salviamo nella variabile <b>$conn</b>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
// ACCEDI
if(isset($_POST['btnAccedi'])){

    // SQL che interroga il Database che restituisce i records che ci servono
    $comandoSQL = "SELECT * FROM users WHERE email='$email'";

    #1 Stabilire una (o più) connessione/i con il Server di MySQL    
    if(!@$conn = mysqli_connect("localhost", "web_visitor", "007")){
        // Nel caso in cui la connessione non viene stabilita, stampa a video l'errore
        echo '<p class="codice" style="color: yellow;">';
        echo "<b>Error:</b> Unable to connect to MySQL.".PHP_EOL.$nl;
        echo "<b>Debugging errno:</b> ".mysqli_connect_errno().PHP_EOL.$nl;
        echo "<b>Debugging error:</b> ".mysqli_connect_error().PHP_EOL;
        // Blocca immediatamente l'esecuzione dello script
        exit;
    }else{
        echo '<p class="codice">';
        echo '#1 - Connessione con il Database stabilita';
    }
    echo '</p>';
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
        </li>
    </ol>

    <h4 class="sottotitolo_paragrafo">mysqli_connect_errno() e mysqli_connect_error()</h4>
<pre class="black" style="color: yellow;">
Error: Unable to connect to MySQL. 
Debugging errno: 2002 
Debugging error: php_network_getaddresses: getaddrinfo failed: Host sconosciuto.
</pre>
    
    <h4 class="sottotitolo_paragrafo">PHP_EOL</h4>
    <p>PHP_EOL (END OF LINE) è una delle <a href="http://php.net/manual/en/reserved.constants.php" title="Costanti Predefinite di PHP" target="_blank"><b>Costanti Predefinite</b></a> 
        The correct 'End Of Line' symbol for this platform. Available since PHP 5.0.2 
        These constants are defined by the PHP core. This includes PHP, the Zend engine, and SAPI modules.</p>
    
    <p style="margin: 10px 0px;">You use PHP_EOL when you want a new line, and you want to be cross-platform. This could be when you are writing files to the filesystem 
        (logs, exports, other).</p>
    
    <ul>
        <li><p>You could use it if you want your generated HTML to be readable. So you might follow your <b>&lt;br /&gt; with a PHP_EOL</b>;</p></li>
        <li><p>You would use it if you are running php as a script from cron and you needed to output something and have it be formated for a screen;</p></li>
        <li><p>You might use it if you are building up <b>an email to send that needed some formatting</b>.</p></li>
    </ul>
    
    <p>Maggiori info sulla <a href="http://stackoverflow.com/questions/128560/when-do-i-use-the-php-constant-php-eol" title="PHP_EOL su stackoverflow" target="_blank">
            discussione di stackoverflow</a></p>
            
    <h4 class="sottotitolo_paragrafo">exit</h4>
    <p>Blocca immediatamente l'esecuzione dello script.</p>

    <hr />

    <h3 class="sottotitolo_paragrafo">mysqli_select_db</h3>
    <ol start="4">
        <li><p><b>Colleghiamoci a 'quizmaker'.</b> Visto che in fase di creazione della connessione, non abbiamo specificato il database a cui collegarci, 
                utilizziamo la funzione <b>mysqli_select_db</b> per <b>selezionare il database 'quizmaker'</b> con cui dobbiamo interagire. Viene effettuato il solito 
            controllo di verifica.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
    #2 Selezionare il Database
    if(!mysqli_select_db($conn, 'quizmaker')){
        echo '<p class="codice" style="color: yellow;">';
        echo '<b>Error:</b> Il database non è stato selezionato';
        // Blocca immediatamente l'esecuzione dello script
        exit;
    }else{
        echo '<p class="codice">';
        echo '#2 - Database selezionato';
    }
    echo '</p>';
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
        </li>
    </ol>
    
    <h3 class="sottotitolo_paragrafo">mysqli_query</h3>
    <ol start="5">
        <li><p>La funzione <b>mysqli_query</b> interroga il Database e, come valore, <b>restitisce un Resultset</b> in base alla Query SQL che abbiamo inviato. 
                Un Resultset rappresenta un <b>insieme di righe (rows) e colonne</b>. Il numero di righe, o il numero di occorrenze restituite, è detto Recordset. 
                Il termine accademico, che identifica le righe, è <b>Tuple</b>.</p>
            
            <p style="margin: 10px 0px;">La <b>connessione al Server di MySQL</b> e la <b>Query SQL</b> sono i due argomenti obbligatori da passarea 
                a questa funzione.</p>
            
            <p style=margin: 10px 0px;">Attenzione: <b>Nel caso non ci siano occorrenze</b>, nessuna riga, <b>viene restituito NULL</b>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
#3 Interrogare il Database e prelevare i Recordset (Resultset)
// La funzione restituisce un Resultset, un insieme di righe e colonne
if(!$risultato = mysqli_query($conn, $comandoSQL)){
    echo '<p class="codice" style="color: yellow;">';
    echo '<b>Error:</b> Connessione o SQL'.$nl;
    echo '<b>SQL:</b> '.$comandoSQL;
    // Blocca immediatamente l'esecuzione dello script
    exit;
}else{
    echo '<p class="codice">';
    echo '#3 - Tuple restituite '.mysqli_num_rows($risultato);
}
echo '</p>';
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
        </li>
    </ol>
    
    <h3 class="sottotitolo_paragrafo">mysqli_fetch_assoc</h3>
    <ol start="6">
        <li>
            <p>Vene restituito un array associativo $riga, se ci sono righe nel ResultSet, diversamente FALSE. L'Array conterrà tante chiavi quanti sono i campi 
                restituiti dalla riga. Le chiavi viene preso dal nome dei campi restituiti dalla query SQL che interroga la tabella 'users'.</p>
            
            <p style="margin: 10px 0px;"><b>Nel nostro caso, il ResultSet restituisce sempre una riga</b>, in quanto con la query SQL cerchiamo l'email inserita nel form 
                (il campo email del database non può contenere più records con la stessa email, regola impostata quando abbiamo creato la tabella 'users').</p>
            
            <h4>Codice dell'applicazione</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
#4 Elaborare il risultato
if($riga = mysqli_fetch_assoc($risultato))
    $autenticato = ($psw === $riga['psw']);
else
    $autenticato = false;
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
            
            <h4>Valore Restituito</h4>
            <p>Restituisce un array associativo che corrisponde alla riga caricata o FALSE se non ci sono più righe da leggere. Tramite la funzione 
                <b>mysqli_fetch_assoc($risultato)</b> viene restituito un <b>Array Associativo</b> per ogni riga che prendiamo (to fetch) del Resultset <b>$risultato</b> che leggiamo.</p>
            
            <p style="margin: 10px 0px;"><b>La funzione restituisce FALSE</b>, nel momento in cui non ci sono più righe da leggere 
                (il cursore raggiunge la riga successiva a quella dell'ultimo record restituito)</b>.</p>
            
            <h4>Come Funziona</h4>
            <p style="margin: 10px 0px;">Il puntatore, cursore, di default viene posizionato sulla prima riga. Quando si invoca, per la prima volta, la funzione 
                <b>mysqli_fetch_assoc</b> legge la prima riga e contestualmente "il cursore" (pointer) si sposta alla riga successiva. Invocando nuovamente la funzione legge 
                la seconda riga ed sposta il cursore a quella successiva. Pertanto, per leggere un recordset composto da 10 Righe (cardinalità 10) dobbiamo invocare 
                10 volte la funzione.</p>
            
            <p>Approccio <b>OOP > mysqli_result::fetch_assoc</b>.</p>
            
            <h4>Esempio</h4>
            <p>Finché esiste una riga di dati, si pone questa riga in $riga come un array associativo.</p>
            <p>Nota: Se ci si aspetta solo una riga, non è necessario usare un ciclo.</p>
            <p>Nota: Se si mette extract($riga); all'interno del seguente ciclo, si creeranno tante variabili quante sono le colonne 
                (es. $id_utente, $nome_intero, $stato_utente etc.).</p>
<pre>
while ($riga = mysql_fetch_assoc($risultato)) {
    echo $riga["id_utente"];
    echo $riga["nome_intero"];
    echo $riga["stato_utente"];
}
</pre>
            <p><b>mysqli_fetch_assoc() è equivalente alla chiamata di <u>mysqli_fetch_array() con MYSQL_ASSOC come secondo parametro opzionale</u>.</b> Questa restituisce solo 
                un array associativo. Questo è il modo in cui mysql_fetch_array() funzionava originalmente. Se è necessario l'indice numerico al posto di quello associativo, 
                usare mysqli_fetch_array() senza secondo parametro.</p>

            <p class="box_giallo"><b>ATTENZIONE:</b> Se due o più colonne del risultato hanno gli stessi nomi di campo, l'ultima colonna avrà la precedenza.
                Per accedere alle altre colonne con lo stesso nome, si deve accedere al risultato con l'indice numerico usando mysqli_fetch_row() oppure 
                aggiungere degli alias nella query SQL. Vedere l'esempio nella descrizione di mysqli_fetch_array() per quanto concerne gli alias.</p>

            <p class="codice black"><b>Prestazioni:</b> l'uso di mysqli_fetch_assoc() fornisce un significativo valore aggiunto rispetto a mysqli_fetch_row(), 
                in quanto non è significativamente più lento.</p>

            <hr />
            
            <h4 class="esempio" style="font-weight: normal;">Altri metodi per leggere le righe.</h4>
            <ul>
                <li>
                    <h5>mysqli_fetch_object</h5>
                    <p><b>Legge una riga di <b>$risultato</b> come un oggetto</b>. Con approccio <b>OOP > mysqli_result::fetch_object</b>.</p>
                    <p style="margin: 10px 0px;"><b>mysql_fetch_object() è simile a mysql_fetch_array()</b>, con una differenza: 
                        <b>viene restituito un oggetto</b> invece che un array.</p>
                    <p style="margin: 10px 0px;"><b>Restituisce un oggetto con proprietà che corrispondono alla riga caricata</b> oppure <b>FALSE se non ci sono più righe</b>. 
                        Indirettamente, questo significa che <b>si ha solo accesso ai</b> dati attraverso i <b>nomi dei camp</b>i e non attraverso il loro indice 
                        (i mumeri sono nomi di proprietà illeciti).</p>
                    <h6>Esempio pratico:</h6>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
/* questo è valido */
echo $riga->campo;

/* questo non è valido */
echo $riga->0;
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
                    <p class="codice black"><b>Prestazioni:</b> In termini di velocità, la funzione è identica a mysql_fetch_array() e quasi veloce quanto mysql_fetch_row() 
                        (la differenza è insignificante).</p>
                </li>
                <li>
                    <h5>mysqli_fetch_array</h5>
                    <p>mysqli_result::fetch_array — Fetch a result row as an associative, a numeric array, or both</p>
                </li>
                <li>
                    <h5>mysqli_fetch_fields</h5>
                    <p>mysqli_result::fetch_fields — Returns an array of objects representing the fields in a result set</p>
                </li>
                <li>
                    <h5>mysqli_fetch_row</h5>
                    <p>mysqli_result::fetch_row — Get a result row as an enumerated array</p>
                </li>
                <li>mysqli_result::$current_field — Get current field offset of a result pointer</li>
                <li>mysqli_result::data_seek — Adjusts the result pointer to an arbitrary row in the result</li>
                <li><p>mysqli_result::fetch_all — Fetches all result rows as an associative array, a numeric array, or both</p></li>               
                <li>mysqli_result::fetch_field_direct — Fetch meta-data for a single field</li>
                <li>mysqli_result::fetch_field — Returns the next field in the result set</li>                
                <li>mysqli_result::$field_count — Get the number of fields in a result</li>
                <li>mysqli_result::field_seek — Set result pointer to a specified field offset</li>                
                <li>mysqli_result::$lengths — Returns the lengths of the columns of the current row in the result set</li>
                <li>
                    <h5>mysqli_num_rows</h5>
                    <p>Restituisce il numero di righe (rows) di un ResultSet. Con approccio <b>OOP > mysqli_result::$num_rows</b>.</p>
                    <h6>Esempio pratico:</h6>
<pre>
if (mysqli_num_rows($risultato) == 0) {
    echo "Nessuna riga trovata, niente da stampare quindi si esce";
    exit;
}
</pre>
                </li>
            </ul>
                    
        </li>
    </ol>

    <h3 class="sottotitolo_paragrafo">Liberiamo le risorse</h3>
    <ol start="7">
        <li>
            <h4>mysqli_free_result</h4>
            <p>Svuotiamo il ResultSet, liberiamo la memoria associata.</p>
            <p class="codice">mysqli_free_result($risultato);</p>

            <p><b>OOP > mysqli_result::free</b>, Frees the memory associated with a result.</p>
        </li>
            
        </li>
        <li>
            <h4>mysqli_close</h4>
            <p>Chiudiamo la connessione con il Server di MySQL.</p>
            <p class="codice">mysqli_close($conn);</p>
        </li>
        <li>
            <h4>unset</h4>
            <p>Eliminamo le variabili a runtime.</p>
            <p class="codice">unset($risultato, $conn);</p>
        </li>
    </ol>

    <h3 class="sottotitolo_paragrafo">Utente Trovato? Login Avvenuto?</h3>
    <ol start="10">
        <li>
            <p>Stampa a video il risultato dell'operazione <b>ACCEDI</b>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
#5 Stampa a video il risultato di ACCEDI
echo '<p class="codice"';
    if($autenticato){
        echo '>';
        echo '#4 - OK. Superato Check...'.$nl;
    }else{
        echo 'style="color: yellow;">';
        echo '#5 - Autenticazione Fallita...'.$nl;
    }
echo '</p>';
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    </ol>
</body>
</html>