<?php 
require("./connection_database.php");
session_start();

if($_SESSION['accreditato'] == false){ // controllo se sia loggato
    
    header("Location: ./index.php");
}

$contenuto = '';
$partizioni_create = 0;

$id = $_SESSION['condominio_in_uso'];
?>

<?php



function consumoTabella($id){ // ottengo i valori per i consumi
    $consumi = array();
    $i = 0;
    $statment_condomio = connect("test")->query("SELECT * FROM utenti_condominio WHERE id_condominio = '".$id."'");

        for($i = 0; $i < $rows = $statment_condomio->fetch(PDO::FETCH_NUM); $i++){   

            $consumi[$i] = $rows[5];



        }

            return $consumi;
    
}

$consumi_array = consumoTabella($id);  // ritorno i consumi dentro un array
//var_dump($consumi_array);




function quotefisseTabella($totale_lordo, $contatore){ // ottengo il valore per le quote fisse
     
    $quoteFisse = $totale_lordo / $contatore;
    
    
        return $quoteFisse;
 
}


 $quote_fisse = quotefisseTabella($_SESSION['totale_lordo_fissi'],$_SESSION['num_utenti']);  // ritorno la quota fissa in questa variabile
//echo $quote_fisse;


function quoteVariabili($totale_lordo,$somma_mc_periodico,$consumi){  // ottengo le quote variabili
    
        $quoteVariabili = array();
        $i = 0;
    
            for($i = 0; $i < sizeof($consumi); $i++){

                $quoteVariabili[$i] =   ($totale_lordo / $somma_mc_periodico) * $consumi[$i];

            }

                return $quoteVariabili;
    
    
}

$quoteVariabili_Array = quoteVariabili($_SESSION['totale_lordo_variabili'],$_SESSION['somma_mc_consumo_periodico'],$consumi_array);  // ottengo le queote varaibili dentro un array
//var_dump($quoteVariabili_Array);

    
    
function _TA_tabella_Rta($agevolata_mc,$consumi,$numero_utenti,$agevolata_lordo){ // ottengo i valori per TA e dopo lo faccio per tb con mc_TB
    
    //dichiaro variabili per TA
    $i = 0;
    $differenza_soglia_TA = 0;
    $contatore_superamento_soglia_TA = 0;
    $_TA = array();
    $_var_mc_TB = array();
    
    // calcoli
    @$soglia_consumo =  $agevolata_mc / $numero_utenti;  // @ overload per evitare errori di caldolo per la divisione per zero 
    @$costo_singolo_mc = $agevolata_lordo / $agevolata_mc;
    
    
   for($i = 0; $i < $numero_utenti; $i++){
       
       if($consumi[$i] < $soglia_consumo){
           
           $differenza_soglia_TA = $differenza_soglia_TA + ($soglia_consumo - $consumi[$i]); // operazione per chi non la supera, ottengo 1 valore alla fine...
           
       }else{
           
           $contatore_superamento_soglia_TA++; // incremento chi ha superato la soglia
           
       }
   } 
   
    for($i = 0; $i < $numero_utenti; $i++){  // non toccare!!!
        
         if($consumi[$i] < $soglia_consumo){
           
           $_TA[$i] = $consumi[$i] * $costo_singolo_mc;  // valore da ritornare
               
       }else{
           
           $_TA[$i] = ($soglia_consumo + ($differenza_soglia_TA / $contatore_superamento_soglia_TA)) * $costo_singolo_mc;  // valore da ritornare
          
       }
        
    }
    

    
    return $_TA;
     
    
}  

$TA_ = _TA_tabella_Rta($_SESSION['agevolata_mc'],$consumi_array,$_SESSION['num_utenti'],$_SESSION['agevolata_lordo']);    

//var_dump($TA_);

function _TA_tabella_Rtb($agevolata_mc,$consumi,$numero_utenti,$agevolata_lordo){  // OTTENGO VAR_MC_TB 
       
    //dichiaro variabili per TA
    $i = 0;
    $differenza_soglia_TA = 0;
    $_SESSION['contatore_superamento_soglia_TA'] = 0;
    $_TA = array();
    $_var_mc_TB = array();
    
    // calcoli
    @$soglia_consumo =  $agevolata_mc / $numero_utenti;  // @ overload per evitare errori di caldolo per la divisione per zero 
    @$costo_singolo_mc = $agevolata_lordo / $agevolata_mc;
    
    
   for($i = 0; $i < $numero_utenti; $i++){
       
       if($consumi[$i] < $soglia_consumo){
           
           $differenza_soglia_TA = $differenza_soglia_TA + ($soglia_consumo - $consumi[$i]); // operazione per chi non la supera, ottengo 1 valore alla fine...
           
       }else{
           
           $_SESSION['contatore_superamento_soglia_TA']++; // incremento chi ha superato la soglia
           
       }
   } 
   
    for($i = 0; $i < $numero_utenti; $i++){  // non toccare!!!
        
         if($consumi[$i] < $soglia_consumo){
           
           $_var_mc_TB[$i] = $consumi[$i] - $consumi[$i];  // variabile usata per TB per il calcolo del mc   ++++++++++
               
       }else{
           
           $_var_mc_TB[$i] = $consumi[$i] - ($soglia_consumo + ($differenza_soglia_TA / $_SESSION['contatore_superamento_soglia_TA'])) ;   // variabile usata per TB per il calcolo del mc   ++++++++++
       }
        
    }
    

    
    return $_var_mc_TB;
    
    
}


$TB_mc = _TA_tabella_Rtb($_SESSION['agevolata_mc'],$consumi_array,$_SESSION['num_utenti'],$_SESSION['agevolata_lordo']);    

//var_dump($TB_mc);


function _TB_tabella($base_mc,$base_lordo,$mc_lordo,$_var_mc_TB,$numero_utenti){  // ottengo valori colonna TB
    
    //var
    $differenza_soglia_TB = 0;
    $i = 0;
    $contatore_superamento_soglia_TB = 0;
    $tb_array = array(); // sarà il mio output TB ARRAY
    
    //calcoli
    @$soglia_consumo_tb =  $base_mc /  $_SESSION['contatore_superamento_soglia_TA'];  // @ overload per evitare errori di caldolo per la divisione per zero 
    @$costo_singolo_mc_tb = $base_lordo / $mc_lordo;
    
    
    for($i = 0; $i < $numero_utenti; $i++){  // non toccare!!!
        if($_var_mc_TB[$i] != 0){
            
         if($_var_mc_TB[$i] < $soglia_consumo_tb){
           
               
            $differenza_soglia_TB = $differenza_soglia_TB  + ($soglia_consumo_tb - $_var_mc_TB[$i]);
             
       }else{
             
            $contatore_superamento_soglia_TB++;
           
       }
        
    }
        
    }
    
    for($i = 0; $i < $numero_utenti; $i++){  //calcoli finali per tb
        
        if($_var_mc_TB[$i] == 0){
            
            $tb_array[$i] = 0;
            
        }else{

         if($_var_mc_TB[$i] < $soglia_consumo_tb){
           
                $tb_array[$i] = $_var_mc_TB[$i] * $costo_singolo_mc_tb;  // valore da ritornare per tb
               
            }else{
           
                $tb_array[$i] = ($soglia_consumo_tb + ($differenza_soglia_TB / $contatore_superamento_soglia_TB)) * $costo_singolo_mc_tb;  // valore da ritornare
          
       
        
    }
                 
                 
                 
        }
      
        
    }
    
    return $tb_array;
}
    
    
$TB_mc_output = _TB_tabella($_SESSION['base_mc'],$_SESSION['base_lordo'],$_SESSION['base_mc'],$TB_mc,$_SESSION['num_utenti']);

//var_dump($TB_mc_asds);
    
 
 function stampaTabella($consumi_array,$quote_fisse,$quoteVariabili_Array,$TA_,$TB_mc_output,$id){
    $output = '';
    $statment_condomio = connect("test")->query("SELECT * FROM utenti_condominio WHERE id_condominio = '".$id."'");
    for($i = 0; $i< $rows = $statment_condomio->fetch(PDO::FETCH_NUM);$i++){                      


                $output .= ' <tr> <td><input type="text" value='.$rows[1].' /></td>';
                
                    
                    



                $output .= ' <td><input  type="text"  value='.$consumi_array[$i].' /></td>
                <td><input  type="text"  value='.$quote_fisse.' /></td>
                <td><input  type="text" value='.round($quoteVariabili_Array[$i],2).' /></td>';
                    $output  .= '<td><input  type="text" value='.round($TA_[$i],2).' /></td>'; 

                $output  .= '<td><input  type="text" value='.$TB_mc_output[$i].' /></td>
                <td><input  type="text"  /></td>
                <td><input  type="text"/></td>
                <td><input  type="text"/></td>

                <td><input  type="text"/></td>
                <td><input  type="text"/></td>
                <td><input  type="text"/></td>
                <td><input  type="text"/></td>
                <td><input  type="text"  /></td>                                      
                </tr>';     

                }
    
    echo $output;
               
}

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
            
     stampaTabella($consumi_array,$quote_fisse,$quoteVariabili_Array,$TA_,$TB_mc_output,$id);
        
            
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
