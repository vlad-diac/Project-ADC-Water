<?php 
require("./connection_database.php");
session_start();
$error = 0;
if($_SESSION['accreditato'] == false){ // controllo se sia loggato

    header("Location: ./index.php");
}

if(isset($_POST['btn_next'])){ // pulsante avanti
    
    $id_utente = $_SESSION['ID'];
    $nome_cond = $_POST['input_nome_condominio']; 
    $citta_cond = $_POST['input_citta'];
    
    if($nome_cond != null and $citta_cond != null){
        //AGGIUNGERE UN CONTROLLO CHE VERIFICHI CHE IL CONDOMINIO INSERITO NON ESISTA GIA' NEL SISTEMA
        //AGGIUNGERE UN CONTROLLO CHE VERIFICHI CHE IL CONDOMINIO INSERITO NON ESISTA GIA' NEL SISTEMA
        //AGGIUNGERE UN CONTROLLO CHE VERIFICHI CHE IL CONDOMINIO INSERITO NON ESISTA GIA' NEL SISTEMA
        //AGGIUNGERE UN CONTROLLO CHE VERIFICHI CHE IL CONDOMINIO INSERITO NON ESISTA GIA' NEL SISTEMA
        $statment_condominio = connect("test")->prepare("INSERT INTO condomini (nome,citta,id_assoc) VALUES (?,?,?)");

        $statment_condominio->execute([
           
            $nome_cond,
            $citta_cond ,
            $id_utente
        ]);
        
        // ottengo l'id del condominio
        $statment = connect("test")->prepare("SELECT * FROM condomini WHERE nome = :nome AND id_assoc = :id_utente AND citta = :citta LIMIT 1");
        $statment->bindValue(':nome',$nome_cond, PDO::PARAM_STR);
        $statment->bindValue(':id_utente',$id_utente, PDO::PARAM_STR);
        $statment->bindValue(':citta',$citta_cond, PDO::PARAM_STR);
        $statment->execute();
        if ($statment->rowCount() != 0){

            $data = $statment->fetch(PDO::FETCH_ASSOC);
            
            //CRIPTARE L'ID  AES 256 O ALTRO
            //CRIPTARE L'ID  AES 256 O ALTRO
            //CRIPTARE L'ID  AES 256 O ALTRO
            //CRIPTARE L'ID  AES 256 O ALTRO
            $id_condominio = $data['id'];

        }
        header("Location: ./datiUtentiCondominio.php?id=".$id_condominio);  
    }else{
        
        $error = 1;
    }

}
?>

<!DOCTYPE html>


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
  <form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
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
        <div style="text-align: center; margin: 0 auto; width: 900px"> <div style="text-align:center;">
            <h2 class="divider-style" style="color: rgb(255,255,255);margin-top: 20px;margin-bottom: 10px;"><span style="color: rgb(255,255,255);font-family: Bitter, serif;background-color: #292c2f;padding-left: 5px;padding-right: 5px;">Inserisci i Dati del Nuovo Condominio</span></h2>
            </div> 
            <?php 
            
            if($error == 1){echo "<p style='color:red;'>Inserisci tutti i dati prima di continuare</p>"; $error=0;} // msg di errore
                    
                            
             ?>
       </div>
        <div class="row">
            <div class="col">
                <div><div style="margin-top: 10px;margin-bottom: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center" style="margin-top: 10px;margin-bottom: 10px;"><a class="btn btn-primary btn-lg" role="button" href="#myModal" data-toggle="modal" style="font-size: 25px;background-color: rgb(255,255,255);color: rgb(0,0,0);">NOME CONDOMINIO</a>
                       
                    </div>
                </div>
                <div class="col-md-6 text-center" style="margin-top: 10px;margin-bottom: 10px;"><input class="form-control-lg" type="text" placeholder="ES: Montevideo 22" name="input_nome_condominio" style="height: 54.8px;"></div>
            </div>
        </div>
    </div>
    <div style="margin-top: 10px;margin-bottom: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center" style="margin-top: 10px;"><a class="btn btn-primary btn-lg" role="button" href="#myModal" data-toggle="modal" style="font-size: 25px;color: rgb(0,0,0);background-color: rgb(255,255,255);">CITTÀ&nbsp;DI UBICAZIONE</a>
                       
                    </div>
                </div>
                <div class="col-md-6 text-center" style="margin-top: 10px;margin-bottom: 10px;"><input name="input_citta" class="form-control-lg" type="text" placeholder="ES: Torino" style="height: 54.8px;"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 d-xl-flex align-items-xl-center"> <input class="add" name="btn_next" type="submit" value="AVANTI" style="background:green;"></div>
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script></div>
            </div>
        </div>
        
    
    </div>
    </div>
    <div></div>
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