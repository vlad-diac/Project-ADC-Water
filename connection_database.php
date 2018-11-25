<?php


function connect($database ,$username = 'root' ,$password= '' ,$host = 'localhost'){
    
    try{
        
        
    $connessione = new PDO('mysql:host='.$host.';dbname='.$database.'', $username, $password);

    }catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();

    }
        
        
        
    
    
    return $connessione;
    
    
    
}




?>