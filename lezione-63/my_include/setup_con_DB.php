<?php
// Setup Standard
include($_SERVER['DOCUMENT_ROOT'].'/miei_test/fcamuso/lezione-63/my_include/setup.php');

// ---------- Funzione Gestione Database ----------
// ---------- Modello di Accesso ai Dati ----------
function db_connettiti($messaggi_errore){
    
    global $cartella_ini, $nl;
    
    // Recupero credenziali da file .INI
    $accessData=parse_ini_file($cartella_ini.'/configDB.ini');
    
    //1 stabilire una (o più) connessione/i con un server
    //NB: con @ si sopprimono i warning/errori del comando
    $conn = @mysqli_connect($accessData['host'],$accessData['username'],$accessData['password']);
    
    if(!$conn){
        // Errore di Connessione al Server MySQL
        die($messaggi_errore['connessione_fallita']);
    }
    
    // Seleziona il Database
    if(!@mysqli_select_db($conn, $accessData['dbname'])){
        echo $messaggi_errore['db_non_trovato'].$nl;
        echo mysqli_sqlstate($conn).$nl;
        echo mysqli_connect_errno($conn).$nl;
        echo mysqli_connect_error($conn).$nl;
        die;
    }
    
    return $conn;
}

function db_sanifica($conn, $stringa){
    return mysqli_escape_string($conn, $stringa);
}

function db_select($conn, $querySQL){
    
    global $nl;
    
    $risultato_query = @mysqli_query($conn, $querySQL); // REstituisce FALSE in caso di errore oppure un Result Set composto da 0, 1, 2, etc. records
    
    if($risultato_query === false){
        echo "Problemi con il Server MySQL...".$nl;
        echo mysqli_sqlstate($conn).$nl;
        echo mysqli_connect_errno($conn).$nl;
        echo mysqli_connect_error($conn).$nl;
        die;
    }
    
    $righe_estratte = array();
    while ($riga = mysqli_fetch_assoc($risultato_query)){ // Tramite l'iterazione salviamo in ogni elemento dell'Array una riga del Result Set
        $righe_estratte[] = $riga;
    }
    
    return $righe_estratte;
}

function db_insert($conn, $querySQL){
    $esito = mysqli_query($conn, $querySQL);
    
    if($esito)
        return mysqli_insert_id($conn); // Recupera l'ultimo ID creato dall'istanza della connessione attiva
    else
        return false;

}

function db_close($conn){
    mysqli_close($conn);
    //mysql_free_result($conn);
    //unset($conn);
}
?>