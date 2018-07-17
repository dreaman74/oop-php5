<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 64 - Nostra Classe OOP contenente Adapter MySQLi Procedurale 1/2 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 64</strong>
    </p>

    <h1>[64] Aspetti Architetturali 3 di 4</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Nostra Classe OOP contenente Adapter MySQLi Procedurale 1/2</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione,
        <a href="lezione-64/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione:</h2>
    <ul>
        <li>elogin.php - Logica Business - che istanzia la classe db;</li>
        <li>
            <p>setup_con_DB.php - classe db che gestisce la connessione al Server MySQL e seleziona il Database. I Metodi e le Proprietà interne, utilizzano 
            il metodo procedurale dell'Adapter MySQLi. In questa Lezione studiamo:</p> 
            <ul>
                <li><p><b>Lo Stato Interno</b>, il Gruppo delle Variabili Membro Private;</p></li>
                <li><p>Il metodo <b>Costruttore</b></p></li>
                <li><p>I metodi accessori, <b>get_stato()</b> e <b>get_descrizione_stato()</b>, preposti al recuperano delle variabili interne private;</p></li>
                <li><p>Il metodo <b>connessione()</b> che stabilisce la connessione con il Server MySQL;</p></li>
                <li><p>Il metodo <b>scelta_data_base()</b> che seleziona il Database;</p></li>
            </ul>                
        </li>
    </ul>
    <p class="codice">Approfondimenti sulla libreria di <a href="http://php.net/manual/it/book.mysqli.php" title="la librearia di MySQLi" target="_blank">MySQLi</a> su PHP.net</p>

    <hr />

    <h2>elogin.php</h2>
    <p>Il codice di elogin.php</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup_con_DB.php");

if(isset($_SERVER['HTTP_REFERER'])){
    // Host Reale del Sito
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
if($_SERVER['REQUEST_METHOD'] == 'POST' && $host_origine == $host && $pagina == 'login.php'){

    //ok la pagina è stata davvero richiamata dalla form

    //recupero il contenuto della textbox email
    $email = $_POST['email'];

    //... e quello della textbox password
    $psw = $_POST['password'];

    //istanziamo un oggetto db
    //(connessione e scelta del db saranno automatiche)
    $db_quiz = new db($cartella_ini,$messaggi_errore, false);

    if (! $db_quiz->get_stato() )
        die;

    header("Location: main.php");
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <h3>Come funziona</h3>
    <ol>
        <li>
            <p>Includiamo il file '<b>setup_con_DB.php</b>' contenente un include di <b>setup.php</b> e la <b>classe db</b>.</p>
<pre>
include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup_con_DB.php");
</pre>
        </li>
        <li>
            <p><b>Istanziamo la classe</b> presente nel file <b>setup_con_DB.php</b>.</p>
<pre>
$db_quiz = new db($cartella_ini, $messaggi_errore, true);
</pre>
        </li>
        <li>
            <p>Verifica dello stato della connessione, se il metodo '<b>get_stato</b>' restituisce <b>false</b> si <u>blocca l'esecuzione dello script</u>.</p>
<pre>
if (! $db_quiz->get_stato() )
    die;
</pre>
        </li>
        <li>
            <p><b>Redirect</b> alla pagina <b>main.php</b> se il metodo '<b>get_stato</b>' restituisce <b>true</b></p>
<pre>
header("Location: main.php");
</pre>
        </li>
    </ol>
    
    <hr />
    
    <h2>setup_con_DB.php</h2>
    <p>Includento il file '<b>setup.php</b>' <u>rendiamo disponibile la variabile</u> '<b>$cartella_ini</b>' che rappresenta il percorso dove sono ubicati i files 
        <b>configDB.ini</b> e l'<u>Array Associativo</u> '<b>$messaggi_errori</b>' contenente le coppie chiave-valore restituite dal parsing del file <b>messaggi_errore.ini</b>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup.php");
[...]
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    <h3>Come Funziona la classe.</h3>
    
    <h4 class="sottotitolo_paragrafo">Stato Interno</h4>
    <p>Lo <b>stato interno</b> rappresenta il blocco che raggruppa tutte le <b>variabili membro</b> della classe db. In questo caso le proprietà, 
        le variabilio membro, sono dichiarate con <u>indicatore di visibilità</u> <b>private</b> quindi <u>accessibili solo internamente alla classe</u>.</p>
    
<pre style="overflow-x: auto;">
<?php
$codice = <<< 'CODICE'
<?php
//la classe db è pensata per lavorare con un db specifico
//per cui se servisse cambiare database bisognerebbe istanziare un nuovo
//oggetto db
class db{

    // Stato Interno - Variabili Membro
    private
        $conn, //riferimento alla connessione
        $cartella_ini,      // Posizione file ini
        $messaggi_errore,   // Array Associativo composto dai messaggi di errore
        $accessData,       //  Credenziali lette da .ini
        $stato,             //  Esito (true/false) dopo creazione oggetto o
                            //  dopo aver tentato invio comando a MySQLi
        $descrizione_stato, //  Il messaggio di errore eventualmente da stampare
        $stampa_errori,     //  true / false
        $nl = "<br />";
        
[...]
CODICE;
echo htmlspecialchars($codice);
?>
</pre>
    
    <h4 class="sottotitolo_paragrafo">Metodi Accessori</h4>
    <p>Questi 2 metodi permettono di accedere alle variabili membro private della classe.</p>
    
    <p style="margin: 10px 0px;">Il metodo '<b>get_descrizione_stato()</b>' resituisce l'errore riscontrato nel caso si voglia stampare fuori dalla classe.</p>
<pre>
<?php
$codice = <<< 'CODICE'
[...]
    
    public function get_stato(){
        return $this->stato;
    }

    public function get_descrizione_stato(){
        return $this->descrizione_stato;
    }
[...]
CODICE;
echo htmlspecialchars($codice);
?>
</pre>

    <h4 class="sottotitolo_paragrafo">Il Costruttore</h4>
    <p>Il costruttore riceve tre argomenti:</p>
    <ol>
        <li><b>$cartella_ini</b>, il percorso della <b>cartella che contiene i file.ini</b>;</li>
        <li><b>Array Associativo</b> recuperato dal <b>parsing</b> del file <b>messaggi_errore.ini</b> effettuato  
            ad opera dello script '<b>setup.php</b>';</li>
        <li>
            <p><b>$stampa_errori</b> - <u>Valore Booleano</u>, <b>true</b>/<b>false</b>.</p>
        </li>
    </ol>
    
    <p>Le operazioni che esegue il costruttore sono:</p>
    <ol start="4">
        <li>
            <p>Viene creato l'Array Associativo '<b>$accessData</b>' che contiene le credenziali di accesso al Server MySQL e il nome del Database;</p>
        </li>
        <li>
            <p>Viene creato l'Array Associativo '<b>$messaggi_errore</b>' contenente i vari messaggi di errore, le coppi echiave-valore 
                sono recuperate dall'argomento omonimo passato al costruttore.</p>
        </li>
        <li>
            <p>Il valore <b>true/false</b>, passato come 3° argomento, viene salvato nella variabile '<b>$stampa_errori</b>'. Il valore booleano viene utilizzato 
                come interruttore per la stampa degli errori di connessione al Server MySQL o Database. <b>Se true la stampa degli errori è attiva.</b> 
                False non vengono stampati.</p>
        </li>
        <li>
            <p>Viene richiamato il metodo '<b>connessione()</b>', interno alla classe, che effettua la connessione al Server MySQL. Questo metodo <b>restituisce</b> 
                    un booleano <b>true/false</b> per <b>$stato</b> e l'istanza della connessione in <b>$conn</b>.</p>
        </li>
        <li>
            <p>Se la variabile membro <b>$stato</b> è <b>true</b> viene invocato il metodo '<b>scelta_data_base()</b>' per la selezione del database.</p>
    </ol>

<pre>
<?php
$codice = <<< 'CODICE'
[...]
    public function __construct($cartella_ini, $messaggi_errore, $stampa_errori=true){
        //recupero credenziali da file ESTERNO alla cartella pubblica del sito
        $this->accessData=parse_ini_file($cartella_ini.'\configDB.ini');

        //copio il riferimento all'array con i messaggi di errore
        $this->messaggi_errore = $messaggi_errore;

        //devono essere stampati gli errori o solo memorizzati in la descrizione stato?
        $this->stampa_errori = $stampa_errori;

        $this->connessione();

        if( $this->stato )
            $this->scelta_data_base();
    }
[...]
CODICE;
echo htmlspecialchars($codice);
?>
</pre>

    <h4 class="sottotitolo_paragrafo">connessione()</h4>
    <p>Il primo controllo condizionale verifica che non ci sia già un'istanza attiva per la connessione al Server MySQLdi. In caso positivo <b>si tenta di stabilire 
            la connessione al Server MySQL</b>. <b>Se l'operazione viene effettuata con successo</b> la variabile membro <b>$stato</b> assume <b>true</b>, 
            diversamente <b>$stato</b> contiene <b>false</b>, in '<b>$descrizione_stato</b>' viene copiato il valore contenunto nella chiave 
            '<b>connessione_fallita</b>' dell'<b>Array $messaggi_errore</b>' e se '<b>$stampa_errori</b>' è <b>true</b> viene <u>stampato a video l'errore</u>.</p>
<pre>
<?php
$codice = <<< 'CODICE'
[...]
    private function connessione(){
        if( !isset($this->conn) ){
            //NB: con @ si sopprimono i warning/errori del comando
            $this->conn = @mysqli_connect($this->accessData['host'], $this->accessData['username'], $this->accessData['password']);

            if(!$this->conn){
                $this->stato = false;
		$this->descrizione_stato = $this->messaggi_errore['connessione_fallita'];

		if($this->stampa_errori)
                    echo $this->messaggi_errore['connessione_fallita'].$this->nl; 
            }else{
                $this->stato = true;
            }
        }
    }
[...]
CODICE;
echo htmlspecialchars($codice);
?>
</pre>

    <h4 class="sottotitolo_paragrafo">scelta_data_base()</h4>
    <p>Nel caso $stato è true <b>il costruttore invoca questo metodo il cui compito è quello di selezionare il database</b>. <u>Se positivo</u> 
        <b>$stato</b> è <b>true</b>, <u>in caso di errore</u> si comporta come il meotdo connessione() che restituisce <b>false</b> per <b>$stato</b>, 
        memorizza in <b>$descrizione_stato</b> la <b>stringa errore</b> recuperata dall'array associativo $messaggi_errore e <b>stampa l'errore a video</b>, 
        se $stampa_errori è true.</p>
<pre>
<?php
$codice = <<< 'CODICE'
[...]
    private function scelta_data_base(){
        if ( !@mysqli_select_db($this->conn, $this->accessData['dbname']) ){
            $this->stato = false;
            $this->descrizione_stato = $this->messaggi_errore['db_non_trovato'];

            if($this->stampa_errori)
                echo $this->messaggi_errore['db_non_trovato'].$this->nl;
        }
	else
            $this->stato = true;
    }
} // Fine classe db
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    
    <hr />
    
    <h2>Prossimi Argomenti</h2>
    <p>Nella prossima lezione vedremo, <u>nella prima parte</u> <b>le restanti funzioni interne alla <u>classe db</u></b> che utilizzano il metodo procedurale di MySQLi:</p>
    <ol>
        <li><p>Il metodo <b>sanifica_parametro()</b> che ripulisce le query da passare al comando SQL;</p></li>
        <li><p>Il metodo <b>select()</b> che sottomette la query SQL alla funzione <b>mysqli_query</b> di MySQLi;</p></li>
        <li><p>Il metodo <b>insert()</b> che sottomette la query SQL per aggiungere un nuovo utente con le funzioni <b>mysql_query</b> e <b>mysqli_insert_id</b>;</p></li>
        <li><p>Il metodo <b>close()</b> che chiude la connessione.</p></li>
    </ol>
    
    <p>Invece, <u>nella seconda parte</u> della lezione modifichiamo <b>la nostra classe db</b> per sfruttare l'<b>approccio OOP</b> messo a disposizione da <b>MySQLi</b>.</p>
    
</html>