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
</style>
</head>

<body>
    <p id="breadcrumb">
        <a href="../index.php" title="indice delle lezioni">Indice</a> / <a href="../lezione-55-forms-e-dbms-4.php" title="lezione 55">Lezione 55</a> / 
        <a href="login.php" title="pagina del form - login.php">login.php</a> / elogin.php
    </p>

    <h1>Elaborazione Login - elogin.php</h1>
    <p>Questa pagina (elogin.php) processa i dati inviati tramite Metodo POST dalla pagina (login.php). La spiegazione del codice è riportata nella Lezione 55.</p>
    
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
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $pagina == 'login.php' && $host == 'localhost:8080'){
        
        // OK La pagina è stata richiamata dalla Form 'login.php' di 'localhost:8080'
        // echo('Controllo OK');
        
        // Recupero i dati ricevuti dagli input text 'email' e 'password'
        $email = $_POST['email'];
        $psw = $_POST['password'];

        // Quale Submit è stato premuto 'accedi' o 'nuovo utente'?        
        if(isset($_POST['btnAccedi'])){
            // echo "Hai premuto ACCEDI";
            $comandoSQL = "SELECT psw FROM users WHERE email='$email'";
            echo $comandoSQL;
        }else{
            echo "Hai premuto NUOVO UTENTE";
        }
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
</body>
</html>