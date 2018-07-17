<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 65 - Nostra Classe OOP contenente Adapter MySQLi Procedurale 2/2 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 65</strong>
    </p>

    <h1>[65] Aspetti Architetturali 4 di 4</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Nostra Classe OOP contenente Adapter MySQLi Procedurale 2/2</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione,
        <a href="lezione-64/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione:</h2>
    <p><u>Nella prima parte</u> vediamo <b>le restanti funzioni interne alla <u>classe db</u></b> che utilizzano il metodo procedurale di MySQLi:</p>
    <ol>
        <li><p>Il metodo <b>sanifica_parametro()</b> che ripulisce le query da passare al comando SQL;</p></li>
        <li><p>Il metodo <b>select()</b> che sottomette la query SQL alla funzione <b>mysqli_query</b> di MySQLi;</p></li>
        <li><p>Il metodo <b>insert()</b> che sottomette la query SQL per aggiungere un nuovo utente con le funzioni <b>mysql_query</b> e <b>mysqli_insert_id</b>;</p></li>
        <li><p>Il metodo <b>close()</b> che chiude la connessione.</p></li>
    </ol>
    
    <p><u>Nella seconda parte</u>, <b>modifichiamo</b> la nostra <b>classe db</b> per sfruttare l'<b>approccio OOP</b> messo a disposizione dall'oggetto <b>MySQLi</b>.</p>
    
    <p class="codice">Approfondimenti sulla libreria di <a href="http://php.net/manual/it/book.mysqli.php" title="la librearia di MySQLi" target="_blank">MySQLi</a> su PHP.net</p>

    <hr />
    
    <h2>setup_con_DB.php</h2>
    
    <h3 class="sottotitolo_paragrafo">sanifica_parametro()</h3>
    <p>Il metodo restituisce la stringa sanificata, effettuando l'escape.</p>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
public function sanifica_parametro($parametro){
    return mysqli_escape_string($this->conn, $parametro);
}
CODICE;
echo htmlspecialchars($codice);
?>
</pre>

    <hr />
    
    <h3 class="sottotitolo_paragrafo">select()</h3>
    <p>Il metodo <b>select()</b> <u>restituisce</u> <b><u>false</u> in caso di problemi</b> nell'esecuzione del comando oppure un <b>Array</b> con tanti elementi quante sono 
        <b>le righe restituite</b>, zero o più righe, dal Result Set della Query MySQLi.</p>
    
    <p style="margin: 10px 0px;">La funzione <b>mysqli_query</b> restituisce:</p>
    <ul class="box_giallo">
        <li><p>in caso di <b>errore</b> il valore boolean <b>false</b>;</p></li>
        <li><p>in caso di <b>successo</b> il <b>Result Set</b> composto dal <b>numero di righe</b>.</p></li>
    </ul>
    <p class="codice">Per questo motivo nell'<b>espressione che valuta il valore restituito</b> si deve usare l'<b>operatore di confronto strict</b>, forte <b>===</b>. 
        Altrimenti, <b>nel caso il Result Set avesse 0 righe</b>, il risultato dell'espressione <b>con un operatore di confronto debole</b> sarebbe <b>true</b>.</p>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
public function select($query){

    $risultato_query = mysqli_query($this->conn, $query);

    if($risultato_query === false){
        $this->stato = false;
	$this->descrizione_stato = $this->messaggi_errore['problema_con_server'];

	if($this->stampa_errori)
            echo $this->messaggi_errore['problema_con_server'].$this->nl;

	return false;
    }else{
	$this->stato = true;

	$righe_estratte = array();
        while ($riga = mysqli_fetch_assoc($risultato_query)){
            $righe_estratte[] = $riga;
        }

        return $righe_estratte;
    } 
 }
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
 
    <hr />
    
    <h3 class="sottotitolo_paragrafo">insert()</h3>
    <p>Alla funzione <b>mysqli_query</b> viene passata la query SQL INSERT TO. <b>Se l'utente viene aggiunto con successo</b> al database <b>true</b>, invece, 
        nel caso <b>il comando SQL provoca un'eccezione</b>, la funzione restituisce <b>false</b>.</p>
    
    <h4>mysqli_query()</h4>
    <p style="margin: 10px 0px;">L'<b>esito dell'operazione</b>, restituito dalla funzione <b>mysqli_query()</b>, è rappresentato da un valore booleano che 
        viene salvato nella variabile <b>$esito</b>:</p>
    <ol>
        <li>
            <p>se <b>true</b>:</p>
            <ol>
                <li>il valore della variabile <b>$stato</b> assume <b>true</b>;</li>
                <li>viene <b>restituito l'ID User</b> appena inserito corrispondende all'istanza della connessione attiva;</li>
            </ol>
        </li>
        <li>
            <p>se <b>false</b>, vengono eseguite le seguenti operazioni:</p>
            <ol>
                <li>la variabile <b>$stato</b> viene valorizzata con <b>false</b>;</li>
                <li>l'errore viene salvato in <b>$descrizione_stato</b>;</li>
                <li>se <b>$stampa_errori</b> è <b>true</b>, l'errore viene stampato a video;</li>
                <li>Viene restituito <b>false</b>.</li>
            </ol>
        </li>
    </ol>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
public function insert($comandoSQL){

    $esito = mysqli_query($this->conn, $comandoSQL);

    if($esito){

        // OK Inserimento

        $this->stato=true;
        return mysqli_insert_id( $this->conn );
    }else{

        // Errore Inserimento

        $this->stato = false;
        $this->descrizione_stato = $this->messaggi_errore['problema_con_server'];

        if($this->stampa_errori) 
        echo $this->messaggi_errore['problema_con_server'].$this->nl;

        return false;
    }
}
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    <hr />
    
    <h3 class="sottotitolo_paragrafo">close()</h3>
    <p>Chiude l'istanza attiva della connessione salvata nella variabile membro $conn.</p>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
public function close(){
    mysqli_close($this->conn);
}
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
 
    <hr />

    <h2>elogin.php</h2>
    <p>Adesso <u>analizziamo il resto delle chiamate ai metodi della classe db</u> istanziata da <b>elogin.php</b>.</p>
    
    <p style="margin: 10px 0px;">Saltiamo la prima parte che verifica la provenienza delle Richiesta HTTP perché non ha subito modifiche.</p>
    
    <ol>
        <li><p>Istanziamo un Oggetto db, (connessione e scelta del db saranno automatiche);</p></li>
        <li><p>Nella precedente lezione abbiamo visto come funzionano:</p>
            <ol>
                <li><p>il costruttore</p></li>
                <li><p>il metodo connessione()</p></li>
                <li><p>il metodo scelta_database()</p></li>
                <li><p>il metodo get_stato</p></li>
            </ol>
        </li>
        <li>
            <p>Se la proprietà $stato della classe db è true, l'esecuzione dello script prosegue.</p>
        </li>
    </ol>
    
    <h3 class="sottotitolo_paragrafo">sanifica_parametro()</h3>
    <p>Viene creata la stringa $comandoSQL "sanificando" la query "$email" ricevuta dal form di Login, tramite il metodo sanifica_parametro($email);</p>

    
    <h3 class="sottotitolo_paragrafo">select()</h3>
    <p>Si interroga il database con il metodo <b>->select</b>, salvando in $righe_estratte l'Array delle righe dei recordset restituiti che, in questo caso, è 1.</p>
    
    <p style="margin: 10px 0px;">Nel <b>caso di errore</b> di comunicazione con il server, il metodo restituisce <b>false</b>. Stampiamo a video l'errore e 
        blocchiamo l'esecuzione dello script.</p>
            
    <p style="margin: 10px 0px;">Utilizzare il <b>confronto strict ($righe_estratte===false)</b>, in quanto un confronto debole resituirebbe ugualmente false anche nel caso in cui la richiesta 
            di mysqli_query va a buno fine ma restituisce 0 righe, in questo caso l'Array contiene 0 elementi.</p>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
$db_quiz = new db($cartella_ini, $messaggi_errore, true);

if (! $db_quiz->get_stato() )
  die;

$comandoSQL =
  "select iduser, psw from users where email ='" . $db_quiz->sanifica_parametro($email) ."'";

//2 inviare il comando e memorizzare il risultato
$righe_estratte = $db_quiz->select($comandoSQL);

if ($righe_estratte===false) //problema nell'esecuzione del comando{
   echo $db_quiz->get_descrizione_stato().$nl;
   echo "... mentre stavo eseguendo: ".$comandoSQL.$nl;
   die;
}
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <p>Nel caso la query di $comando SQL non ha provocato eccezioni, l'esecuzione dello script prosegue. Rileviamo quale bottone è stato premuto: 
        'accedi' o 'nuovo utente'</p>
    
    <h3 class="sottotitolo_paragrafo">Pulsante ACCEDI</h3>
    <ol>
        <li>
            <p>Verifichiamo che l'Array contenga almeno una riga. Infatti avremo un Array con un elemento perché l'email è unica in tutto il database, non possono 
                esserci più utenti con lo stessa email. Questo controllo è stato definito in fase di realizzazione del Database creando un indice <b>UNIQUE</b> per 
                il campo 'email' della tabella 'users'.</p>
        </li>
        <li>
            <p>In caso positivo, <b>email trovata,</b> assegniamo a $autenticato l'esito dell'espressione di confronto tra la password inserita nel form 
                di Login e quella presente nel database corrispondente all'email trovata. La variabile <b>$autenticato</b> conterrà il valore booleano <b>true</b> se 
                <b>le password corrispondono</b>, <b>altrimenti false</b>.</p>
        </li>
        <li>
            <p>Nel caso l'Array abbia zero elementi, quindi <b>email non trovata</b>, assegniamo alla variabile <b>$autenticato</b> il valore booleano <b>false</b>.</p>
        </li>
        <li>
            <p><b>Chiudiamo la connessione</b> al Server MySQL con <b>$db_quiz->close()</b>;</p>
        </li>
        <li>
            <p>Creiamo la <b>variabile di sessione 'iduser'</b> assegnando l'ID User appena creato e effettuiamo il <b>redirect a main.php</b> se 
                <b>$autenticato</b> è <b>true</b>. Invece se <b>false</b> redirect a <b>login.php</b> con la chiave dell'errore.</p>
        </li>
        <li>
            <p>Dopo il redirect blocchaimo l'esecuzione dello script in entrambi i casi.</p>
        </li>
    </ol>
    
    <h4>Codice</h4>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
if (isset($_POST['btnAccedi'])){

   //3 elaborare il risultato
   if ( count($righe_estratte)>0 ) //mail trovata, confrontiamo psw
   {
      $riga = $righe_estratte[0];
      //echo "Trovata".$nl;
      $autenticato = ($psw === $riga['psw']);
   }
   else
     $autenticato = false;

   //4 chiudere la/le connessione/i
   $db_quiz->close();

   //redirect
   if($autenticato)
   {
     $_SESSION['iduser']=$riga['iduser'];
       header("Location: main.php");
   }
   else
     header("Location: login.php?errore=autenticazione_fallita");

   exit;
}else{
CODICE;
echo htmlspecialchars($codice);
?>
</pre>

    <h3 class="sottotitolo_paragrafo">Pulsante NUOVO UTENTE</h3>
    <p>Nel caso invece in cui l'utente vuole registrarsi, viene eseguito il seguente codice:</p>
    
    <ol>
        <li><p>Verifichiamo prima che l'email inserita non sia presente nel database. In questo caso chiudiamo la connessione, effettuiamo il redirect alla pagina 
                login.php passando anche la chiave dell'errore e vlocchiamo con l'istruzione exit l'esecuzione del resto dell script;</p></li>
        <li><p>Nel caso l'Array non contenga elementi perché l'email inserita non è presente nel database si prosegue con l'aggiunta del nuovo utente;</p></li>
        <li><p>Se il metodo <b>insert()</b> restituisce <b>true</b> viene creata la variabile di sessione '<b>iduser</b>' a cui viene assegnato l'ID user appena 
                creato, chiusa la conessione ed effettuato il redirect a <b>main.php</b>. In caso di errore della query, errore di sintassi e/o comunicacazione 
                con il Server MySQL e/o Database, il metodo restotuisce false alla variabile <b>$esito</b>. In questo caso viene chiusa la connessione ed effettuato 
                il redirect alla pagina <b>login.php</b> passando la chiave dell'errore.</p>
        </li>
    </ol>
    
    <h4>Codice</h4>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
}else{
  //BOTTONE NUOVO UTENTE

  if ( count($righe_estratte)>0 ){
    $db_quiz ->close();
    header("Location: login.php?errore=email_gia_inserita");
    exit;
  }

  //insert into users values (null, 'e@j.com','eee')
  $comandoSQL = "insert into users values (null,
                '".$db_quiz->sanifica_parametro($email)."',
                '".$db_quiz->sanifica_parametro($psw)."')";
  $esito = $db_quiz->insert($comandoSQL);

  if ($esito){
    $_SESSION['iduser'] = $esito;
    $db_quiz->close();
    header("Location: main.php");
  }else{
    $db_quiz->close();
    header("Location: login.php?errore=inserimento_fallito"); //inserimento fallito
  }
  
  exit;
}
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />

    <h2>Approccio OOP</h2>
    <p>Ora vediamo come modifcare la il nostro modello di accesso ai dati, rappresentato dalla classe db, utilizzando il metodo ad Oggetti di MySQLi.</p>
    
    <p class="box_giallo">La logica Business non cambia, la creazione dell'istanza dello'oggetto db, chiamate ai metodi nono subiscono modifiche. Questo è il bello 
    della programmazione OOP.</p>
    
    <h3>Codice</h3>
    <p>Di seguito vediamo come cambia il codice della nostra classe db utilizzando l'approccio ad oggetti di MySQLi.</p>
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
<?php
include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup.php");

//la classe db è pensata per lavorare con un db specifico
//per cui se servisse cambiare database bisognerebbe istanziare un nuovo
//oggetto db
class db{
    private
    $db,                // oggetto data base mysqli
    $conn,              // riferimento alla connessione	
    $cartella_ini, 	// posizione file ini
    $messaggi_errore, 	// array associativo con i messaggi di errore
    $access_data,     	// credenziali lette da .ini
    $stato,           	// esito (true/false) dopo creazione oggetto o
                        // dopo aver tentato invio comando a mysQLL
    $descrizione_stato,	// il messaggio di errore eventualmente da stampare
    $stampa_errori,     // true / false
    $nl = "<br />";

    public function get_stato()
    {return $this->stato;}

    public function get_descrizione_stato()
    {return $this->descrizione_stato;}

    public function __construct($cartella_ini, $messaggi_errore, $stampa_errori=true){

        //recupero credenziali da file ESTERNO alla cartella pubblica del sito
        $this->accessData=parse_ini_file($cartella_ini.'\configDB.ini');

        //copio il riferimento all'array con i messaggi di errore
        $this->messaggi_errore = $messaggi_errore;

        //devono essere stampati gli errori o solo memorizzati in la descrizione stato?
        $this->stampa_errori = $stampa_errori;

        $this->connessione();

        if( $this->stato ){
            $this->scelta_data_base();
 
            if (!$this->stato)
                $this->close();
        }
    }


    private function connessione(){

        $this->db = @new mysqli($this->accessData['host'],
                                $this->accessData['username'],
                                $this->accessData['password']);

        if( $this->db->connect_error){
            $this->stato = false;
            $this->descrizione_stato = $this->messaggi_errore['connessione_fallita'];

            if($this->stampa_errori)
            echo $this->messaggi_errore['connessione_fallita'].$nl; 
        }
        else
            $this->stato = true;
    } // Fine connessione()

    private function scelta_data_base(){

        if ( !@$this->db->select_db($this->accessData['dbname']) ){
            $this->stato = false;
            $this->descrizione_stato = $this->messaggi_errore['db_non_trovato'];

            if($this->stampa_errori)
                echo $this->messaggi_errore['db_non_trovato'].$this->nl;
        }
        else
            $this->stato = true;
    }

    public function sanifica_parametro($parametro){
        return $this->db->escape_string($parametro);
    }

    //restituisce false in caso di problemi nell'esecuzione del comando
    //oppure un array con le righe restituite da mysql
    public function select($query){
        $risultato_query = $this->db->query($query);

        if($risultato_query === false){
            $this->stato = false;
            $this->descrizione_stato = $this->messaggi_errore['problema_con_server'];
            $this->close();

            if($this->stampa_errori) 
	       echo $this->messaggi_errore['problema_con_server'].$this->nl;

            return false;
        }else{
            $this->stato = true;

            $righe_estratte = array();  
            while ( $riga = $risultato_query->fetch_assoc() ){
                $righe_estratte[] = $riga;
            }

            return $righe_estratte;
        } 
    }

    public function insert($comandoSQL){

        $esito = $this->db->query($comandoSQL);

        if($esito){
            $this->stato=true;
            return $this->db->insert_id;
	}else{
            $this->stato = false;
            $this->close();
            $this->descrizione_stato = $this->messaggi_errore['problema_con_server'];

            if($this->stampa_errori)
                echo $this->messaggi_errore['problema_con_server'].$this->nl;

                return false;
            }
        }

    public function close(){
        $this->db->close();
    }
}
?>
CODICE;
echo htmlspecialchars($codice);
?>
</pre>

</body>
</html>