<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 57 - Login e registrazione: Gestione errori MySQL - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	html, body {
		margin: 0px;
		padding: 0px;
	}

    body {
    	/*background-color:#555555;*/
		font-size: 100%;
		font-family: Arial, sans-serif;
		width: 100%;
	}

    form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
        
	ol,ul{line-height:1.5em;}
	li {line-height: 3em;}
	li img {margin: 10px 0px;width: 100%;}
        p img {margin: 10px 0px;width: 100%;}
	
	h1 {margin: 10px 0px;}
	h2 {color:#ffffff;background-color:#224488;padding:5px;margin:10px 0px;}
	h3, h4, h5, h6 {margin: 10px 0px;}
        /* Dimensione Caratteri */
        h2, h3 {font-size:2em;}
        h4, h5 {font-size:1.5em;}
        h6 {font-size:1.2em;}
	
	p {line-height: 1.5em;margin:0px;padding:0px;}

	table, th, td {border-collapse:collapse;padding:5px;}
	th {border: 1px solid red;text-align:center;}
	td {border: 1px solid grey;text-align:center;}

	pre, .codice {
		background-color:#efefef;
		border:#aaaaaa 1px solid;
		line-height:2em;
		padding:5px;
	}
	
	.codice {
		margin: 15px 0px;
	}
        
	#breadcrumb {
		background:#efefef;
		border-bottom:#afafaf 1px solid;
		margin:0px;
		padding:10px 10px;
	}
		
	.celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
	.esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
        .black {color: lightgrey;background-color: #222222;}
        .black a {color: lightgreen;}
        
	.titolo_paragrafo {color:#224488;font-size:2.5em;}
	.sottotitolo_paragrafo {color:#44aaee;font-size:2em;}
	
	.box_giallo {background-color: yellow;margin:10px 0px;padding:5px;}
</style>
</head>

<body>
    <p id="breadcrumb">
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 57</strong>
    </p>

    <h1>[57] Login e registrazione: Gestione errori MySQL</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 6</b></p>
    
    <p class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione, 
        <a href="lezione-57/login.php" title="login e elogin con connessione DB" target="_blank">Clicca qui</a>
    </p>

    <h2>Argomenti trattati in questa lezione</h2>
    <ol>
        <li><p>Interpretare i codici di errore restituiti da MySql</p></li>
        <li><p>Sopprimere in modo selettivo i warning a video</p></li>
        <li>
            <p>Intercettare e gestire gli errori in modo soft:</p>
            <ul>
                <li><p>mysqli_connect_errno()</p></li>
                <li><p>mysqli_connect_error()</p></li>
                <li><p>mysqli_sqlstate()</p></li>
                <li><p>mysqli_errno()</p></li>
                <li><p>mysqli_error()</p></li>
            </ul>
        </li>
    </ol>

    <hr />

    <h2>Gestione degli errori</h2>

    <h3 class="sottotitolo_paragrafo">mysqli_connect</h3>
    <p>Connessione al Server MySQL, il nome del database 'quizmaker' sarà indicato successivamente con la funzione 'mysql_select_db'.</p>
<pre class="black">
    <p>$conn = mysqli_connect($host, $userDB, $pwdDB);</p>
</pre>
    
    <h4 class="sottotitolo_paragrafo">Warning</h4>
    <p>Nel caso di errore di Connessione al Server MySQL, vengono restituiti dei messaggi di errori (Warning) in base al tipo di eccezione.</p>
    
    <p style="margin: 10px 0px;"><b>Abbiamo 2 scenari:</b></p>
    <ol>
        <li>
            <h5>Host errato o Server MySQL non raggiungibile</h5>
            <p>Vengono definiti <b>Errori di tipo Client (Client Errors)</b>, tutti gli <b>errori di connessione tra client e server</b>.</p>
            <p>Server MySQL Spento, porta Host in conflitto con altro programma, nome $host errato, etc.</p>
<pre class="black" style="overflow: auto;">
<b>Warning:</b> mysqli_connect(): php_network_getaddresses: getaddrinfo failed: Host sconosciuto. in C:\webserver\www\miei_test\fcamuso\lezione-57\elogin.php on line 86

<b>Warning:</b> mysqli_connect(): (HY000/2002): php_network_getaddresses: getaddrinfo failed: Host sconosciuto. in C:\webserver\www\miei_test\fcamuso\lezione-57\elogin.php on line 86
</pre>
            <p>Elenco completo dei <a href="http://dev.mysql.com/doc/refman/5.7/en/error-messages-client.html" title="Errori del Client" target="_blank">Client Error Codes e Messages</a></p>
        </li>
        <li>
            <h5>Credenziali Utente MySQL errate</h5>
            
            <p>Vengono definiti <b>Errori di tipo Server (Server Errors)</b>, gli errori causati da una sintassi SQL non corretta, operazioni di modifica/cancellazione di una tabella del Database 
                non autorizzate per l'utente loggato, credenziali di accesso dell'utente errate, un'operazione impiega un tempo maggiore al timeout definito dall'administrator, etc.</p>

            <p style="margin: 10px 0px;">Alcuni esempi, di credenziali dell'Utente errate:</p>
            
            <h6>$userBD errata</h6>
<pre class="black" style="overflow: auto;">
<b>Warning:</b> mysqli_connect(): (HY000/1045): Access denied for user 'visitor'@'localhost' (using password: YES) in C:\webserver\www\miei_test\fcamuso\lezione-57\elogin.php on line 86
</pre>
            <h6>$pwdDB errata</h6>
<pre class="black" style="overflow: auto;">
<b>Warning:</b> mysqli_connect(): (HY000/1045): Access denied for user 'web_visitor'@'localhost' (using password: YES) in C:\webserver\www\miei_test\fcamuso\lezione-57\elogin.php on line 86
</pre>
            <p>Elenco completo dei <a href="http://dev.mysql.com/doc/refman/5.7/en/error-messages-server.html" title="Errori del Server" target="_blanl">Server Error Codes and Messages</a></p>
        </li>
    </ol>

    <h5>Spiegazione del Warning</h5>
    <ol>
        <li>
            <h6>(HY000/1045) - Codifica ANSI</h6>
            <ul>
                <li>
                    <p><b>HY000</b></p>
                    <p><b>SQLSTATE</b>, con questo termine il PHP fa riferimento alla <b>codifica ANSI</b>, uno standard per i protocolli, codici etc.. Purtroppo non tutti i codici di 
                    SQLSTATE corrispondono correttamente alla mappatura dello Standard ANSI, molte volte PHP restituisce dei codici generici comne questo HY000.</p>
                    
                    <p style="margin: 10px 0px;">Come leggere la codifica ANSI:</p>
                    <ul>
                        <li><b>HY</b> - i primi 2 caratteri definiscono la classe (<b>la categoria dell'errore</b>).</li>
                        <li><b>000</b> - le cifre restanti l'errore.</li>
                    </ul>
                </li>
                <li>
                    <p><b>1045</b></p>
                    <p>Codice di Errore, codificato in base ai codici di errore di MySQL. Meglio non basare la lettura degli errori in base a questo codice numerico, in quanto 
                        la mappatura potrebbe cambiare con una nuova versione di MySQL stesso oppure passando ad un Server DBMS diverso, restituendo un messaggio con 
                        un significato diverso.</p>
                </li>
            </ul>
        </li>
        <li>
            <h6>Stringa estesa</h6>
            <p>Access denied for user 'visitor'@'localhost'</p>
        </li>
    </ol>
    
    <hr />
    
    <h4 class="sottotitolo_paragrafo">Come sopprimere i Warning</h4>
    <p>Per sopprimere il Warning, <b>anteporre alla variabile che memorizza la connessione una @</b> (detta AT o A commerciale).</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
$conn = @mysqli_connect($host, $userDB, $pwdDB);
[...]
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>

    <p>In caso la <b>connessione non venga effettuata</b>, la variabile <b>$conn</b> conterrà <b>FALSE</b> (valore di ritorno restituito da PHP).</p>
    
    <p style="margin: 10px 0px;">Come <b>gestire</b> la variabile <b>$conn</b> con valore <b>FALSE</b>:</p>
    <div class="codice black">
    <ol>
        <li>$conn === false (Strict)</li>
        <li>!$conn === true (Strict)</li>
        <li>!$conn</li>
    </ol>
    </div>

    <p><b>Codice che segue illustra il controllo condizionale if con 3° metodo:</b></p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
if(!$conn){
  // 1045 - Errore Interno, NO ANSI
  //echo mysqli_connect_errno() . $nl;

  // Stringa estesa dell'Errore
  //echo mysqli_connect_error() . $nl;

  // SQLSTATE - Non possiamo utilizzarlo, in quanto dobbiamo avere una connessione attiva per recuperarlo
  //echo mysqli_sqlstate( $conn ) . $nl;

  // SOLUZIONE MIGLIORE: Personalizzare il messaggio
  echo "<b>Connessione al server fallita. Impossibile procedere. Contattare ...</b>";

  // Bloccare immediatamente l'esecuzione dello Script
  die; // oppure exit
}
[...]
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    <p><b>Ricordarsi</b> sempre di <b>bloccare immediatamente lo script</b>, con le key <b>die</b> o <b>exit</b>.</p>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">mysqli_select_db</h3>
    <p>Anche il comando <b>mysqli_select_db</b> <b>potrebbe fallire, restituendo FALSE</b>, per esempio passando un nome del database errato.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
       //2 selezionare il db con cui lavorare
       if ( @mysqli_select_db($conn, $nomeDB) )
       {
          // Database selezionato con suuccesso
       }
       else //fallita mysqli_select_db ...
       {
          echo mysqli_sqlstate( $conn ) . $nl;
          echo mysqli_errno( $conn ) . $nl;
          echo mysqli_error( $conn ) . $nl;

       }
    }
    else
    {
        echo "Hai premuto NUOVO UTENTE";
    }
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>

    <hr />
        
    <h3 class="sottotitolo_paragrafo">mysqli_query</h3>
    <p>Anche il comando '<b>mysqli_query</b>' <b>potrebbe fallire, restituendo FALSE</b>, a causa di una Query SQL sbagliata: errore nella sintassi, nelle variabili, 
    indicati nomi dei campi o tabelle errati, etc.</p>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
[...]
// Inivia Query SQL
// Connessione e selezione Database avvenuti con successo
    
         //2 inviare il comando
         $risultato = @mysqli_query($conn, $comandoSQL);

         if ($risultato)
         {
           //3 elaborare il risultato
           if ($riga = mysqli_fetch_assoc($risultato) ) //trovato, confrontiamo psw
           {
              echo "<p><b>Utente Trovato</b></p>";
              $autenticato = ($psw === $riga['psw']);                               
           }
           else
             $autenticato = false;

           //4 chiudere la/le connessione/i
           mysqli_close($conn);

           if($autenticato)
             echo "<p><b>OK, superato check ...</b></p>";
           else
            echo "Autenticazione fallita ...".$nl;
         }
         else //fallita mysqli_query
         {
          echo mysqli_sqlstate( $conn ) . $nl;
          echo mysqli_errno( $conn ) . $nl;
          echo mysqli_error( $conn ) . $nl;            

         }
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>

</body>
</html>