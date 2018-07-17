<?php
// Classe Madre, Classe Antenata, Classe Base, Classe Principale, Superclasse
class DadoNormale{

    // Stato Interno
    private $numeroFacce = 6, $valoreAttuale = 0 ;
    
    public function __construct($numeroFacce){
        if( $numeroFacce > 0 ) $this->numeroFacce = $numeroFacce ;
        
        // Stampa a video il messaggio
        echo '<b>Metodo __construct() eseguito</b>'; io::saltaRighe(2);
    }
    
    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce);
        return $this->valoreAttuale;
    }
    
    public function getValore(){
        return $this->valoreAttuale;
    }
}
?>