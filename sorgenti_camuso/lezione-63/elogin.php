<?php
  session_start();

  $nl="<br />";

   //recupero credenziali da file ESTERNO alla cartella pubblica del sito
   $accessData=parse_ini_file('..\..\..\configDB.ini');
  
  //prima di tutto un po' di sicurezza ...
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    //ok la pagina è stata davvero richiamata dalla form
    
    //recupero il contenuto della textbox email
    $email = $_POST['email'];
    
    //... e quello della textbox password
    $psw = $_POST['password'];
    
    //1 stabilire una (o più) connessione/i con un server
    //NB: con @ si sopprimono i warning/errori del comando
    $conn = @mysqli_connect("localhost",$accessData['username'],$accessData['password']);
         
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
      "select iduser, psw from users where email ='" . mysqli_escape_string($conn, $email) ."'";
          
    //2 inviare il comando
    $risultatoRicercaEmail = @mysqli_query($conn, $comandoSQL);
 
     
    //quale bottone è stato premuto, 'accedi' o 'nuovo utente'?
    if (isset($_POST['btnAccedi']))
    {
              
     if ($risultatoRicercaEmail) //la query ha avuto successo
     {
       //3 elaborare il risultato
       if ($riga = mysqli_fetch_assoc($risultatoRicercaMail) ) //mail trovata, confrontiamo psw
       {
          //echo "Trovata".$nl;
          $autenticato = ($psw === $riga['psw']);                               
       }
       else
         $autenticato = false;
                    
       //4 chiudere la/le connessione/i
       mysqli_close($conn);
  
       //redirect
       if($autenticato)
       {
         $_SESSION['iduser']=$riga['iduser'];         
         header("Location: main.php");
       }
       else
         header("Location: login.php?errore=1");
         
       exit;
     }
     else //fallita mysqli_query
     {
      echo "Problemi con il server data base ...".$nl;
      echo mysqli_sqlstate( $conn ) . $nl;
      echo mysqli_errno( $conn ) . $nl;
      echo mysqli_error( $conn ) . $nl;
      die;  
     }
    }
    else
    {
      //BOTTONE NUOVO UTENTE
      if ( mysqli_fetch_assoc($risultatoRicercaEmail) )
      {
        mysqli_close($conn);
        header("Location: login.php?errore=2"); //email gia' presente
        exit;
      }
      
      //insert into users values (null, 'e@j.com','eee')
      $comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
      $esito = mysqli_query($conn, $comandoSQL);
        
      if ($esito)
      {
        $_SESSION['iduser'] = mysqli_insert_id( $conn );
        mysqli_close($conn);
        header("Location: main.php");
      }
      else
      {
        mysqli_close($conn);
        header("Location: login.php?errore=3"); //inserimento fallito
      }
     
      exit;
        
    }
}
else
{
  header("Location: login.php?errore=4"); //non autenticato
  exit; 
 
}
  
  
  
  

?>

</body>
</html>

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
<!--    $conn = new mysqli("localhost", "web_visitor", "007","quizmaker");
       
       $risultato = $conn->query($comandoSQL);
       
       while ($riga = $risultato->fetch_assoc() )
         echo "user: {$riga['email']}" .$nl;
       
       $conn->close();-->