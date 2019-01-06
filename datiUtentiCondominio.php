<?php 
require("./connection_database.php");
session_start();

$_SESSION['condominio_in_uso'] = null; // prenderà il valore (nome) del condomio usato
if($_SESSION['accreditato'] == false){ // controllo se sia loggato

    header("Location: ./index.php");
}

if(isset($_GET['id'])){ // almeno so che condominio ho preso in considerazione 
    
    $_SESSION['condominio_in_uso'] = $_GET['id'];
    
}

if(!isset($_SESSION['condominio_in_uso'])){
    
    
}
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
  
    <script>
        function showDettagli(str) {
            if (str=="") {

                document.getElementById("txtHint").innerHTML="";

                return;
            } 

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5

                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

            }

            xmlhttp.onreadystatechange=function() {

                if (this.readyState==4 && this.status==200) {

                    document.getElementById("txtHint").innerHTML=this.responseText;

                }
            }
            xmlhttp.open("GET","ajax_utenti.php?q="+str,true);
            xmlhttp.send();
        }



    </script>
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
        <div style="width: 100%;">
        <div style="text-align: center; margin: 0 auto; width: 900px"> <div style="text-align:center;">
            <h2 class="divider-style" style="color: rgb(255,255,255);margin-top: 20px;margin-bottom: 10px;"><span style="color: rgb(255,255,255);font-family: Bitter, serif;background-color: #292c2f;padding-left: 5px;padding-right: 5px;">Inserisci i Sottoutenti della Fattura</span></h2>
            </div>
       </div>
       </div>
        <div class="row" style="width: 100%;">
            <div class="col">
            <div>
                <form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                    <input type="text" onchange="showDettagli(this.value)" style="width: 80%" placeholder="Inserisci i valori in ordine separati dal ' ; ' es: nome;10;....  i numeri con la virgola usare ' .  es: 12.11 '" name="input_value">
                <button type="button" class="btn btn-sm btn-primary btn-create">Aggiungi</button>
               
          
               
               
                <div class="col-md-10 col-md-offset-1">

                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col col-xs-6">
                                    <h3 class="panel-title">Panel Heading</h3>
                                </div>
                                <div class="col col-xs-6 text-right">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-list">
                                <thead>
                                    <tr>
                                        <th><em class="fa fa-cog"></em></th>
                                        <th>Nome</th>
                                        <th>Numero persone</th>
                                        <th>Lettura precedenta (mc)</th>
                                        <th>Lettura attuale (mc)</th>
                                        <th>Consumo periodico</th>
                                        <th>Importi versati</th>
                                    </tr> 
                                </thead>
                                <tbody id="txtHint">
                                    
                                    <?php
                                    $contenuto = '';
                                    $statment_condomio = connect("test")->query("SELECT * FROM utenti_condominio ORDER BY id DESC");
                                    
                                    if(!isset($_GET['id'])){
                                        
                                    while($rows = $statment_condomio->fetch(PDO::FETCH_NUM)){
                                        $contenuto .= ' <tbody>
                                    <tr>
                                        <td align="center">
                                            <a class="btn btn-danger" href="./datiUtentiCondominio.php?cls='.$rows[0].'"><em class="fa fa-trash"></em></a>
                                        </td>
                                        <td class="hidden-xs">'.$rows[1].'</td>
                                        <td>'.$rows[2].'</td>
                                        <td>'.$rows[3].'</td>
                                        <td class="hidden-xs">'.$rows[4].'</td>
                                        <td>'.$rows[5].'</td>
                                        <td>'.$rows[6].'</td>
                                    </tr>
                                </tbody>
                ';


                                    }
                                    echo $contenuto;
                                    }
                                    
                                    
                                    ?>
                
                                    
                                    <!-- JS OUTPUT -->
                                    
                                </tbody>
                                
                                
                            </table>

                        </div>
                       
                    </div>

                </div>
                
               


            </div>
            <br/>
                </form>
    <div>
       <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <a href="./canoniFissi.php">  <div class="col-md-4 d-xl-flex align-items-xl-center"><button class="add" style="background:green;">AVANTI</button></div></a>
                <div class="col-md-4"></div>
            </div>
        </div>
        </div>
        <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 d-xl-flex align-items-xl-center"><button class="add" style="background:red;">INDIETRO</button></div>
                <div class="col-md-4"></div>
            </div>
        </div>
        </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
           </div>
            </div>
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