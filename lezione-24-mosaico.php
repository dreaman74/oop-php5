<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 24 - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body {font-size:100%;}
	ol,ul{line-height:1.5em;}
	p {margin:0px;}
	pre {
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
	table, th, td {border-collapse:collapse;}
	td {border:1px solid red;padding:0px;}
	img {border-width:0px;margin:0px;padding:0px;width:145px;height:223px;}
</style>
</head>
<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 24</strong>
	</p>
	
	<h1>Mosaico di immagini con Zoom</h1>
	<p>Immagini del mosaico contenute nella cartella <a href="lezione-24" title="immagini del mosaico">lezione-24</a></p>
	
	<h2>glob()</h2>
	<p style="margin-bottom:10px;">
		<a href="http://php.net/manual/en/function.glob.php" title="PHP.net - Funzione glob()">
		http://php.net/manual/en/function.glob.php</a>
	</p>
	<p>La funzione <b>glob()</b> pu&ograve; sostituire quella di <b>opendir()</b> e restituisce:
	<ol>
		<li><b>un Array</b>, con indice numerico [0,1,2,3], che contiene i files e le directories che corrispondono al pattern;</li>
		<li><b>un Array vuoto</b>, se non trova nulla;</li>
		<li><b>FALSE</b>, in caso di errore.</li>
	</ol>
	</p>
	<p>La funzione glob accetta 2 Argomenti:
	<ul>
		<li>1&deg; Argomento &egrave; una stringa con il <b>pattern CASE SENSITIVE</b>, dei file/directory da restituire;</li>
		<li>2&deg; Argomento [opzionale] FLAG, validi:
			<ul>
				<li>GLOB_MARK - Adds a slash to each directory returned</li>
				<li><b>GLOB_NOSORT</b> - Return files as they appear in the directory (no sorting).<br />
					<b>When this flag is not used, the pathnames are sorted alphabetically</b>;</li>
				<li>GLOB_NOCHECK - Return the search pattern if no files matching it were found;</li>
				<li>GLOB_NOESCAPE - Backslashes do not quote metacharacters;</li>
				<li>GLOB_BRACE - Expands {a,b,c} to match 'a', 'b', or 'c';</li>
				<li>GLOB_ONLYDIR - Return only directory entries which match the pattern;</li>
				<li>GLOB_ERR - Stop on read errors (like unreadable directories), by default errors are ignored.</li>
			</ul>
		</li>
	</ul>	
	</p>
	
	<hr />
	
	<h2>ESEMPIO</h2>
	<h3>Come visualizza files e directories presenti in una cartella</h3> 
	<p>Cartella di esempio: <a href="lezione-24" title="cartella lezione-24">lezione-24</a></p>
	<h4>Visualizzato nel browser</h4>
	<?php
	// Crea Array con indice a chiave numerica
	$elencoJPG = glob("lezione-24/*.jpg");
	
	// INIZIO - TABELLA CON LE IMMAGINI
	echo'<table>';
	for($miniatura=0; $miniatura<count($elencoJPG);){
		echo"<tr>\n"; // Apre la riga		
			for ($suQuestaRiga=0;
				 $suQuestaRiga<6 && $miniatura<count($elencoJPG);
				 $miniatura++,$suQuestaRiga++)
				
				echo "<td><img id=\"cella-$miniatura\" src=\"$elencoJPG[$miniatura]\" 
			 	onmouseover='zoom(this,290,446);' onmouseout='zoom(this,145,223);' /></td>\n";
		echo"</tr>\n"; // Chiude la riga
	}
	echo'</table>';
	// FINE - TABELLA CON LE IMMAGINI
	
	echo '<h4>Contenuto dell\'Array $elencoJPG</h4>';
	echo'<pre>';
	echo'TOTALE FILE/DIRECTORY: '.count($elencoJPG).'<br />';
	print_r($elencoJPG);
	echo'</pre>';	
	?>
	
	<h4>Codice</h4>
	<?php 
$codice=<<<'CODICE'
// Crea Array con indice a chiave numerica
$elencoJPG = glob("lezione-24/*.jpg");
	
// INIZIO - TABELLA CON LE IMMAGINI
echo'<table>';
for($miniatura=0; $miniatura<count($elencoJPG);){
	echo"<tr>\n"; // Apre la riga		
		for ($suQuestaRiga=0;
			$suQuestaRiga<6 && $miniatura<count($elencoJPG);
			$miniatura++,$suQuestaRiga++)
				
		echo "<td><img id=\"cella-$miniatura\" src=\"$elencoJPG[$miniatura]\" 
		onmouseover='zoom(this,290,446);' onmouseout='zoom(this,145,223);' /></td>\n";
	echo"</tr>\n"; // Chiude la riga
}
echo'</table>';
// FINE - TABELLA CON LE IMMAGINI
CODICE;

	echo "<pre>".htmlspecialchars($codice)."</pre>";
	?>
	
<script type="text/javascript">
// ZOOM sulle Immagini
// Script da inserire nella sezione HEAD o alla fine del Body
function zoom(image,width,height){
	image.style.width=width+'px';
	image.style.height=height+'px';
}
</script>
</body>
</html>