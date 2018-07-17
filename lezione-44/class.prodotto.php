<?php
class Prodotto{
    
    // STATO INTERO
    // Blocco di codice che racchiude tutte le Proprietà (variabili membro) della classe
    private $nome = 'Occhiali',
            $prezzo = 12.5,
            $iva = 22,
            $validoFinoAl = "2016-10-10",
            $prezzoBloccato = false; // true (non modifica prezzo) false (modifica prezzo)

    // METODI Getter e Setter
    
    // Restituisce true se l'offerta non è scaduta, confronto tra data odierna e $validoFinoAl
    // se scaduta -1
    private function prezzoValido(){
        if( date("Y-m-d") <= $this->validoFinoAl )
            return true;
        else
            return false;
    }
    
    // Restituisce -1 se il prezzo non è più valido
    // altrimenti restituisce il valore di $prezzo
    public function getPrezzo(){
        if( $this->prezzoValido() )
            return "$this->prezzo euro (valida sino al $this->validoFinoAl)";
        else
            return false;
    }
    
    public function setPrezzo($nuovoPrezzo, $nuovaDataValidita){
        if( !$this->prezzoBloccato && $nuovaDataValidita>=date("Y-m-d") )
            $this->prezzo = $nuovoPrezzo;
    }
    
    public function stampa(){
        // Esempio di concatenamento e interpolazione delle proprietà
        echo date("d-m-Y")." - Scheda Prodotto di <b>$this->nome</b><br/>"; //.io::$nl;
        echo io::linea("-", 70).io::NL;
        echo "[Offerta valida sino al $this->validoFinoAl]".io::NL;
        echo "PREZZO: $this->prezzo".io::NL;
        echo "IVA: $this->iva%".io::NL;
        echo io::linea("-", 70).io::NL;
    }
}
?>