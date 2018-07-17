<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 37 - Array - Esercizio Form Hobby - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	body,html {font-size:100%;}
	ol,ul{line-height:1.5em;}
	
        h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;}
        p {margin:0px;padding:0px;}
	
        pre {
	background-color:#efefef;
	border:#aaaaaa 1px solid;
	line-height:2em;
	padding:5px;
	}
        
	table, th, td {border-collapse:collapse;padding:5px;}
	th {border: 1px solid red;text-align:center;}
	td {border: 1px solid grey;text-align:center;}
        
        .celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
        .esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
        
        form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
</style>
</head>

<body>
	<p style="background:#efefef;border-bottom:#afafaf 1px solid;margin:10px 0px; padding:10px 10px;">
		<a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 37</strong>
	</p>
	
	<h1>[37] Array - Esercizio Form Hobby - parte 4 di 8</h1>
        
        <h2>Esercizio - Seleziona Hobbies</h2>
        <?php
        $nl = "<br />";

        // ---------- Inizio - VISUALIZZA FORM <text> HOBBIES ----------
        // Specifica quanti elementi <input> di tipo 'text' stampare
        $elementi_text = 10;
        
        echo '<h3 class="esempio">Inserisci i tuoi Hobbies</h3>',"\n";
        echo '<form method="post">',"\n";
            echo '<ol>',"\n";
                // attributo 'name' usare:
                // hobby[] (autoincremento dell'indice numerico) o
                // hobby[$i] (specificazione esplicita dell'indice numerico)
                for($i=0; $i<$elementi_text; $i++){
                    echo "<li><input type=\"text\" id=\"input-hobby-($i+1)\" name=\"hobby[$i]\" ";
                    if(isset($_POST['hobby'])&&strlen($_POST['hobby'][$i]))echo"value=\"{$_POST['hobby'][$i]}\"";
                    echo "placeholder=\"Inserisci un hobby\" maxlength=\"50\" /></li>\n";
                    
                }
            echo '</ol>',"\n";
            
            echo '<input type="submit" id="submit-form" name="invia_form" value="Invia" /> ',"\n";
            echo '<input type="reset" id="reset-form" name="reset_form" value="Ripristina" />',"\n";
        echo '</form>',"\n";
        // ---------- Fine - VISUALIZZA FORM HOBBIES ----------
        
        // ---------- Inizio - VISUALIZZA FORM <checkbox> HOBBIES ----------
        if(isset($_POST['hobby'])){
            echo '<h3 class="esempio">i Tuoi Hobbies:</h3>',"\n";
            echo '<h4>Seleziona quali dei Tuoi Hobbies sono stati fatti quest\'anno:</h4>',"\n";
            echo '<form method="post">',"\n";
                echo '<ol>',"\n";
                $contatore = 0;
                foreach($_POST['hobby'] as $chiave => $hobby){
                    if(strlen($hobby)>0)
                        echo("<li><input type=\"checkbox\" id=\"check-hobby-$chiave\" name=\"checkbox[]\" value=\"$hobby\" /> $hobby</li>\n");
                }
                echo '</ol>',"\n";
                
                for($i=0; $i<$elementi_text; $i++)
                    echo "<input type=\"hidden\" name=\"hobby[$i]\" value=\"{$_POST['hobby'][$i]}\" />\n";
                    
                echo '<input type="submit" id="submit-form-2" name="invia_form_2" value="Invia" /> ',"\n";
            echo '</form>',"\n";
        }
        // ---------- Fine - VISUALIZZA FORM <checkbox> HOBBIES ----------
        
        // ---------- Inizio - VISUALIZZA HOBBIES esercitati nell'ultimo anno ----------
        if(isset($_POST['checkbox'])){
            echo "\n\n",'<hr />',"\n";
            echo '<h3 class="esempio">Quest\'anno hai esercitato '.count($_POST['checkbox']).' Hobbies, eccoli:</h3>',"\n";
            
            echo '<ul>',"\n";
            foreach($_POST['checkbox'] as $hobby)
                echo "<li>$hobby</li>\n";
            echo '</ul>',"\n";
        }
        // ---------- Fine - VISUALIZZA HOBBIES esercitati nell'ultimo anno ----------
        ?>
        
        <hr />
        
        <h2>CODICE</h2>
        <p>Gli altri Heading TAG <b>&lt;h1&gt;</b> e <b>&lt;h2&gt;</b> sono stati per la creazione del Markup HTML.</p>
<?php
$codice = <<< 'CODICE'
<?php
$nl = "<br />";

// ---------- Inizio - VISUALIZZA FORM <text> HOBBIES ----------
// Specifica quanti elementi <input> di tipo 'text' stampare
$elementi_text = 10;

echo '<h3 class="esempio">Inserisci i tuoi Hobbies</h3>',"\n";
echo '<form method="post">',"\n";
    echo '<ol>',"\n";
        // attributo 'name' usare:
        // hobby[] (autoincremento dell'indice numerico) o
        // hobby[$i] (specificazione esplicita dell'indice numerico)
        for($i=0; $i<$elementi_text; $i++){
            echo "<li><input type=\"text\" id=\"input-hobby-($i+1)\" name=\"hobby[$i]\" ";
            if(isset($_POST['hobby'])&&strlen($_POST['hobby'][$i]))echo"value=\"{$_POST['hobby'][$i]}\"";
            echo "placeholder=\"Inserisci un hobby\" maxlength=\"50\" /></li>\n";

        }
    echo '</ol>',"\n";

    echo '<input type="submit" id="submit-form" name="invia_form" value="Invia" /> ',"\n";
    echo '<input type="reset" id="reset-form" name="reset_form" value="Ripristina" />',"\n";
echo '</form>',"\n";
// ---------- Fine - VISUALIZZA FORM HOBBIES ----------

// ---------- Inizio - VISUALIZZA FORM <checkbox> HOBBIES ----------
if(isset($_POST['hobby'])){
    echo '<h3 class="esempio">i Tuoi Hobbies:</h3>',"\n";
    echo '<h4>Seleziona quali dei Tuoi Hobbies sono stati fatti quest\'anno:</h4>',"\n";
    echo '<form method="post">',"\n";
        echo '<ol>',"\n";
        $contatore = 0;
        foreach($_POST['hobby'] as $chiave => $hobby){
            if(strlen($hobby)>0)
                echo("<li><input type=\"checkbox\" id=\"check-hobby-$chiave\" name=\"checkbox[]\" value=\"$hobby\" /> $hobby</li>\n");
        }
        echo '</ol>',"\n";

        for($i=0; $i<$elementi_text; $i++)
            echo "<input type=\"hidden\" name=\"hobby[$i]\" value=\"{$_POST['hobby'][$i]}\" />\n";

        echo '<input type="submit" id="submit-form-2" name="invia_form_2" value="Invia" /> ',"\n";
    echo '</form>',"\n";
}
// ---------- Fine - VISUALIZZA FORM <checkbox> HOBBIES ----------

// ---------- Inizio - VISUALIZZA HOBBIES esercitati nell'ultimo anno ----------
if(isset($_POST['checkbox'])){
    echo "\n\n",'<hr />',"\n";
    echo '<h3 class="esempio">Quest\'anno hai esercitato '.count($_POST['checkbox']).' Hobbies, eccoli:</h3>',"\n";

    echo '<ul>',"\n";
    foreach($_POST['checkbox'] as $hobby)
        echo "<li>$hobby</li>\n";
    echo '</ul>',"\n";
}
// ---------- Fine - VISUALIZZA HOBBIES esercitati nell'ultimo anno ----------
?>
CODICE;

    echo "<pre>".htmlspecialchars($codice)."</pre>";
?>
</body>
</html>