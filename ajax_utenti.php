<?php
session_start();
require("./connection_database.php");
/*
ALTER TABLE `utenti_condominio` CHANGE `id` `id` INT(255) NOT NULL AUTO_INCREMENT, CHANGE `numero_persone` `numero_persone` INT(255) NOT NULL, CHANGE `lettura_precedente` `lettura_precedente` INT(255) NOT NULL, CHANGE `lettura_attuale` `lettura_attuale` INT(255) NOT NULL, CHANGE `consumo_periodico` `consumo_periodico` INT(255) NOT NULL, CHANGE `importi_versati` `importi_versati` INT(255) NOT NULL, CHANGE `id_condominio` `id_condominio` INT(255) NOT NULL;

METTERE TUTTO DOUBLE
*/


// controlli
if(!isset($valori_utente)){
    $var_ = "0";
    $var_0 = "0";
    $var_1 = "0";
    $var_2 = "0";
    $var_3 = "0";
    $var_4 = "0";
    $var_5 = "0";
    $i = 0;
    
}


if($_SESSION['accreditato'] == false){ // controllo se sia loggato

    header("Location: ./index.php");
}
$contenuto = '';

// recupero dati 
if(isset($_GET['q'])){

    $q = $_GET['q'];
    $valori_utente = explode(';', $q);  // creo l'array
    
    $var_0 = strval($valori_utente[0]);
    $var_1 = doubleval($valori_utente[1]);
    $var_2 = doubleval($valori_utente[2]);
    $var_3 = doubleval($valori_utente[3]);
    $var_4 = doubleval($valori_utente[4]);
    $var_5 = doubleval($valori_utente[5]);
    $id_cond = intval($_SESSION['condominio_in_uso']);
 
    

    $statment = connect("test")->prepare("INSERT INTO utenti_condominio (nome,numero_persone,lettura_precedente,lettura_attuale,consumo_periodico,importi_versati,id_condominio) VALUES (?,?,?,?,?,?,?)");

    $statment->execute([
        $var_0,
        $var_1,
        $var_2,
        $var_3,
        $var_4,
        $var_5,
        $id_cond
    ]);

    
    $_SESSION['condominio']=$id_cond;
    //CRIPTARE COMUNICAZIONE ------
    $statment_condomio = connect("test")->query("SELECT * FROM utenti_condominio ORDER BY id DESC");

    while($rows = $statment_condomio->fetch(PDO::FETCH_NUM)){
        $contenuto .= ' <tbody>
                                    <tr>
                                        <td align="center">
                                            <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
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



//if(sizeof($valori_utente) != 5){
//    
//    echo "<p style='color:red;'> INSERISCI TUTTI I VALORI </p>";
//    
//}else {

    
    
    
//}



?>