<?php
session_start();



if(isset($_GET['exit'])){ // distruggo la sessione se l'utente esce
    if($_GET['exit'] == "ex"){
        
        session_destroy();
    }
    
}
if(!isset($_SESSION['accreditato'])){
    
    $_SESSION['accreditato'] = false;
    
}

if($_SESSION['accreditato'] == true){
    header("Location: ./home.php");
    
}

if(isset($_POST['btn_prova'])){
    
    $_SESION['prova_gratuita'] = true;
    header("Location: ./home.php");
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>index</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Rounded-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/divider-text-middle.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        input.pointer:hover,
        a.pointer:hover {
            cursor: pointer;
        }
        .modal {
           
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(6, 99, 198, 0.47);
     
        }
       
        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }
        @keyframes animatezoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }
        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div>
        <div class="header-dark" style="padding: 0PX 0PX 10PX;">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
                <div class="container"><a class="navbar-brand" href="#" style="font-family: Bitter, serif;">Accadue<span style="color:red">C</span>o</a>
                   
                        
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group"></div>
                    </form><span class="navbar-text"><a href="registrazione.php" class="login" style="font-family: Bitter, serif;">Registrati</a></span>&nbsp;<a class="btn btn-light action-button" id="accedi_btn"  role="button" href="#" style="font-family: Bitter, serif;" onclick="document.getElementById('id02').style.display='block'">ENTRA</a></div>
       
        </nav>
        <div class="container hero" style="margin-top: 5px;">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="text-center d-xl-flex align-items-xl-center" style="font-size: 23px;background-color: rgba(41,44,47,0.8);margin: 20PX 0PX 20PX;"><br>SISTEMA INTEGRATO PER LA RIPARTIZIONE COMPLESSA DELLA BOLLETTA DEL SERVIZIO IDRICO INTEGRATO IN CONDOMINIO, USO DOMESTICO<br><br></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="article-list">
        <div class="container">
            <div class="intro">
                <div style="text-align: center; margin: 0 auto; width: 1000px"> <div style="text-align:center;">
           <h2 class="divider-style" style="color: rgb(255,255,255);margin-top: 20px;margin-bottom: 10px;"><span style="color: rgb(255,255,255);font-family: Bitter, serif;background-color: #292c2f;padding-left: 5px;padding-right: 5px;">I Nostri Servizi all' interno della Piattaforma</span></h2>
            </div>
       </div>
            </div>
            <div class="row articles">
                <div class="col-sm-6 col-md-4 item"><div style="text-align: center;"><a href="#"><img class="img-fluid" src="assets/img/desk.jpg" style="width: 150px;height: 150px;"></a>
                    <div style="text-align:center;">
                        <h2 class="divider-style" style="font-size: 20px;padding: 0px;margin: 10px;"><span style="color: rgb(255,255,255);background-color: #292c2f;padding-right: 5px;padding-left: 5px;">TEXTO AQUI</span></h2>
                    </div>
                    <p class="description" style="color: rgb(255,255,255);background-color: rgba(41,44,47,0.8);font-size: 15px;font-family: Bitter, serif;">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="fa fa-arrow-circle-right" style="color: rgb(255,255,255);"></i></a></div></div>
                <div
                    class="col-sm-6 col-md-4 item"><div style="text-align: center;"><a href="#"><img class="img-fluid" src="assets/img/building.jpg" style="width: 150px;height: 150px;"></a>
                    <div style="text-align:center;">
                        <h2 class="divider-style" style="margin: 10px;padding: 0px;font-size: 20px;"><span style="background-color: #292c2f;color: rgb(255,255,255);padding-right: 5px;padding-left: 5px;">TEXTO AQUI</span></h2>
                    </div>
                    <p class="description" style="color: rgb(255,255,255);background-color: rgba(41,44,47,0.8);font-size: 15px;font-family: Bitter, serif;">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="fa fa-arrow-circle-right" style="color: rgb(255,255,255);"></i></a></div></div>
            <div
                class="col-sm-6 col-md-4 item"><div style="text-align: center;"><a href="#"><img class="img-fluid" src="assets/img/loft.jpg" style="width: 150px;height: 150px;"></a>
                <div style="text-align:center;">
                    <h2 class="divider-style" style="margin: 10px;padding: 0px;font-size: 20px;"><span style="font-size: 20px;color: rgb(255,255,255);background-color: #292c2f;padding-right: 5px;padding-left: 5px;">TEXTO AQUI</span></h2>
                </div>
                <p class="description" style="background-color: rgba(41,44,47,0.8);color: rgb(255,255,255);font-size: 15px;font-family: Bitter, serif;">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a href="#" class="action"><i class="fa fa-arrow-circle-right" style="color: rgb(255,255,255);"></i></a></div></div>
    </div>
    <div class="row"></div>
    </div>
    </div>
            <div class="col"></div>
        </div>
        <div style="text-align: center; margin: 0 auto; width: 800px"> <div style="text-align:center;">
            <h2 class="divider-style" style="color: rgb(255,255,255);margin-top: 20px;margin-bottom: 10px;"><span style="color: rgb(255,255,255);font-family: Bitter, serif;background-color: #292c2f;padding-left: 5px;padding-right: 5px;">I Nostri Abbonamenti</span></h2>
            </div>
       </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div><a class="btn btn-primary btn-lg d-flex justify-content-lg-center" role="button" href="#myModal" data-toggle="modal" style="margin: 10px;color: rgb(41,44,47);background-color: rgb(255,255,255);font-family: Bitter, serif;">10 Ripartizioni - €70,00 + iva</a>
                    <div
                        class="modal fade" role="dialog" tabindex="-1" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Accedi per continuare:</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                <div class="modal-body">
                                    <?php if($_SESSION['accreditato'] != true)    {

                                    echo "<button class='btn btn-primary' style='width: 100%' type='button'>Accedi</button><br><p style='text-align: center;'> o </p>";
                                    echo "<button class='btn btn-warning' style='width: 100%' type='button'>Registrati</button>";

                                }else{
    
                                    header("Location: ./pagamento.php"); // da modificare !!!
    
                                }


                                    ?>
                                </div>
                                
                            </div>
                        </div>
                </div>
            </div>
            <div><a class="btn btn-primary btn-lg d-flex d-lg-flex justify-content-lg-center" role="button" href="#myModal" data-toggle="modal" style="margin: 10px;color: rgb(41,44,47);background-color: rgb(255,255,255);font-family: Bitter, serif;">30 Ripartizioni - €165,00 + iva</a>
        </div>
    </div>
    <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <form method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <div class="col"><button class="add" type="submit" name="btn_prova">PROVA GRATUITA</button></div>
        </form>
    </div>
    </div>
    </div>
    <div></div>
    
    
    
    
    
    <div id="id02" class="modal">



        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>

        <div class="login-card"><img src="assets/img/avatar_2x.png" class="profile-img-card">
           
            <p class="profile-name-card"> </p>
                <span class="reauth-email"> </span>
                <input id="input-username" name="usr" class="form-control" type="text"  placeholder="Username" >
            <input class="form-control" type="password" placeholder="Password" id="input-password" name="password">
<!--
                <div class="checkbox">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1">Ricordati di Me</label></div>
                    </div> --> <button class="btn btn-primary btn-block btn-lg btn-signin" id="btn_accedi" type="submit">ENTRA</button><a href="#" class="forgot-password">Password Dimenticata?</a><br><a href="./registrati.html" class="forgot-password">Non possiedi un account? Crealo</a><a id="error_msg" style="display: none; text-align: center;" class="forgot pointer"></a></div>
       
    </div>
    
    
    
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
    <script type="text/javascript">
        $(document).ready(function() {


            $('#accedi_btn').click(function(e){
                var modal_1 = document.getElementById('id02');
                // When the user clicks anywhere outside of the modal, close it
                if (event.target == modal) {
                    modal_1.style.display = "none";
                }
            });

            $('#btn_accedi').click(function(e) {
                e.preventDefault();
                var username = $("#input-username").val();
                var password = $("#input-password").val();
                $.ajax({
                    type: "POST",
                    url: "accedi.php",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(data) {
                        if (data == "200") {
                            // console.log("ok");
                            setTimeout("location.href = 'home.php'", 500);
                        } else {
                            switch (data) {
                                case "403":
                                    $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>Password sbagliata</a>");
                                    $("#error_msg").css("display", "block");
                                    break;
                                case "404":
                                    $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>I dati inseriti non sono corretti</a>");
                                    $("#error_msg").css("display", "block");
                                    break;
                                case "405":
                                    $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>Inserisci i dati</a>");
                                    $("#error_msg").css("display", "block");
                                    break;
                            }
                        }
                    }
                });
            });
        });
    </script>
</html>