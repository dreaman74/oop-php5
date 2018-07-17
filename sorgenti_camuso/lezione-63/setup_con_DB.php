<?php
  include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup.php");
		
	 function db_connettiti($messaggi_errore)
		{
  		global $cartella_ini;
				
				//recupero credenziali da file ESTERNO alla cartella pubblica del sito
		  $accessData=parse_ini_file($cartella_ini.'\configDB.ini');


    //1 stabilire una (o più) connessione/i con un server
    //NB: con @ si sopprimono i warning/errori del comando
    $conn = @mysqli_connect("localhost",$accessData['username'],$accessData['password']);
         
    if(!$conn)
    {//gestione dell'errore     
        echo $messaggi_errore['connessione_fallita']; 
        die;  
     }
       
    //2 selezionare il db con cui lavorare
    if ( !@mysqli_select_db($conn, $accessData['dbname']) )
    {
      echo $messaggi_errore['db_non_trovato'].$nl;
      echo mysqli_sqlstate( $conn ) . $nl;
      echo mysqli_errno( $conn ) . $nl;
      echo mysqli_error( $conn ) . $nl;
      die;       
    }
				
				return $conn;			
		}
		
		function db_sanifica_parametro($conn, $parametro)
		{
			  return mysqli_escape_string($conn, $parametro);
		}
		
		function db_select($conn, $query)
		{
    $risultato_query = mysqli_query($conn, $query);

    if($risultato_query === false) {
      echo "Problemi con il server data base ...".$nl;
      echo mysqli_sqlstate( $conn ) . $nl;
      echo mysqli_errno( $conn ) . $nl;
      echo mysqli_error( $conn ) . $nl;
      die;  
    }

				$righe_estratte =array();  
    while ($riga = mysqli_fetch_assoc($risultato_query)) {
        $righe_estratte[] = $riga;
    }
 
			 return $righe_estratte;
  }
		
		function db_insert($conn, $comandoSQL)
		{
     $esito = mysqli_query($conn, $comandoSQL);
					
					if($esito)
	     return mysqli_insert_id( $conn );
					else
					  return false;
		}

  function db_close($conn)
		{
			  mysqli_close($conn);
		}
?>
