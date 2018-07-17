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
    //$db = @mysqli_connect("localhost",$accessData['username'],$accessData['password']);
    
    $db = @new mysqli("localhost",$accessData['username'],$accessData['password']);     
    
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
    if (isset($_POST['btnAccedi']))
    {
              
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
      echo "Errore nell'esecuzione della query ".$nl;
      echo $db->sqlstate . $nl;
      echo $db->connect_errno . $nl;
      echo $db->connect_error . $nl;            
      die;  
     }
    }
    else
    {
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
}
else
{
  header("Location: login.php?errore=4"); //non autenticato
  exit; 
 
}
  
  
  
  

?>

</body>
</html>

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
<!--    $db = new mysqli("localhost", "web_visitor", "007","quizmaker");
       
       $risultato = $db->query($comandoSQL);
       
       while ($riga = $risultato->fetch_assoc() )
         echo "user: {$riga['email']}" .$nl;
       
       $db->close();-->