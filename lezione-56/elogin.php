<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Login 2/2 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
    html, body {
            margin: 0px;
            padding: 0px;
    }

    body {
    	background-color: lightgreen;
        font-size: 100%;
        font-family: Arial, sans-serif;
        width: 100%;
	}

    form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
    
    #breadcrumb {
        background: #efefef;
        border-bottom: #afafaf 1px solid;
        margin: 0px;
        padding: 10px 10px;
    }

    pre, .codice {
        color: lightgrey;
        background-color: darkslategrey;
        border: black 1px solid;
        line-height: 2em;
        padding: 5px;
    }

    .codice {
        margin: 15px 0px;
    }
    
    .bianco {color: black;background-color:#efefef;}
</style>
</head>

<body>
    <p id="breadcrumb">
        <a href="../index.php" title="indice delle lezioni">Indice</a> / <a href="../lezione-56-forms-e-dbms-5.php" title="lezione 56">Lezione 56</a> / 
        <a href="login.php" title="pagina del form - login.php">login.php</a> / elogin.php
    </p>

    <h1>Elaborazione Login - elogin.php</h1>
    <p>Questa pagina (elogin.php) processa i dati inviati tramite Metodo POST dalla pagina (login.php). La spiegazione del codice è riportata nella Lezione 56.</p>
    
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
        
        // OK La pagina è stata richiamata dalla Form 'login.php' di 'localhost:8080'
        // echo('Controllo OK');
        
        // Recupero i dati ricevuti dagli input text 'email' e 'password'
        $email = $_POST['email'];
        $psw = $_POST['password'];

        // Quale Submit è stato premuto 'accedi' o 'nuovo utente'?        
        if(isset($_POST['btnAccedi'])){
            
            // echo "Hai premuto ACCEDI";
            
            $comandoSQL = "SELECT * FROM users WHERE email='$email'";
            // echo $comandoSQL;
            
            #1 Stabilire una (o più) connessione/i con il Server di MySQL
            // Variante con nome del database passato come argomento
            // mysqli_connect("localhost", "web_visitor", "007", "quizmaker")
            // Abbiamo utilizzato la forma senza passaggio dell'argomento nome del database
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
            
            #2 Selezionare il Database
            // Fondamentale nel caso si sia aperta la connessione senza specificare il Database
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
            
            
            #3 Interrogare il Database e prelevare i Recordset (Resultset)
            // ARRAY - La funzione restituisce un insieme di righe e colonne
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

            #4 Elaborare il risultato
            // ATTENZIONE:
            // mysqli_fetch_assoc($risultato)
            // La funzione Memorizza la prima riga restituendo un Array Associativo, e subito dopo passa alla seconda riga
            // Nel caso sia presente solo una riga, chiamando nuovamente la funzione verrà restituito FALSE            
            if($riga = mysqli_fetch_assoc($risultato))
                $autenticato = ($psw === $riga['psw']);
            else
                $autenticato = false;            
            
            #4 Libera le Risorse e Chiude la Connessione
            mysqli_free_result($risultato);
            mysqli_close($conn);
            unset($risultato, $conn);

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

        }else{
            echo "Hai premuto NUOVO UTENTE";
        }
    }else{
        echo '<p class="codice" style="color: yellow;">';
        echo 'ERRORE nel Form di Compilazione!';
        echo '</p>';
    }
    ?>

    <h2>Codice del Form</h2>    
<pre>
<?php
$codice = <<< 'CODICE'

CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    
    <div class="codice bianco">
        <h4>Approfondimenti</h4>
        <p><b>MySQLi</b> - <a href="http://php.net/manual/en/function.mysqli-connect.php" title="esempi di connessione con logica di controllo" target="_blank">
                Esempi di connessione con logica di controllo</a> su PHP.net (Esemi procedurali e OOP).</p>
    </div>
    
</body>
</html>