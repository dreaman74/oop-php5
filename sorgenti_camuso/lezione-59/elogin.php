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
    
    
    //quale bottone è stato premuto, 'accedi' o 'nuovo utente'?
    if (isset($_POST['btnAccedi']))
    {
        
         
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
       if ( @mysqli_select_db($conn, $accessData['dbname']) )
       {       
  
         $comandoSQL =
           "select iduser, psw from users where email ='" . mysqli_escape_string($conn, $email) ."'";
          
         //echo "Comando: ".$comandoSQL.$nl;
          
         //2 inviare il comando
         $risultato = @mysqli_query($conn, $comandoSQL);
       
         if ($risultato) //la mail e' stata trovata
         {
           //3 elaborare il risultato
           if ($riga = mysqli_fetch_assoc($risultato) ) //confrontiamo psw
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
             header("Location: login.html");
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
       else //fallita mysqli_select_db ...
       {
          echo "Non trovo il data base ...".$nl;
          echo mysqli_sqlstate( $conn ) . $nl;
          echo mysqli_errno( $conn ) . $nl;
          echo mysqli_error( $conn ) . $nl;
          die;
        
       }
    }
    else
    {
        //echo "Hai premuto NUOVO UTENTE";
    }
}  
  
  
  
  

?>

</body>
</html>

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
<!--    $conn = new mysqli("localhost", "web_visitor", "007","quizmaker");
       
       $risultato = $conn->query($comandoSQL);
       
       while ($riga = $risultato->fetch_assoc() )
         echo "user: {$riga['email']}" .$nl;
       
       $conn->close();-->