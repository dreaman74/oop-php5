<?php
session_start();
?>
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
        <a href="../index.php" title="indice delle lezioni">Indice</a> / <a href="../lezione-59-forms-e-dbms-8.php" title="lezione 59">Lezione 59</a> / 
        <a href="login.php" title="pagina del form - login.php">login.php</a> / elogin.php
    </p>

    <h1>Elaborazione Login - elogin.php</h1>
    <p>Questa pagina (elogin.php) processa i dati inviati tramite Metodo POST dalla pagina (login.php). La spiegazione del codice è riportata nella Lezione 59.</p>
    
    <hr />
    
    <div class="codice">
    <?php
    $nl="<br />";

    // Recupero credenziali da file.ini ESTERNO alla cartella pubblica del sito
    // Percorso relativo rispetto alla htdocs (wwwroot)
    // Directory dove vengono salvati i file di PHP letti dal Server Apache
    $accessData=parse_ini_file('private\configDB.ini');

    //prima di tutto un po' di sicurezza ...
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //ok la pagina è stata davvero richiamata dalla form

        //recupero il contenuto della textbox email
        $email = $_POST['email'];

        //... e quello della textbox password
        $psw = $_POST['password'];


        //quale bottone è stato premuto, 'accedi' o 'nuovo utente'?
        if (isset($_POST['btnAccedi']))
        {


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
           if ( @mysqli_select_db($conn, $accessData['database']) )
           {

                // Stringa senza controllo
                // $comandoSQL = "select psw from users where email ='".$email."'";

                // Sanificazione della Stringa
                $comandoSQL = "SELECT iduser, psw FROM users WHERE email ='".mysqli_escape_string($conn, $email)."'";

                echo "Comando: ".$comandoSQL.$nl;

                //2 inviare il comando
                $risultato = @mysqli_query($conn, $comandoSQL);

                if ($risultato) //la mail e' stata trovata
                {
                 //3 elaborare il risultato
                 if ($riga = mysqli_fetch_assoc($risultato) ) //confrontiamo psw
                 {
                    //echo "Trovata".$nl;
                    $autenticato = ($psw === $riga['psw']); // Restituisce TRUE se psw del Form e del Database sono Identiche
                 }
                 else
                   $autenticato = false;

                 //4 chiudere la/le connessione/i
                 mysqli_close($conn);
                 
                 //echo "Autenticato: ".$autenticato.$nl;
                 
                 //redirect
                 if($autenticato)
                 {
                   $_SESSION['iduser']=$riga['iduser'];
                   
                    // Stampa ID di Sessione
                    //echo "Session ID: ".session_id().$nl;
                    //print_r($_SESSION);
                    //exit;
                 
                   header("Location: main.php"); // Redirect a main.php se Autenitcato TRUE
                 }
                 else
                   header("Location: login.php"); // Redirect al Login.php se Autenticato FALSE
             }
             else //fallita mysqli_query
             {
              echo mysqli_sqlstate( $conn ) . $nl;
              echo mysqli_errno( $conn ) . $nl;
              echo mysqli_error( $conn ) . $nl;            

             }
           }
           else //fallita mysqli_select_db ...
           {
              echo mysqli_sqlstate( $conn ) . $nl;
              echo mysqli_errno( $conn ) . $nl;
              echo mysqli_error( $conn ) . $nl;

           }
        }
        else
        {
            echo "Hai premuto NUOVO UTENTE";
        }
    }
    ?>
    </div>
</body>
</html>