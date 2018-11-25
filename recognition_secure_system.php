<?php
session_start();
require("./connection_database.php");
// dichiarazioni variabili
$_SESSION['accreditato'] = false;
$_SESSION['registrato'] = false; // controllo successivo una volta registrato


//login
if(isset($_POST['username_login'] and $_POST['password_login'])){
    
    $username = $_POST['username_login'];
    $password = $_POST['password_login'];
    
    check_data($username,$password);
    
}


function check_data($username_L,$password_L){
    
    
    
}

//registrazione


if(isset($_POST['username_registrazione'] and $_POST['password_registrazione'] and $_POST['name'] and $_POST['surname'] and $_POST['business_name'] and $_POST['piva']){
    
    $username = $_POST['username_registrazione'];
    $password = $_POST['password_registrazione'];
    $name = $_POST['name'];
    $surname = ,$_POST['surname'];
    $business_name = $_POST['business_name'];
    $piva  = $_POST['piva'];
    check_duplicates_data($username,$email,$name,$surname,$password,$business_name,$piva);
    
}else{

    echo "403";exit(); // Inserire tutti i dati
}

function check_duplicates_data($username_C,$email_C,$name_C,$surname_C,$password_C,$business_name_C,$piva_C){  // controllare che l'utente non sia già registrato con quel username o email in caso contrario registra l'account
   
    try{

    $statment = connect("test")->prepare("SELECT * FROM users WHERE username = :user or email = :email LIMIT 1");
    $statment->bindValue(':user', $username_C, PDO::PARAM_STR);
    $statment->bindValue(':email', $email_C, PDO::PARAM_STR);

    $statment->execute();

    if ($statment->rowCount() > 0){

    return "404";exit(); // avvisa l'utente che l'username o l'email sono già esistenti nel sistema.

    }else{
        
        if(strlen($password_c) >= 8){  // controllo che la password sia lunga almeno 8 caratteri
           
            $password_c = md5($password_c);
            
            if(strlen($piva_C) >= 11){
                
                if (!filter_var($email_user, FILTER_VALIDATE_EMAIL)) { // controllo che l'email abbia un formato giusto

                    echo "399";exit();  // email errata

                }else{ // se tutti i controlli sono andati a buon fine, registro l'acount
                    
                    try{
                        
                        $statment = connect("test")->prepare("INSERT INTO users (username,password,email,name,surname,business,piva) VALUES (?,?,?,?,?,?,?)");

                        $statment->execute([
                            $username_C,
                            $password_C,
                            $email_C,
                            $name_C,
                            $surname_C,
                            $business_name_C,
                            $piva_C
                        ]);
                        
                        $_SESSION['accreditato'] = true;
                        header("Location: ./signUp_success.php");
                        
                }catch (PDOException $e) {

                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();

                     }

                }
                
                
            }else{
                
                return "405";exit(); // criterio Partiva IVA non valido

            }
            
        }else{
            
            return "406";exit(); // criterio password non valido
        }
 
    }
        
    }catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";
    die();

}

    
}



?>