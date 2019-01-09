<?php 
require("./connection_database.php");
session_start();

if($_SESSION['accreditato'] == false){ // controllo se sia loggato
    
    header("Location: ./index.php");
}

if(isset($_POST['avanti']))			//se premo bottone registra
{				
	if($_POST['bolli'] != "" and $_POST['depositi_cauzionali'] <> "" and $_POST['lettura_contatori'] <> "" and $_POST['altri_oneri'] <> "")								//controllo che i campi non siano vuoti
    {		
        
        $_SESSION['bolli'] = $_POST['bolli'];
        $_SESSION['depositi_cauzionali'] = $_POST['depositi_cauzionali'];
        $_SESSION['lettura_contatori'] = $_POST['lettura_contatori'];
        $_SESSION['altri_oneri'] = $_POST['altri_oneri'];
        
       $_SESSION['totale_costi_quoteuguali'] = $_SESSION['bolli'] + $_SESSION['depositi_cauzionali'] + $_SESSION['lettura_contatori'] + $_SESSION['altri_oneri'];

        
        
        header("Location: ./resoconto.php");
        
    }
    else
    {
    	$_SESSION['debug'] = "Compila tutti i campi, impossibile creare account :("; //altrimenti, non avendo inserito tutti i campi visualizza errore
        
	}
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
  
<style>
    .table td{
        border:transparent;
    }    
</style>
</head>

<body>
    <form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
    <div>
        <div class="header-dark" style="padding: 0PX 0PX 10PX;">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
                <div class="container"><a class="navbar-brand" href="#" style="font-family: Bitter, serif;">AccadueCo</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div
                        class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Home</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Manuale</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Video-Corso</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Condomini</a></li>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;color: rgb(255,0,0);">Abbonamenti</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;color: rgb(255,0,0);">Contattaci</a></li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                            
                        </form><span class="navbar-text"><a href="#" class="login" style="font-family: Bitter, serif;">Profilo</a></span><a class="btn btn-light action-button" role="button" href="inizio.html" style="font-family: Bitter, serif;background-color: rgb(255,0,0);">ESCI</a></div>
        </div>
        </nav>
        <div class="container hero" style="margin-top: 5px;">
            <div class="row" style="margin: 20px;margin-right: 0;margin-left: 0;">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-center d-xl-flex align-items-xl-center" style="font-size: 23px;background-color: rgba(41,44,47,0.8);margin: 20PX 0PX 30PX;"><br>SISTEMA INTEGRATO PER LA RIPARTIZIONE COMPLESSA DELLA BOLLETTA DEL SERVIZIO IDRICO INTEGRATO IN CONDOMINIO, USO DOMESTICO<br><br></h1>
                </div>
            </div>
        </div>
        
        <div class="row" style="width: 80%; margin-left: auto; margin-right: auto;" >
            <div class="col">
           <div class="table-responsive">
           <div style="text-align: center; margin: 0 auto; "> <div style="text-align:center;">
            <h2 class="divider-style" style="color: rgb(255,255,255);margin-top: 20px;margin-bottom: 10px; "><span style="color: rgb(255,255,255);font-family: Bitter, serif;background-color: #292c2f;padding-left: 5px;padding-right: 5px;">Inserisci i Dati dei Canoni Fissi</span></h2>
            </div>
       </div>
    <table class="table" style="margin-left:auto; 
    margin-right:auto;
    border-spacing: 10px;
  border-collapse: separate;
     text-align: center;">
      <thead>
        <tr>
          <th style="border:transparent"></th>
          <th style="background-color: rgb(41,44,47); color:white;">IMPORTO LORDO</th>
          
        </tr>
      </thead>
      <tbody>
        <tr>
          <th style="color: white; border-bottom: 1px solid white;">Bolli</th>
          <td><input type='text' name='bolli' placeholder='ES-150'/></td>
          
        </tr>
        <tr>
          <th style="color: white; border-bottom: 1px solid white;">Depositi Cauzionali</th>
            <td><input type='text' name='depositi_cauzionali' placeholder='ES-150'/></td>
        </tr>
        <tr>
          <th style="color: white; border-bottom: 1px solid white;">Lettura Contatori</th>
            <td><input type='text' name='lettura_contatori' placeholder='ES-150'/></td>
        </tr>
        <tr>
          <th style="color: white; border-bottom: 1px solid white;">Altri Oneri</th>
            <td><input type='text' name='altri_oneri' placeholder='ES-150'/></td>
        </tr>
       
      </tbody>
    </table>
  
           </div>
            <br/>
    <div>
       <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 d-xl-flex align-items-xl-center"><button class="add" type="submit" name='avanti' style="background:green;">AVANTI</button></div>
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
    </form>
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