<?php
  include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup_con_DB_OOP2.php");
  
  
  //prima di tutto un po' di sicurezza ...
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
	  
    //ok la pagina è stata davvero richiamata dalla form
    
    //recupero il contenuto della textbox email
    $email = $_POST['email'];
    
    //... e quello della textbox password
    $psw = $_POST['password'];
    
    //istanziamo un oggetto db
    //(connessione e scelta del db saranno automatiche)
    $db_quiz = new db($cartella_ini,$messaggi_errore, true);
    
    if (! $db_quiz->get_stato() )
      die;

    $comandoSQL =
      "select iduser, psw from users where email ='" . $db_quiz->sanifica_parametro($email) ."'";
    
    //2 inviare il comando e memorizzare il risultato
    $righe_estratte = $db_quiz->select($comandoSQL);
    
    if ($righe_estratte===false) //problema nell'esecuzione del comando
    {
       echo $db_quiz->get_descrizione_stato().$nl;
       echo "... mentre stavo eseguendo: ".$comandoSQL.$nl;
       die;
    }
    
    //quale bottone è stato premuto, 'accedi' o 'nuovo utente'?
    if (isset($_POST['btnAccedi']))
    {
       
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

    }
    else
    {
      //BOTTONE NUOVO UTENTE
      
      if ( count($righe_estratte)>0 )
      {
        $db_quiz ->close();
        header("Location: login.php?errore=email_gia_inserita");
        exit;
      }
      
      //insert into users values (null, 'e@j.com','eee')
      $comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
      $esito = $db_quiz->insert($comandoSQL);
        
      if ($esito)
      {
        $_SESSION['iduser'] = $esito;
        $db_quiz->close();
        header("Location: main.php");
      }
      else
      {
        $db_quiz->close();
        header("Location: login.php?errore=inserimento_fallito"); //inserimento fallito
      }
     
      exit;
        
    }
}
else
{
  header("Location: login.php?errore=autenticazione_richiesta"); //non autenticato
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