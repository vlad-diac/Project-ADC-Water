<?php
session_start();
require("./connection_database.php");
$_SESSION['accreditato'] = false;
$_SESSION['registrato'] = false;
$id_utente = null;
if($_POST['username'] and $_POST['password'] and $_POST['email'] and $_POST['c_password']){
    
    // get value
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    $password_controllo = false;
    $email_controllo = false;
    $username_controllo = false;

    
    // controlli password, email, username, check terms
    //username
    $statment = connect("test")->prepare("SELECT * FROM users WHERE username = :user or email = :email LIMIT 1");
    $statment->bindValue(':user',$username , PDO::PARAM_STR);
    $statment->bindValue(':email', $email, PDO::PARAM_STR);
    $statment->execute();


    if ($statment->rowCount() > 0){ // controllo che l'username non sia stato preso

        echo "396";exit(); // username o email già esistente



    }else{

        $username_controllo = true;

    }
    //email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 

        echo "397";exit();

    }else{

        $email_controllo = true;

    }
    
    //password
    if($password == $c_password){
        
        $password_controllo = true;
        $password = md5($password);
        
    }else{
        
        echo "399"; exit(); // inseire tutti i valori

    }
    
   
  // se tutti i controlli ritornato true --- creo l'account
    
    if($username_controllo == true and $email_controllo == true and $password_controllo == true){
        
        
        $statment = connect("test")->prepare("INSERT INTO users (username,password,email) VALUES (?,?,?)");

        $statment->execute([
            $username,
            $password,
            $email
        ]);
        
        // ottengo l'ID dell'utente 
        $statment = connect("test")->prepare("SELECT * FROM users WHERE username = :user LIMIT 1");
        $statment->bindValue(':user',$username, PDO::PARAM_STR);
        $statment->execute();
        if ($statment->rowCount() > 0){

            $data = $statment->fetch(PDO::FETCH_ASSOC);
            $id_utente = $data['id'];
            $_SESSION['ID'] = $data['id'];
            
        }
        
        
        // fine id
        
        
        // creo database partizioni
        $statment_partizioni = connect("test")->prepare("INSERT INTO partizioni (id,numeroPartizioni,partizioniRimanenti) VALUES (?,?,?)");

        $statment_partizioni->execute([
            $id_utente,
            0,
            0          
        ]);
        
        // creo database condominio
        
//        $statment_condominio= connect("test")->prepare("INSERT INTO condomini (id) VALUES (?)");
//
//        $statment_condominio->execute([
//            $id_utente,
//                      
//        ]);
        
        
        $_SESSION['registrato'] = true;
        $_SESSION['accreditato'] = true;
        echo "200";exit(); // account aggiunto con successo
       
    }else{
        
        echo "999"; exit(); // errore anomalo

        
    }
    
    
}else{
    
    echo "400"; exit(); // inserire tutti i valori

}


?>