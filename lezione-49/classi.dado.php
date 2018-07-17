<?php
include("class.static.php");

// Classe Madre
class dadoNormale {

    // Stato Interno
    // Rendo le variabili membro visibili alla classe madre 
    // e a quelle che erditano da essa
    protected $numeroFacce = 6, $valoreAttuale = 0 ;

    public function __construct($numeroFacce){
        if($numeroFacce>0) $this->numeroFacce = $numeroFacce ;
    }

    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce);
        return $this->valoreAttuale;
    }
}

class dadoTruccato extends dadoNormale{

    // Stato Interno
    private $facciaTruccata = 0, $quantoTruccata = 0 ;
    
    function __construct($numeroFacce, $facciaTruccata, $trucco){
        // Invoco il metodo della classe madre
        parent::__construct($numeroFacce);
        
        if($facciaTruccata<$this->numeroFacce && $trucco>0){
            $this->facciaTruccata = $facciaTruccata;
            $this->quantoTruccata = $trucco;
        }
    }
    
    // Override del metodo lancia() della classe madre
    // L'oggetto eseguirà questo metoto
    public function lancia(){
        $this->valoreAttuale = rand(1, $this->numeroFacce + $this->quantoTruccata);
        
        if($this->valoreAttuale > $this->numeroFacce)
            $this->valoreAttuale = $this->facciaTruccata;
            
        return $this->valoreAttuale;
    }
}
?>