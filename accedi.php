<?php
session_start();
require("./connection_database.php");
$_SESSION['accreditato'] = false;


if($_POST['username'] and $_POST['password']){
    
    // ottengo variabili
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);
    
    $statment = connect("test")->prepare("SELECT * FROM users WHERE username = :user LIMIT 1");
    $statment->bindValue(':user',$username, PDO::PARAM_STR);
    $statment->execute();
    try {
    // se mi trova quel username ...
            if ($statment->rowCount() > 0){

                $data = $statment->fetch(PDO::FETCH_ASSOC);
                $passw_from_database = $data['password'];
                $_SESSION['ID'] = $data['id'];

                if($password == $passw_from_database){

                    $_SESSION['accreditato'] = true; // autenticazione

        //            $data = [  //segno l'ultimo orario di accesso
        //                'user' => $_POST['username'],
        //            ];
        //            $sql_update_last_access = "UPDATE users SET last_access = current_timestamp WHERE username=:user";
        //            $statment= $connessione->prepare($sql_update_last_access);
        //            $statment->execute($data);
                    $_SESSION['username'] = $username;
                    echo "200";exit();  // ok

                }else{

                    echo "403";exit(); // password sbagliata

                }

            }else{

                echo "404";exit();  // non trovo l'account
            }

    
    } catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();

    }
}else{
    
    echo "405"; exit; //dati non inseriti
}


?>