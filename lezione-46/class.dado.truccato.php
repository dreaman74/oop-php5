<?php
class DadoTruccato{
    
    // Stato Interno (Proprietà - Variabili Membro)
    private $valoreAttuale = 0, $numeroFacce = 6,
            $facciaTruccata = 0, $quantoTruccata = 0 ;
    
    // Costruttore
    public function __construct($numeroFacce) {
        if($numeroFacce>0) $this->numeroFacce=$numeroFacce;
    }
    
    public function setFacciaTruccata_Trucco($faccia, $trucco){
        if ($faccia>0 && $faccia<=$this->numeroFacce && $trucco>0){
            $this->facciaTruccata = $faccia;
            $this->quantoTruccata = $trucco;
        }
    }
    
    public function lancia(){
        // rand(x, y) > Restituisce un numero intero casuale prelevato in un range che va da x a y compresi
        $this->valoreAttuale = rand(1, $this->numeroFacce + $this->quantoTruccata);
        
        if ( $this->facciaTruccata > 0 && ($this->valoreAttuale > $this->numeroFacce) )
            $this->valoreAttuale = $this->facciaTruccata;
        
        return $this->valoreAttuale;
    }
    
    public function getValore(){
        return $this->valoreAttuale;
    }
    
}
?>