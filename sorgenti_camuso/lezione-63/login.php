<?php
  include($_SERVER['DOCUMENT_ROOT']."\..\my_include\setup.php")
?>
<!DOCTYPE html>

<html>
<head>
    <title>QUIZ MAKER - LOGIN</title>
</head>

<body  style="background-color: lightgreen; ">
 <center> <h2> QUIZ MAKER LOGIN</h2> </center>
 
 <form name="login" action="elogin_migliorata.php" method="POST">

    <table>
        <tr>
            <td>Email: </td>
            <td> <input type="text" name="email" value="" /></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td> <input type="password" name="password" value=""
                        autocomplete="off" /></td>
        </tr>
    </table>
      
    <input type="submit" name="btnAccedi" value="ACCEDI" />
    <input type="submit" name="btnNuovo" value="NUOVO UTENTE" />
    <input type="reset"/>        
 </form>

 <?php
 if( isset($_GET['errore']) )
 {
    echo "<p id='box_errore'".
         " style='background-color: red; font-weight: bold; color: yellow; border: 2px solid white;'>";
         
/*    switch ($_GET['errore'])
    {
       case 1:
         echo "Errore 1: bla bla";
        break;
    
       case 2:
         echo "Errore 2: bla bla";
        break;

       case 3:
         echo "Errore 3: bla bla";
        break;
    
       case 4:
         echo "Errore 4: bla bla";
        break;

    }
*/
  echo $messaggi_errore[$_GET['errore']];
    echo "</p>";
    
 }
 
 
 ?>
 
</body>
</html>













  