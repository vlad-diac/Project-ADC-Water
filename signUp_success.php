<?php
session_start();

if($_SESSION['accreditato'] == false and $_SESSION['registrato'] == false){
    
    header("Location:./signup.php");
    
    
}

if($_SESSION['registrato'] == true){
    
    header("Location: ./home.php");
}

?>




<html>
    
    
    <!--  PAGINA OK PER LA REGISTRAZIONE .. ASPETTA 3 SECONDI ECC.... -->
</html>