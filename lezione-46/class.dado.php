<?php
class Dado{
    
    // Stato Interno (Proprietà - Variabili Membro)
    private $valoreAttuale = 0, $numeroFacce = 6;
    
    public function __construct($numeroFacce) {
        if($numeroFacce>0) $this->numeroFacce=$numeroFacce;
    }
    
    public function lancia(){
        // rand(x, y) > Restituisce un numero intero casuale prelevato in un range che va da x a y compresi
        $this->valoreAttuale = rand(1, $this->numeroFacce);
        return $this->valoreAttuale;
    }
    
    public function getValore(){
        return $this->valoreAttuale;
    }
    
}    
?>