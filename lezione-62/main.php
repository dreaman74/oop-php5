<?php
session_start();

$nl = "<br />";

//echo "Session ID: ".session_id().$nl.$nl;
//foreach ($_SESSION as $chiave => $valore){
//    echo "\$_SESSION['$chiave'] => ($valore)",$nl;
//}
//exit;

if ( !isset($_SESSION['iduser']) ) header("Location: login.php?errore=4");
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Main di Login - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
        <a href="../index.php" title="indice delle lezioni">Indice</a> / <a href="../lezione-61-forms-e-dbms-10.php" title="lezione 61">Lezione 61</a> /
        <a href="login.php" title="pagina del form - login.php">login.php</a> / main.php
    </p>

    <h1>MAIN - main.php</h1>
    <p>Questa pagina (elogin.php) processa i dati inviati tramite Metodo POST dalla pagina (login.php). La spiegazione del codice è riportata nella Lezione 61.</p>
    
    <hr />
    
    <div class="codice">
    Benvenuto!
    <?php
    # LOG-OUT Automatico - Cancella Session #
    
    // Annulla tutti i valori delle Variabili Session
    // azzernado tutte le chiavi dell'Array collegato alla sessione utente
    session_unset();

    // Distrugge la Sessione
    session_destroy();
    ?>
    </div>
</body>


</body>
</html>
