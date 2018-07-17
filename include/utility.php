<?php
$nl = '<br />';
$trattini = str_repeat('-', 80);
$tantipiu = str_repeat('+', 80);

// Stampa un Array con Indici Numerici
function stampa($array, $nl='<br />', $trattini=''){
    foreach($array as $elemento)
        echo $elemento.$nl;
    echo $trattini.$nl;
}

// Stampa un Array con Indici Numerici
function stampa_ass($array, $nl='<br />', $tantipiu=''){
    foreach($array as $chiave => $elemento)
        echo "{$chiave}: $elemento.$nl";
    echo $tantipiu.$nl;
}

// Funzione che stampa le Table Data <td> dato un valore
function cellaTabella($valoreCella){
    echo '<td>'.$valoreCella.'</td>',"\n";
}
?>