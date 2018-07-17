<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
</head>

<body>

<?php
	class io
		{
			  const NL="<br />";
					
					static public function linea($carattere, $quanti)
					{ return str_repeat($carattere, $quanti);}
					
					static public function saltaRighe($quanti)
					{ echo str_repeat(self::NL, $quanti); }
		}

  class Dado
		{
			 private $valoreAttuale=0, $numeroFacce=6,
				        $facciaTruccata=0, $quantoTruccata=0 ;
			
				public function __construct($numeroFacce)
				{ if($numeroFacce>0) $this->numeroFacce=$numeroFacce;}
			
			 public function setFacciaTruccata_Trucco($faccia, $trucco)
				{if ($faccia>0 && $faccia<$this->numeroFacce && $trucco>0)
				   $this->facciaTruccata = $faccia; $this->quantoTruccata = $trucco;}
				
			 public function lancia()
				{
					  $this->valoreAttuale = rand(1, $this->numeroFacce + $this->quantoTruccata);

					  if ($this->facciaTruccata>0  && $this->valoreAttuale>$this->numeroFacce)
							  $this->valoreAttuale = $this->facciaTruccata;
           							  
							return $this->valoreAttuale;
				}
				
				public function getValore()
				{return $this->valoreAttuale;}
		}
		
			
		class DadoNormale //superclasse, antenata, madre, base
		{
			 private $numeroFacce=6, $valoreAttuale=0 ;
				       
				public function __construct($numeroFacce)
				{ if($numeroFacce>0) $this->numeroFacce=$numeroFacce;
				  echo "chiamato!".io::NL;}
								
			 public function lancia()
				{

							$this->valoreAttuale = rand(1, $this->numeroFacce);          							  
							return $this->valoreAttuale;
				}
				
				 public function getValore()
				{return $this->valoreAttuale;}
		}

  class DadoTruccato extends DadoNormale //sottoclasse, figlia, derivata
		{
   
					
		}
		
		
class DadoTruc
	{
			 private $valoreAttuale=0, $numeroFacce=6,
				        $facciaTruccata=0, $quantoTruccata=0 ;
			
				public function __construct($numeroFacce, $facciaTruccata, $trucco)
				{ if($numeroFacce>0) $this->numeroFacce=$numeroFacce;
      				
				  if ($facciaTruccata<$this->numeroFacce && $trucco>0)
				  { $this->facciaTruccata = $facciaTruccata; $this->quantoTruccata = $trucco;}
				}
				
			 public function lancia()
				{
					  $this->valoreAttuale = rand(1, $this->numeroFacce + $this->quantoTruccata);

					  if ($this->valoreAttuale>$this->numeroFacce)
							  $this->valoreAttuale = $this->facciaTruccata;
           							  
							return $this->valoreAttuale;
				}
				
				public function getValore()
				{return $this->valoreAttuale;}
	}
		
		//$unDadoNormale = new DadoNormale(6);
		//$unDadoTruccato = new DadoTruc(6,3,10);
		$unDadoTruccato = new DadoTruccato(7, 4, 12); 
	
		for($lanci=1;$lanci<50;$lanci++)
		  echo $unDadoTruccato->lancia().io::NL;
		  ;//echo $unDadoNormale->lancia()." - ". $unDadoTruccato->lancia().io::NL;
	
				
?>














</body>
</html>
