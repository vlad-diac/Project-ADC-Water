<?php
session_start();
// value='<?php echo $_SESSION['id']; ? >'


?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Modulo di registrazione</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>

    <body>
        <div class="row register-form" style="background-image: url(&quot;assets/img/mountain_bg.jpg&quot;);background-size: cover;">
            <div class="col-md-8 offset-md-2">
                <form class="custom-form" style="background-color: rgb(41,44,47);">
                    <h1 style="color: rgb(255,255,255);">Modulo di Registrazione</h1>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field" style="color: rgb(255,255,255);">Nome</label></div>
                        <div class="col-sm-6 input-column"><input id="input-username" class="form-control" type="text" placeholder="Inserisci il nome utente"></div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field" style="color: rgb(255,255,255);">Email </label></div>
                        <div class="col-sm-6 input-column"><input id="input-email" class="form-control" type="email" placeholder="Inserisci un email valida"></div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="pawssword-input-field" style="color: rgb(255,255,255);">Password </label></div>
                        <div class="col-sm-6 input-column"><input placeholder="Inserisci una password" id="input-password" class="form-control" type="password"></div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="repeat-pawssword-input-field" style="color: rgb(255,255,255);">Ripeti Password </label></div>
                        <div class="col-sm-6 input-column"><input id="input-c-password" class="form-control" type="password" placeholder="Inserisci nuovamente la password"></div>
                    </div>
                    <!--     <div class="form-row form-group">
<div class="col-sm-4 label-column"><label class="col-form-label" for="dropdown-input-field" style="color: rgb(255,255,255);">Dropdown </label></div>
<div class="col-sm-4 input-column">
<div class="dropdown"><button class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">Dropdown </button>
<div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">First Item</a><a class="dropdown-item" role="presentation" href="#">Second Item</a><a class="dropdown-item" role="presentation" href="#">Third Item</a></div>
</div> 
</div>
</div> -->
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check_terms" value="true" required><label class="form-check-label" id="text_terms" for="formCheck-5" style="color: rgb(255,255,255);">Ho letto e accetto i termini e le condizioni</label></div><button id="btn_crea" class="btn btn-light submit-button" type="submit" name="btn">REGISTRATI</button>
                    <div id="error_msg" style="display: none"></div>


                </form>
            </div>
            <div class="col"><a class="btn btn-primary mx-auto d-block margenesArribaAbajo30px botonCircular pull-right" role="button" href="inizio.html" data-bs-hover-animate="pulse" style="background-color: #292c2f;"><i class="fa fa-close"></i></a></div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-animation.js"></script>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btn_crea').click(function(e) {
                e.preventDefault();

                var username = $("#input-username").val();
                var password = $("#input-password").val();
                var c_password = $("#input-c-password").val();
                var email = $("#input-email").val();


                if ($('#check_terms').is(':checked')) {
                    $("#text_terms").css("color", "rgb(255,255,255)");
                    $.ajax({
                        type: "POST",
                        url: "registrati.php",
                        data: {
                            username: username,
                            password: password,
                            c_password: c_password,
                            email: email,
                        },
                        success: function(data) {
                            if (data == "200") {
                                setTimeout("location.href = 'signUp_success.php'", 500);
                            } else {
                                switch (data) {
                                    case "400":
                                        $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>Inserisci tutti i dati prima di continuare</a>");
                                        $("#error_msg").css("display", "block");
                                        break;
                                    case "399":
                                        $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>Le password non corrispondono</a>");
                                        $("#error_msg").css("display", "block");
                                        break;
                                    case "999":
                                        $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>Impossibile completare la registrazione, riprova più tardi</a>");
                                        $("#error_msg").css("display", "block");
                                        break;
                                    case "397":
                                        $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>L'email inserita non è valida</a>");
                                        $("#error_msg").css("display", "block");
                                        break;
                                    case "396":
                                        $("#error_msg").html("<a href='./index.html' style='color:red;'class='forgot'>L'username scelto o l'email è già esistente</a>");
                                        $("#error_msg").css("display", "block");
                                        break;

                                }
                            }
                        }
                    });

                }else{
                    $("#text_terms").css("color", "red");
                }
            });
        });
    </script>

</html>