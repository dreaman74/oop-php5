<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 60 - Nuovo Utente nel Database e Gestione Messaggi - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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

    <h1>[60] Nuovo Utente nel Database e Gestione Messaggi</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 9</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione, 
        <a href="lezione-60/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione</h2>
    <ul>
        <li>Aggiungiamo la logica per l'inserimento di un nuovo utente nel data base</li>
        <li>Gestire i messaggi di errore quando un redirect rimanda indietro alla pagina di login/registrazion</li>        
        <li>Come Funziona la pagina <a href="#main" title="codice della pagina main.php">MAIN.php</a>
            <ul>
                <li>Controlli iniziali e Connessione a MySQL</li>
                <li>ACCEDI</li>
                <li>NUOVO UTENTE</li>
                <li><b>I Comandi DML - Data Manipulation Language</b></li>
                <li><b>INSERT</b> - Aggiungere Records</li>
                <li><b>mysqli_insert_id</b> - Recuperare ultimo id creato relativo alla stessa istanza di connessione</li>
                <li>Codice dell'Applicazione</li>
            </ul>
        </li>
        <li>Come Funziona la pagina <a href="#login" title="codice della pagina login.php">LOGIN.php</a>
            <ul>
                <li><b>isset</b> e <b>$_GET</b></li>
                <li><b>switch</b></li>
                <li>Codice dell'Applicazione</li>
            </ul>
        </li>
    </ul>

    <hr />

    <h2>Come funziona l' Applicazione</h2>
    
    <h3 id="main" class="celeste">MAIN.php</h3>
    
    <p>Il codice è identico, solo che il blocco contenente</p>
    <ul>
        <li>l'istruzione che crea la connessione $conn e relativo controllo;</li>
        <li>la selezione del database e relativo controllo;</li>
        <li>la query che interroga il Database restituendo il record corrispondende all'email inserita nel form;</li>
    </ul>
    <p>è stato spostato prima del blocco condizionale che verifica il bottone premuto.</p>
    
    <h4 class="celeste">Controlli iniziali e Connessione a MySQL</h4>
    <p>Verifica del metodo Utilizzato dalla RIchiesta HTTP. Nel caso non sia POST viene redirezionato alla pagina login.php</p>
<pre class="black">
<?php
$codice = <<< 'CODICE'
<?php
session_start();

$nl = "<br />";

//recupero credenziali da file ESTERNO alla cartella pubblica del sito
$accessData=parse_ini_file('private\configDB.ini');
  
//prima di tutto un po' di sicurezza ...
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //ok la pagina è stata davvero richiamata dalla form

    //recupero il contenuto della textbox email
    $email = $_POST['email'];

    //... e quello della textbox password
    $psw = $_POST['password'];

    //1 stabilire una (o più) connessione/i con un server
    //NB: con @ si sopprimono i warning/errori del comando
    $conn = @mysqli_connect($accessData['host'],$accessData['username'],$accessData['password']);

    if(!$conn)
    {//gestione dell'errore

        //echo mysqli_connect_errno() . $nl;
        //echo mysqli_connect_error() . $nl;
        //echo mysqli_sqlstate( $conn ) . $nl;
        echo "Connessione al server fallita. Impossibile procedere. Contattare ...";
        die;  
     }

    //2 selezionare il db con cui lavorare
    if ( !@mysqli_select_db($conn, $accessData['dbname']) )
    {
      echo "Non trovo il data base ...".$nl;
      echo mysqli_sqlstate( $conn ) . $nl;
      echo mysqli_errno( $conn ) . $nl;
      echo mysqli_error( $conn ) . $nl;
      die;
    }

    $comandoSQL =
      "select iduser, psw from users where email ='".mysqli_escape_string($conn, $email)."'";

    //2 inviare il comando
    $risultatoRicercaEmail = @mysqli_query($conn, $comandoSQL);
    
    [...]
}else{
    header("Location: login.php?errore=4"); //non autenticato
    exit;
}
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h4 class="celeste">ACCEDI</h4>
<pre class="black">
<?php
$codice = <<< 'CODICE'
<?php
[...]
//quale bottone è stato premuto, 'accedi' o 'nuovo utente'?
if (isset($_POST['btnAccedi'])){

    if ($risultatoRicercaEmail){
        //la query ha avuto successo
        //3 elaborare il risultato
        if ($riga = mysqli_fetch_assoc($risultatoRicercaMail) ){
            //mail trovata, confrontiamo psw
            $autenticato = ($psw === $riga['psw']);                               
        }else
            $autenticato = false;

        //4 chiudere la/le connessione/i
        mysqli_close($conn);

        //redirect
        if($autenticato){
            $_SESSION['iduser']=$riga['iduser'];         
            header("Location: main.php");
        }else
            header("Location: login.php?errore=1");

        // Blocca il parsing del codice dopo uno dei 2 redirect
        exit;
    }else{
        //fallita mysqli_query
        echo "Problemi con il server data base ...".$nl;
        echo mysqli_sqlstate( $conn ) . $nl;
        echo mysqli_errno( $conn ) . $nl;
        echo mysqli_error( $conn ) . $nl;
        die;  
    }
    // Fine dell' if ($risultatoRicercaEmail){
    
}else{
    //BOTTONE NUOVO UTENTE
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h4 class="celeste">NUOVO UTENTE</h4>
    <p><b>Spiegazione del codice:</b></p>
    <ol>
        <li><p>Se viene premuto il pulsante NUOVO UTENTE;</p></li>
        <li><p>Si effettuata una verifica nel Resultset della query salvato nella variabile $risultatoRicercaEmail;</p></li>
        <li>
            <p>Si verifica se ci sono Records, leggendo con la funzione mysqli_fetch_assoc($risultatoRicercaEmail) una riga;</p>
            <ul>
                <li><p>Se viene trovata una riga, il controllo condizionale restituisce TRUE, viene effettuato il Redirect alla pagina Login.php passando con GET 
                    la query errore=2. Viene anche bloccata l'esecuzione dello script con il comando exit;</p></li>
                <li><p>Invece, se l'espressione del controllo condizionale <b>restituisce FALSE</b>, quindi l'<b>email non è presente</b>, si prosegue con il parsing (esecuzione) 
                dello script senza redirect.</li>
            </ul>
        </li>
        <li>
            <p>Se l'<b>email non viene trovata</b>, si può proseguire alla <b>registrazione del nuovo utente</b> con il comando (SQL) <b>INSERT INTO</b> che 
                rientra nella categoria dei <b><u>comandi di manipolazione</u></b>.</p>
            
            <h5 class="sottotitolo_paragrafo">Comandi DML - Data Manipulation Language</h5>
            <p>Elenco dei comandi dedicati alla <b>manipolazione dei dati</b> dei database (Schemas):</p>
            <ul>
                <li>INSERT</li>
                <li>SELECT</li>
                <li>DELETE</li>
                <li>UPDATE</li>
            </ul>

            <h5 class="sottotitolo_paragrafo">INSERT - Aggiungere Records</h5>
            <p style="margin: 10px 0px;">Con il comando DML <b>INSERT TO</b>, <b>aggiungiamo una nuova riga</b> (Records) nella tabella (Entity) del database (Schema). 
                Possiamo creare un nuovo records, nei seguenti modi:</p>
            <ul>
                <li>
                    <p>Indicare solo i valori, omettendo i campi presenti nella tabella:</p>
                    <pre class="black">insert into users values (null, 'e@e.com','eee')</pre>
                    <p class="codice"><b><u>Obbligatoriamente</u>, il numero dei valori deve essere pari al numero dei campi presenti nella tabella.</b> 
                        In questo caso <b>&egrave; obbligatorio specificare tutti i valori</b> anche quelli per i campi con un valore predefinito nel database, 
                        per esempio, per il campo con chiave primaria e contatore con autoincremento, <u><b>iduser</b>  dobbiamo specificare <b>null</b></u>.</p>
                    </p>
                </li>
                <li>
                    <p>Indicare esplicitamente tutti i campi e rispettivi valori:</p>
                    <pre class="black">insert into users (iduser, email, psw) values (null, 'e@e.com','eee')</pre>
                </li>
                <li>
                    <p>Indicare alcuni campi e rispettivi valori:</p>
                    <pre class="black">insert into users (email, psw) values ('e@e.com','eee')</pre>
                </li>
            </ul>
        </li>
        <li>
            <p>Nella variabile con identificatore $esito, salviamo l'esito dell'operazione della Creazione del Nuovo Utente:</p>
            <ul>
                <li>TRUE, Utente Creato</li>
                <li>FASLE, Errore Utente NON Creato</li>
            </ul>
            </ul>
            <p class="codice">Il comando <b>mysqli_query</b> restituisce un <b>valore <u>BOOLEANO</u> che rappresenta l'esito dell'operazione</b>, in questo caso l'inserimento di 
                un nuovo record.</p>
        </li>
        <li>
            <h5 class="sottotitolo_paragrafo">mysqli_insert_id</h5>
            <p>Se la query di inserimento viene eseguita con successo, l'identificatore $esito è valorizzato a TRUE, con il comando mysqli_insert_id recuperiamo 
                l'ultimo IDUSER creato. Questo comando accetta l'stanza della connessione attiva legata all'utente che ha creato la query di inserimento appena conclusasi. 
                Questo siginifica che, anche nel caso in cui ci siano più utenti che invocano contemporaneamente il comando di inseriemnto di un Nuovo Utente, 
                l'IDUSER restituito sarà legato all'istanza della connessione dell'utente.</p>
            
            <p style="margin: 10px 0px;">Il Nuovo Utente viene autenticato automaticamente, in quanto l'IDUSER, recuperato con il comando mysqli_insert_id, 
                viene salvato nella variabile di sessione iduser.</p>
            
            <p style="margin: 10px 0px;">Una volta creato con successo il Nuovo Utente e salvato nella variabile di sessione l'IDUSER corrispondente, viene effettuato 
                il Redirect alla pagina MAIN.php che rappresenta la pagina accessibile solo agli utenti AUTENTICATI.</p>
            
            <p style="margin: 10px 0px;">Nel caso di insuccesso, la variabile $esito contenga FALSE, viene effettuato il redirect alla pagina login.php passando 
            con GET la query errore=3 (Inserimento fallito).</p>
        </li>
    </ol>
    
    <hr />
    
    <h5 class="esempio">Codice Applicato</h5>
<pre class="black">
<?php
$codice = <<< 'CODICE'
<?php
[...]
}else{
    //BOTTONE NUOVO UTENTE
    if ( mysqli_fetch_assoc($risultatoRicercaEmail) ){
        mysqli_close($conn);
        header("Location: login.php?errore=2"); //email gia' presente
        exit;
    }

    //insert into users values (null, 'e@j.com','eee')
    $comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
    $esito = mysqli_query($conn, $comandoSQL);

    if ($esito){
        $_SESSION['iduser'] = mysqli_insert_id( $conn );
        mysqli_close($conn);
        header("Location: main.php");
    }else{
        mysqli_close($conn);
        header("Location: login.php?errore=3"); //inserimento fallito
    }

    // Blocca il parsing del codice dopo uno dei 2 redirect
    exit;
}
[...]
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h3 id="login" class="celeste">LOGIN.php</h3>
    <p>Come vengono gestiti gli errori.</p>
    
    <hr />
    
    <h4 class="sottotitolo_paragrafo">isset e $_GET</h4>
    <p>Usiamo l'<b>Array Superglobale $_GET</b> per verificare se la <b>query errore è presente</b>.</p>
    
    <hr />

    <h4 class="sottotitolo_paragrafo">switch</h4>
    <p>Se il controllo condizionale restituisce TRUE, utilizziamo <b>lo <u>switch</u> per personalizzare il messaggio da stampare in base al valore contenuto nella query</b>.</p>

    <hr />
    
    <h4 class="esempio">Codice Applicato</h4>    
<pre class="black">
<?php
$codice = <<< 'CODICE'
<?php
if( isset($_GET['errore']) ){
    echo "<p id='box_errore'".
         " style='background-color: red; font-weight: bold; color: yellow; border: 2px solid white;'>";

        switch ($_GET['errore'])
        {
           case 1:
             echo "Errore 1: L'email è presente ma la Password è errata";
            break;

           case 2:
             echo "Errore 2: Il Nuovo Utente non è stato creato, in quanto l'email inserita è presente";
            break;

           case 3:
             echo "Errore 3: Errore, nella query di inserimento del Nuovo Utente";
            break;

           case 4:
             echo "Errore 4: l'Accesso alla pagina main.php non proviene dal form di questo sito";
            break;
        }

    echo "</p>";
}
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
</body>
</html>