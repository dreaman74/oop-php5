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
        <a href="../index.php" title="indice delle lezioni">Indice</a> / <a href="../lezione-57-forms-e-dbms-6.php" title="lezione 57">Lezione 57</a> / 
        <a href="login.php" title="pagina del form - login.php">login.php</a> / elogin.php
    </p>

    <h1>Elaborazione Login - elogin.php</h1>
    <p>Questa pagina (elogin.php) processa i dati inviati tramite Metodo POST dalla pagina (login.php). La spiegazione del codice è riportata nella Lezione 57.</p>
    
    <hr />
    
    <div class="codice">
    <?php
    $nl="<br />";

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

           $comandoSQL =
              "select psw from users where email ='" . $email ."'";
           
           $host    = "localhost";
           $userDB  = "web_visitor"; // web_visitor - visitor
           $pwdDB   = "007";
           $nomeDB  = "quizmaker";
           
           // Stampo a Video la variabili per la stringa di Connessione al Server MySQL

           //1 stabilire una (o più) connessione/i con un server
           //NB: con @ si sopprimono i warning/errori del comando
           $conn = @mysqli_connect($host, $userDB, $pwdDB);

           if(!$conn)
           {//gestione dell'errore

              //echo mysqli_connect_errno() . $nl;
              //echo mysqli_connect_error() . $nl;
              //echo mysqli_sqlstate( $conn ) . $nl;
              echo "<b>Connessione al server fallita. Impossibile procedere. Contattare ...</b>";
              die;  
           }

           //2 selezionare il db con cui lavorare
           if ( @mysqli_select_db($conn, $nomeDB) )
           {       
             //2 inviare il comando
             $risultato = @mysqli_query($conn, $comandoSQL);

             if ($risultato)
             {
               //3 elaborare il risultato
               if ($riga = mysqli_fetch_assoc($risultato) ) //trovato, confrontiamo psw
               {
                  echo "<p><b>Utente Trovato</b></p>";
                  $autenticato = ($psw === $riga['psw']);                               
               }
               else
                 $autenticato = false;

               //4 chiudere la/le connessione/i
               mysqli_close($conn);

               if($autenticato)
                 echo "<p><b>OK, superato check ...</b></p>";
               else
                echo "Autenticazione fallita ...".$nl;
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