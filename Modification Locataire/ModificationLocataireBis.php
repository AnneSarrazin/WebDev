<?php

include $_SERVER['DOCUMENT_ROOT']."Mandeline/Locataire.php";

$nom = (isset($_GET["Nom"])) ? $_GET["Nom"] : NULL; 
$prenom = (isset($_GET["Prenom"])) ? $_GET["Prenom"] : NULL;
$mail = (isset($_GET["Mail"])) ? $_GET["Mail"] : NULL;

$nomAncien = (isset($_GET["NomA"])) ? $_GET["NomA"] : NULL; 
$prenomAncien = (isset($_GET["PrenomA"])) ? $_GET["PrenomA"] : NULL;
$mailAncien = (isset($_GET["MailA"])) ? $_GET["MailA"] : NULL;

if ($nom && $prenom && $mail)
    { 
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=mandeline', 'root', '');
            $locataire = new Locataire($dbh,$nomAncien,$prenomAncien,$mailAncien);
            if($locataire->modification($dbh,ucfirst($nom),ucfirst($prenom),$mail) == TRUE)
                {
                    echo "Le locataire " . $nom . " a été modifié avec succès "; 
                }else
                    {
                        echo "Erreur lors de la modification du locataire";
                    }
            
        }  catch (PDOExcpetion $e){
            //print "ERREUR : " . $e->getMessage() . "<br/>";
            die();            
        }
       
    } else
        { 
        echo "Erreur lors de la modification du locataire"; 
        } 
