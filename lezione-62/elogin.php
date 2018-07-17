<?php
include($_SERVER['DOCUMENT_ROOT'].'/miei_test/fcamuso/lezione-62/my_include/setup_con_DB.php');

// TEST per verificare il Corretto Caricamento dei File .INI ESTERNI
print_r($accessData);
echo $nl;
print_r($messaggi_errore);

exit;
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
        <a href="../index.php" title="indice delle lezioni">Indice</a> / <a href="../lezione-61-forms-e-dbms-10.php" title="lezione 61">Lezione 61</a> / 
        <a href="login.php" title="pagina del form - login.php">login.php</a> / elogin.php
    </p>

    <h1>Elaborazione Login - elogin.php</h1>
    <p>Questa pagina (elogin.php) processa i dati inviati tramite Metodo POST dalla pagina (login.php). La spiegazione del codice è riportata nella Lezione 61.</p>
    
    <hr />
    
    <div class="codice">
    <?php
    //prima di tutto un po' di sicurezza ...
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        //ok la pagina è stata davvero richiamata dalla form

        //recupero il contenuto della textbox email
        $email = $_POST['email'];

        //... e quello della textbox password
        $psw = $_POST['password'];

        //1 stabilire una (o più) connessione/i con un server
        //NB: con @ si sopprimono i warning/errori del comando
        //$db = @mysqli_connect("localhost",$accessData['username'],$accessData['password']);

        // Oggetto Connessione
        $db = @new mysqli($accessData['host'],$accessData['username'],$accessData['password']);

        if( $db->connect_error )
        {//gestione dell'errore

            echo $db->connect_errno . $nl;
            echo $db->connect_error . $nl;
            echo $db->sqlstate . $nl;
            echo "Connessione al server fallita. Impossibile procedere. Contattare ...";
            die;  
        }

        //2 selezionare il db con cui lavorare
        if ( ! @$db->select_db($accessData['dbname']) )
        {
          echo "Non trovo il data base ...".$nl;

          echo $db->sqlstate . $nl;
          echo $db->connect_errno . $nl;
          echo $db->connect_error . $nl;      
          die;       
        }

        $comandoSQL =
          "select iduser, psw from users where email ='" . mysqli_escape_string($db, $email) ."'";

        //2 inviare il comando
        $risultatoRicercaEmail = @$db->query($comandoSQL);

        //quale bottone è stato premuto, 'accedi' o 'nuovo utente'?
        if (isset($_POST['btnAccedi'])){

         if ($risultatoRicercaEmail) //la query ha avuto successo
         {
           //3 elaborare il risultato
           if ($riga = $risultatoRicercaEmail->fetch_assoc() ) //mail trovata, confrontiamo psw
           {
              //echo "Trovata".$nl;
              $autenticato = ($psw === $riga['psw']);                               
           }
           else
             $autenticato = false;

           //4 chiudere la/le connessione/i
           $db->close();

           //redirect
           if($autenticato){
            $_SESSION['iduser']=$riga['iduser'];         
            header("Location: main.php");
           }else
            header("Location: login.php?errore=1");
           
           // Blocca il parsing del codice dopo uno dei 2 redirect
           exit;
         }
         else //fallita mysqli_query
         {
            echo "Errore nell'esecuzione della query ".$nl;
            echo $db->sqlstate . $nl;
            echo $db->connect_errno . $nl;
            echo $db->connect_error . $nl;
            die;
         }
        }else{
          //BOTTONE NUOVO UTENTE
          if ( $riga = $risultatoRicercaEmail->fetch_assoc() )
          {
            $db->close();
            header("Location: login.php?errore=2"); //email gia' presente
            exit;
          }

          //insert into users values (null, 'e@j.com','eee')
          $comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
          $esito = $db->query($comandoSQL);

          if ($esito)
          {
            $_SESSION['iduser'] = mysqli_insert_id( $db );
            $db->close();
            header("Location: main.php");
          }
          else
          {
            $db->close();
            header("Location: login.php?errore=3"); //inserimento fallito
          }

          exit;
        }
    }else{
      header("Location: login.php?errore=4"); //non autenticato
      exit;
    }
    ?>
    </div>
</body>
</html>