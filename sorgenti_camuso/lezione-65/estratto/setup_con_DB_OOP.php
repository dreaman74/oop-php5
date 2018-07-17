<?php
  include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup.php");

//la classe db è pensata per lavorare con un db specifico
//per cui se servisse cambiare database bisognerebbe istanziare un nuovo
//oggetto db
class db
{				
		private
		  $conn,														//riferimento alla connessione	
				$cartella_ini, 					//posizione file ini
				$messaggi_errore, 		//array associativo con i messaggi di errore
				$access_data,     		//credenziali lette da .ini
				$stato,           		//esito (true/false) dopo creazione oggetto o
																								//dopo aver tentato invio comando a mysQLL
				$descrizione_stato,	//il messaggio di errore eventualmente da stampare
				$stampa_errori,     //true / false
				$nl = "<br />"; 
  
		public function get_stato()
		{return $this->stato;}
		
		public function get_descrizione_stato()
		{return $this->descrizione_stato;}
		
		public function __construct($cartella_ini, $messaggi_errore, $stampa_errori=true)
		{
				//recupero credenziali da file ESTERNO alla cartella pubblica del sito
		  $this->accessData=parse_ini_file($cartella_ini.'\configDB.ini');
				
				//copio il riferimento all'array con i messaggi di errore
				$this->messaggi_errore = $messaggi_errore;
				
				//devono essere stampati gli errori o solo memorizzati in la descrizione stato?
				$this->stampa_errori = $stampa_errori;
				
				$this->connessione();
				
				if( $this->stato )
				  $this->scelta_data_base();
		}


	 private function connessione()
		{
  		if( !isset($this->conn) ) 
    {
      //NB: con @ si sopprimono i warning/errori del comando
      $this->conn = @mysqli_connect($this->accessData['host'],
						  																						$this->accessData['username'],
								  																				$this->accessData['password']);
         
      if(!$this->conn)
      {  
        $this->stato = false;
								$this->descrizione_stato = $this->messaggi_errore['connessione_fallita'];
								
								if($this->stampa_errori)
								  echo $this->messaggi_errore['connessione_fallita'].$nl; 
      }
						else
						  $this->stato = true;
			}
		}		
		
		private function scelta_data_base()
		{
     if ( !@mysqli_select_db($this->conn, $this->accessData['dbname']) )
     {							
								$this->stato = false;
								$this->descrizione_stato = $this->messaggi_errore['db_non_trovato'];
								
								if($this->stampa_errori)
								  echo $this->messaggi_errore['db_non_trovato'].$this->nl;							
      }
						else
						  $this->stato = true;										
		}
		
		
		public function sanifica_parametro($parametro)
		{ return mysqli_escape_string($this->conn, $parametro); }
		
//restituisce false in caso di problemi nell'esecuzione del comando
//oppure un array con le righe restituite da mysql
		public function select($query)
		{
    $risultato_query = mysqli_query($this->conn, $query);
	
    if($risultato_query === false)
				{
						$this->stato = false;
						$this->descrizione_stato = $this->messaggi_errore['problema_con_server'];
	
	     if($this->stampa_errori) 
	       echo $this->messaggi_errore['problema_con_server'].$this->nl;
						
						return false;
   
    }
				else
				{
						$this->stato = true;
						
				  $righe_estratte = array();  
      while ($riga = mysqli_fetch_assoc($risultato_query)) 
      {$righe_estratte[] = $riga;}
						
						return $righe_estratte;
				} 
 }
		
		public function insert($comandoSQL)
		{
     $esito = mysqli_query($this->conn, $comandoSQL);
					
					if($esito)
	    {
						$this->stato=true;
						return mysqli_insert_id( $this->conn );
					}
					else
					{
				   $this->stato = false;
						 $this->descrizione_stato = $this->messaggi_errore['problema_con_server'];
	
	      if($this->stampa_errori) 
	       echo $this->messaggi_errore['problema_con_server'].$this->nl;
								
					  return false;
					}
		}

  public function close()
		{ mysqli_close($this->conn);}
} // classe
?>











