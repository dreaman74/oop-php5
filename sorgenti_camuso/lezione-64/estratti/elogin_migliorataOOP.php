<?php
  include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup_con_DB_OOP.php");
  
  
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
    $db_quiz = new db($cartella_ini,$messaggi_errore, false);
    
    if (! $db_quiz->get_stato() )
      die;
      
    header("Location: main.php");
}
?>