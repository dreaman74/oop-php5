<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 55 - Progettiamo la logica della form di login / registrazione - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
	h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;margin:10px 0px;}
	h3, h4, h5, h6 {margin: 10px 0px;}
	
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
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 55</strong>
    </p>

    <h1>[55] Progettiamo la logica della form di login / registrazione</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 4</b></p>

    <h2>Argomenti trattati in questa lezione</h2>
    <ol>
        <li>Markup HTML del form di <a href="#login">login.php</a></li>
        <li>La pagina <a href="#elogin">elogin.php</a> che elabora i dati inviati con il form</li>
        <li><a href="#connessione-db">Connettersi al Database</a>:</b> Differenze tra PDO e Librerie dideciate.</li>
    </ol>

    <hr />
    
    <h2>Il Form di Login / Registrazione</h2>
    <h3 class="codice black" style="font-weight: normal;text-align: center;">Per provare l'applicazione, <a href="lezione-55/login.php" title="login con 2 pagine" target="_blank">Clicca qui</a></h3>
    <p style="text-align: center;"><img src="lezione-55/form-login.png" alt="schermata del form di login /registrazione" style="width: 60%;"/></p>
    <ul>
        <li>
            <p>Compilando i campi 'email' ed 'password', ed in seguito, <b>cliccando su 'NUOVO UTENTE'</b>, 
                lo script prima controllerà nel Database la presenza di un record contenente l'email inserita:</p>
            <ol>
                <li><p>Se non viene restituita la tupla, procederà ad a creare un nuovo record (nuovo utente);</p></li>
                <li><p>In caso di occorrenze, la procedura sarà arrestata.</p></li>
            </ol>
        </li>
        <li>
            <p>Invece, <b>cliccando sul 'ACCEDI'</b> verrà effettuato il Login:</p>
            <ol>
                <li><b>Solo se l'email e la password sono presenti nello stesso recordset.</b></li>
                <li>Diversamente, verrà visualizzato un messaggio di errore.</li>
            </ol>
        </li>
    </ul>
    
    <p class="codice"><b>Connessione al Database</b>: Utilizzeremo due metodi per connetterci al Database: prima utilizzando la libreria <b>mysqli</b> e, successivamente, il <b>PDO</b> (PHP Data Objects).</p>
    <p class="codice"><b>Implementazione:</b> Utilizzeremo 2 metodi, uno con 2 pagine (una per il form e l'altra che elabora i dati con la risposta) e l'altro 
        con lo schema ad 1 pagina (che distingue i due momenti).</p>
    
    <hr />
    
    <h2 id="due-pagine">Metodo con 2 Pagine</h2>
    <p>Il form utilizza il metodo POST per inviare le query alla pagina elogin.php che processerà la richiesta.</p>
    <p style="margin: 10px 0px;">Sotto è riportato il nome delle pagine e l'ordine con il quale vengono richiamate:</p>
    <div class="codice">
        <ol>
            <li>lezione-55/<b>login.php</b></li>
            <li>lezione-55/<b>elogin.php</b></li>
        </ol>
    </div>

    <h3 id="login" class="esempio">Form</h3>
    <p>La pagina <b>login.php</b> contenente il form</p>
    
    <h4>Codice</h4>    
<pre>
<?php
$codice = <<< 'CODICE'
<form name="login" action="elogin.php" method="post">
    <table>
        <tr>
            <td>Email: </td>
            <td> <input type="email" name="email" value="" /></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td> <input type="password" name="password" value="" autocomplete="off" /></td>
        </tr>
    </table>
    
    <input type="submit" name="btnAccedi" value="ACCEDI" />
    <input type="submit" name="btnNuovo" value="NUOVO UTENTE" />
</form>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
    
    <h3 id="elogin" class="esempio">Pagina che processa i dati inviati dal form</h3>
    <p>La pagina <b>elogin.php</b></p>
    
    <h4>Codice</h4>
<pre>
<?php
$codice = <<< 'CODICE'
<?php
$nl = "<br />";

if(isset($_SERVER['HTTP_REFERER'])){
    $host = $_SERVER['HTTP_HOST'];
    $uri = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    $pagina = substr($uri, strrpos($uri, '/')+1);
}

// Prima di tutto un po' di controllo sui dati in ingresso
if($_SERVER['REQUEST_METHOD'] == 'POST' && $pagina == 'login.php' && $host == 'localhost:8080'){

    // OK La pagina è stata richiamata dalla Form 'login.php' di 'localhost:8080'
    // echo('Controllo OK');
        
        // Recupero i dati ricevuti dagli input text 'email' e 'password'
        $email = $_POST['email'];
        $psw = $_POST['password'];

        // Quale Submit è stato premuto 'accedi' o 'nuovo utente'?        
        if(isset($_POST['btnAccedi'])){
            // echo "Hai premuto ACCEDI";
            $comandoSQL = "SELECT psw FROM users WHERE email='$email'";
            echo $comandoSQL;
        }else{
            echo "Hai premuto NUOVO UTENTE";
        }
}
?>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>

<hr />

<h2 id="connessione-db" class="celeste">Connettersi al Database: Differenza tra PDO e Librerie</h2>
<h3 class="sottotitolo_paragrafo">PDO</h3>
<p>Con il PDO si ha un metodo unico che ci consente di interfacciarci a tutti i Database. Bisogna solo istanziare un oggetto PDO che ci permetta di connetterci al Database, 
    il gestore cambia in base al Server DBMS. Invece, i metodi dell'oggetto PDO istanziato che ci permettono di interagire con i Database sono identici 
    a prescindere dal Server DBMS utilizzato. 
per </p>

<h3 class="sottotitolo_paragrafo">Librerie dedicate</h3>
<p style="margin: 10px 0px;">Diversamente, non utilizzando i PHP Data Objects (vedi la libreria MySQLi dedicata al Server MySQL), dobbiamo accettare il fatto di adattare sia il gestore 
    in relazione al Server DBMS sia i comandi per interagire con il Database. Con le librerie possiamo utilizzare l'approccio procedurale
    , ci permettono di connetterci e manipolare i database usenza conoscere la programmazione OOP che 
con i PDO è fondamentale.</p>

<h3 class="sottotitolo_paragrafo">Prestazioni</h3>
<p><b>Il PDO offre prestazioni inferiori.</b> Le classi PDO utilizzano dei metodi unificati per interagire con i Database che supportano i PHP Data Objects.<br />
    <b>L'utilizzo di librerie appositamente scritte (vedi MySQLi per il Server MySQL) permette prestazioni migliori.</b></p>

<h3 class="sottotitolo_paragrafo">Hacking</h3>
<p><b>Il PDO permette nativamente di avere una maggiore sicurezza verso attacchi di Hacking*, rendendo i nostri database meno esposti.</b></p>
<p style="margin: 10px 0px;">Quindi <b>usare le librerie significa esporre i nostri database</b> ad attacchi malevoli? <b><u>NO</u>, è possibile proteggereci 
        adottando tecniche manuali di sanificazione delle query in ingresso.</b> Con le prossime lezioni, vedremo alcuni metodi per proteggerci da alcuni attacchi.</p>
<p style="background-color: yellow;margin: 10px 0px;padding: 5px;">* <b>Hacking</b>: Per esempio l'<b>SQL Injection</b>, tecnica che i cracker adoperano per entrare 
    nei nostri database tramite l'inserimento di stringhe SQL nei form, al fine di modificare, prelevare e cancellare i dati del Database.</p>

</body>
</html>