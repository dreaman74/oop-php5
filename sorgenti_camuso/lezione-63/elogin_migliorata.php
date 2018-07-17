<?php
  include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup_con_DB.php");
  
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
    $conn = db_connettiti($messaggi_errore);
    
    $comandoSQL =
      "select iduser, psw from users where email ='" . db_sanifica_parametro($conn, $email) ."'";
    
    //2 inviare il comando e memorizzare il risultato
    $righe_estratte = db_select($conn, $comandoSQL);
      
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
       db_close($conn);
  
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
        db_close($conn);
        header("Location: login.php?errore=email_gia_inserita");
        exit;
      }
      
      //insert into users values (null, 'e@j.com','eee')
      $comandoSQL = "insert into users values (null,'".$email."','".$psw."')";
      $esito = db_insert($conn, $comandoSQL);
        
      if ($esito)
      {
        $_SESSION['iduser'] = $esito;
        db_close($conn);
        header("Location: main.php");
      }
      else
      {
        db_close($conn);
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