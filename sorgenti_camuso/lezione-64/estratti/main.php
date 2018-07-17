<?php
  session_start();
		if (  !isset($_SESSION['iduser']) )
		{
		  header("Location: login.php?errore=autenticazione_richiesta"); //user non autenticato
				exit;
		}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
</head>

<body>
Benvenuto!
<?php
  session_unset();
		session_destroy();
?>


</body>
</html>
