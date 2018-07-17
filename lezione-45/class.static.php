<?php
class io{
    
    // Proprietà Public
    const NL = "<br />";
    
    // Metodo Public
    static function linea($carattere, $quanti)
    {
        return str_repeat($carattere, $quanti);
    }
    
    // Metodo Public
    static function saltaRighe($quanti)
    {
        echo str_repeat(self::NL, $quanti);
    }
}
?>