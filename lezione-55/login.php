<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Login 1/2 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
    html, body {
            margin: 0px;
            padding: 0px;
    }

    body {
    	background-color: lightgreen;
        font-size: 100%;
        font-family: Arial, sans-serif;
        width: 100%;
	}

    form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
    
    #breadcrumb {
        background: #efefef;
        border-bottom: #afafaf 1px solid;
        margin: 0px;
        padding: 10px 10px;
    }

    pre, .codice {
        color: lightgrey;
        background-color: darkslategrey;
        border: black 1px solid;
        line-height: 2em;
        padding: 5px;
    }

    .codice {
        margin: 15px 0px;
    }
</style>
</head>

<body>
    <p id="breadcrumb">
        <a href="../index.php" title="indice delle lezioni">Indice</a> / <a href="../lezione-55-forms-e-dbms-4.php" title="lezione 55">Lezione 55</a> / login.php
    </p>

    <h1>Form di Login - login.php</h1>
    <p>La spiegazione di questo script (login.php) e quello a cui l'action del form rimanda (elogin.php) è riportata nella Lezione 55.</p>
    
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
    
    <h2>Codice del Form</h2>    
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
    
    <input type="submit" value="ACCEDI" />
    <input type="submit" value="NUOVO UTENTE" />
</form>
CODICE;

echo htmlspecialchars($codice);
?>
</pre>
</body>
</html>