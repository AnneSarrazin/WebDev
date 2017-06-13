<?php

include $_SERVER['DOCUMENT_ROOT']."Mandeline/Locataire.php";

$nom = (isset($_GET["Nom"])) ? $_GET["Nom"] : NULL; 
$prenom = (isset($_GET["Prenom"])) ? $_GET["Prenom"] : NULL;
$mail = (isset($_GET["Mail"])) ? $_GET["Mail"] : NULL;

if ($nom && $prenom && $mail)
    { 
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=mandeline', 'root', '');
            $locataire = new Locataire($dbh,$nom,$prenom,$mail);
            if($locataire->destruction($dbh) == TRUE)
                {
                    echo "Le locataire " . $nom . " a été supprimé avec succès "; 
                }else
                    {
                        echo "Erreur lors de la suppression du locataire";
                    }
            
        }  catch (PDOExcpetion $e){
            //print "ERREUR : " . $e->getMessage() . "<br/>";
            die();            
        }
       
    } else
        { 
        echo "Erreur lors de la suppression du locataire"; 
        } 
