<?php 
require("./connection_database.php");
session_start();

$_SESSION['condominio_in_uso'] = null; // prenderà il valore (nome) del condomio usato
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
                <div class="container"><a class="navbar-brand" href="#" style="font-family: Bitter, serif;">AccadueCo</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Home</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="font-family: Bitter, serif;">Manuale</a></li>
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
            <div class="col">
               
            <?php
             
                $id = $_SESSION['ID'];
                // controllo se esiste già una ripartizioni 
                $statment = connect("test")->prepare("SELECT * FROM partizioni WHERE id = :id LIMIT 1");
                $statment->bindValue(':id',$id, PDO::PARAM_STR);
                $statment->execute();
                if ($statment->rowCount() != 0){

                    $data = $statment->fetch(PDO::FETCH_ASSOC);
                    $partizioni_create = $data['numeroPartizioni'];

                }
                if($partizioni_create == 0){
                    $contenuto .= ' <div><a class="btn btn-primary btn-lg d-flex justify-content-lg-center" role="button" href="#myModal" data-toggle="modal" style="margin: 10px;color: rgb(41,44,47);background-color: rgb(255,255,255);font-family: Bitter, serif;">Inizia una Nuova Ripartizione</a>';
                    
                     // controllo se ha già inserito qualche condiminio
                    $statment_condomio = connect("test")->prepare("SELECT * FROM condomini WHERE id_assoc = :id LIMIT 1");
                    $statment_condomio->bindValue(':id',$id, PDO::PARAM_STR);
                    $statment_condomio->execute();
                    if ($statment_condomio->rowCount() != 0){ // se esiste già un dondominio

                        $contenuto .= '<div   class="modal fade" role="dialog" tabindex="-1" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Scegli il condomio da utilizzare</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    ';
                        // controllo quante ne ha di condomini e gli e li faccio vedere tutti
                        $statment_condomio = connect("test")->query("SELECT * FROM condomini WHERE id_assoc = '".$id."'");
                      
                        while($rows = $statment_condomio->fetch(PDO::FETCH_NUM)){
                            $contenuto .= '<a href="inserisciFattura.php?id='.$rows[0].'"><input type="submit" class="btn btn-success" style="width: 100%;" value="'.$rows[1].' - '.$rows[2].'" ></a><br> 
                            <br>
                            ';
                        }
                        $contenuto .= '
                                     <p style="text-align: center;"> o </p>
                        <a href="creaCondominio.php"><input type="submit" class="btn btn-info"   style="width: 100%;" value="Aggiungi un nuovo condominio"> </a>
                                </div>                               
                            </div>
                        </div>
                </div>
            </div>';

                    }else{ // altrimenti gli dico che deve crearli
                        
                        $contenuto .= '<div   class="modal fade" role="dialog" tabindex="-1" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Sistema</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <p class="text-center text-muted">Per poter creare una ripartizione bisogna inserire nel sistema i dati di almeno un condomio su cui elaborare i dati </p>
                                </div>
                                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><a href="creaCondominio.php"> <button class="btn btn-primary" type="button">Prosegui</button> </a> </div>
                            </div>
                        </div>
                </div>
            </div>';
                    }

                   
                    
                    echo $contenuto;
                }else {
                   
                    $contenuto .= ' <div><a class="btn btn-primary btn-lg d-flex justify-content-lg-center" role="button" href="#myModal" data-toggle="modal" style="margin: 10px;color: rgb(41,44,47);background-color: rgb(255,255,255);font-family: Bitter, serif;">Inizia una Nuova Ripartizione</a>
                    <div
                        class="modal fade" role="dialog" tabindex="-1" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Modal Title</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <p class="text-center text-muted">Description </p>
                                </div>
                                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
                            </div>
                        </div>
                </div>
            </div>

            <div><a class="btn btn-primary btn-lg d-flex justify-content-lg-center" role="button" href="#myModal" data-toggle="modal" style="margin: 10px;color: rgb(41,44,47);background-color: rgb(255,255,255);font-family: Bitter, serif;">Apri una ripartizione già esistente</a>
                    <div
                        class="modal fade" role="dialog" tabindex="-1" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Modal Title</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <p class="text-center text-muted">Description </p>
                                </div>
                                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
                            </div>
                        </div>
                </div>
            </div>';


                    echo $contenuto;
                    
                }

                
                
                ?>
        
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