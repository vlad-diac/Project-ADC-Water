<?php 
require("./connection_database.php");
session_start();

if($_SESSION['accreditato'] == false){ // controllo se sia loggato
    
    header("Location: ./index.php");
}

$contenuto = '';
$partizioni_create = 0;


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/css/divider-text-middle.css">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Rounded-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div>
        <div class="header-dark" style="padding: 0PX 0PX 10PX;">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
                <div class="container"><a class="navbar-brand" href="./index.php" style="font-family: Bitter, serif;">AccadueCo</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation"><a class="nav-link" href="./home.php" style="font-family: Bitter, serif;">Home</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="" style="font-family: Bitter, serif;">Manuale</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Video-Corso</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Condomini</a></li>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;color: yellow;">Abbonamenti</a></li>
                     
                        </ul>
                        <ul class="nav navbar-nav ml-auto">
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown"   style="color: red;"  aria-expanded="false" href="#"><b>Gestisci account</b></a>
                            <div class="dropdown-menu" role="menu"><p align="center"><b><?php echo $_SESSION['username']; ?></b></p><hr>
                                <a class="dropdown-item" role="presentation" href="./account_utente.php">Modifica account</a>
                                <a class="dropdown-item" role="presentation" href="./contattaci.php">Assistenza</a><hr>
                                <a style="color: red;" class="dropdown-item" role="presentation"href="index.php?exit=ex"><b>Disconetti</b></a>
                            </div>
                        </li>   
                        </ul>
                    </div></form>
        </div>
        </nav>
        <div class="container hero" style="margin-top: 5px;">
            <div class="row" style="margin: 20px;margin-right: 0;margin-left: 0;">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-center d-xl-flex align-items-xl-center" style="font-size: 23px;background-color: rgba(41,44,47,0.8);margin: 20PX 0PX 30PX;"><br>SISTEMA INTEGRATO PER LA RIPARTIZIONE COMPLESSA DELLA BOLLETTA DEL SERVIZIO IDRICO INTEGRATO IN CONDOMINIO, USO DOMESTICO<br><br></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div style="text-align:center;"></div>
            </div>
        </div>
        <div class="row" style="margin: 30px;">
            <div class="col"></div>
             <div class="row" style="width: 100%;">
            <div class="col">
            <div >
           
    <table class="table" style="margin-left:auto; 
    margin-right:auto;
    border-spacing: 10px;
  border-collapse: separate;
     text-align: center;">
      <thead>
        <tr>
          
          <th style="background-color: rgb(41,44,47); color:white;">UTENTE</th>
          <th style="background-color: rgb(41,44,47); color:white;">CONSUMO</th>
          <th style="background-color: rgb(41,44,47); color:white;">QUOTE FISSE</th>
          <th style="background-color: rgb(41,44,47); color:white;">QUOTE VARIABILI</th>
           <th style="background-color: rgb(41,44,47); color:white;">T.A.</th>
          <th style="background-color: rgb(41,44,47); color:white;">T.B.</th>
          <th style="background-color: rgb(41,44,47); color:white;">E.1</th>
          <th style="background-color: rgb(41,44,47); color:white;">E.2</th> <th style="background-color: rgb(41,44,47); color:white;">E.3</th>
          <th style="background-color: rgb(41,44,47); color:white;">PARTI UGUALI</th>
          <th style="background-color: rgb(41,44,47); color:white;">TOTALE DOVUTO</th>
          <th style="background-color: rgb(41,44,47); color:white;">IMPORTI VERSATI</th>
          <th style="background-color: rgb(41,44,47); color:white;">SALDO</th>
          <th style="background-color: rgb(41,44,47); color:white;">TABELLA</th>
        </tr>
      </thead>
      <tbody>
       
          <?php
            $id = $_SESSION['condominio_in_uso'];
            $output = '';
            $totale = 0;
        
          
      
                  $soglia_di_consumo = $_SESSION['agevolata_mc'] / $_SESSION['num_utenti'];
                   $singolo_mc = $_SESSION['agevolata_lordo'] / ($soglia_di_consumo * $_SESSION['num_utenti']);

                        $calcolo = doubleval($_SESSION['totale_lordo_variabili']) / doubleval($_SESSION['somma_mc_consumo_periodico']); // specificare il tipo di variabile

                        $partiuguali = doubleval($_SESSION['totale_lordo_fissi']) / doubleval($_SESSION['num_utenti']);

                        $statment_condomio = connect("test")->query("SELECT * FROM utenti_condominio WHERE id_condominio = '".$id."'");

                        while($rows = $statment_condomio->fetch(PDO::FETCH_NUM)){
                            
                            if($rows[5]<$soglia_di_consumo){
                                $parziale_ta = $singolo_mc * $rows[5];
                            }
                            
                            else{
                                
                                $parziale_ta = $singolo_mc * $soglia_di_consumo;
                                
                            }
                            
                            $output .= ' <tr> <td><input type="text" value='.$rows[1].' /></td>';
                            
                            $totale += $rows[3] ;
                            
                            $output .= ' <td><input  type="text"  value='.$rows[5].' /></td>
                                        <td><input  type="text"  value='.$partiuguali.' /></td>
                                        <td><input  type="text" value='.($rows[5] * $calcolo).' /></td>
                                        <td><input  type="text" value='.$parziale_ta.' /></td>

                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>

                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text" /></td>
                                        </tr>';
                            
                        }
            
          $output  .= ' <td><b><input  type="text"  value="TOTALE" /></b></td>
                                        <td><input  type="text"  /></td>
                                        <td><input  type="text"  value='.$totale.'  /></td>
                                        <td><input  type="text"/></td>

                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>

                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text"/></td>
                                        <td><input  type="text" /></td>
                                        </tr>';
                        
          
          echo $output;
          
     
            
          
            
            ?>
            
         
        
      </tbody>
    </table>
  
           </div>
            <br/>
    <div>
       <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 d-xl-flex align-items-xl-center"><button class="add" type="submit" name="avanti" style="background:green;">AVANTI</button></div>
                <div class="col-md-4"></div>
            </div>
        </div>
        </div>
        <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 d-xl-flex align-items-xl-center"><button class="add" type="submit" style="background:red;">INDIETRO</button></div>
                <div class="col-md-4"></div>
            </div>
        </div>
        </div>
 >
           </div>
            </div>
        </div>
        
            <div class="col">
               
            
        
    </div>
    <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
    </div>
    </div>
    </div>
    <div></div>
    <footer style="margin: 0;">
        <div class="row">
            <div class="col-sm-6 col-md-4 footer-navigation">
                <h3 style="font-family: Bitter, serif;"><a href="#">AccadueCo</a></h3>
                <p class="links" style="font-family: Bitter, serif;"><a href="#">Home</a><strong> · </strong><a href="#">Blog</a><strong> · </strong><a href="#">Pricing</a><strong> · </strong><a href="#">About</a><strong> · </strong><a href="#">Faq</a><strong> · </strong><a href="#">Contact</a></p>
                <p class="company-name"
                    style="font-family: Bitter, serif;">Company Name © 2015 </p>
            </div>
            <div class="col-sm-6 col-md-4 footer-contacts">
                <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                    <p style="font-family: Bitter, serif;"><span class="new-line-span" style="font-family: Bitter, serif;">21 Revolution Street</span> Paris, France</p>
                </div>
                <div><i class="fa fa-phone footer-contacts-icon"></i>
                    <p class="footer-center-info email text-left" style="font-family: Bitter, serif;"> +1 555 123456</p>
                </div>
                <div><i class="fa fa-envelope footer-contacts-icon"></i>
                    <p> <a href="#" target="_blank" style="font-family: Bitter, serif;">support@company.com</a></p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 footer-about">
                <h4 style="font-family: Bitter, serif;">About the company</h4>
                <p style="font-family: Bitter, serif;"> Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet. </p>
                <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-github"></i></a></div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>