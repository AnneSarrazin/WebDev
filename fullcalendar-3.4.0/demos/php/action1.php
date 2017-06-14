<?php

 /* Configuration des options de connexion */
    
    /* Désactive l'éumlateur de requêtes préparées (hautement recommandé)  */
    $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
    
    /* Active le mode exception */
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    
    /* Indique le charset */
    $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
    
    /* Connexion */
    try
    {     
    $hostname = "localhost";
    $database = "mandeline";
    $username = "root";
    $password = "";
    $table = "reservation";
    
     $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
     
     
     $requete = "SELECT * FROM $table WHERE id_valib = 1";
     $req_prep = $connect->prepare($requete);
     $req_prep->execute();
     $resultat = $req_prep ->fetchAll(PDO::FETCH_ASSOC);
     
     $json=  json_encode($resultat);
     echo $json;
     
     
     
      
      
    } catch (Exception $e) {
            
         die('Erreur : ' . $e->getMessage());
    
            
    }

?>

