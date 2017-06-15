<?php

include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Locataire.php";
include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Commentaire.php";

$nom = (isset($_GET["Nom"])) ? $_GET["Nom"] : NULL; 
$prenom = (isset($_GET["Prenom"])) ? $_GET["Prenom"] : NULL;
$mail = (isset($_GET["Mail"])) ? $_GET["Mail"] : NULL;
$idResa = (isset($_GET["IdResa"])) ? $_GET["IdResa"] : NULL;
$contenu = (isset($_GET["Contenu"])) ? $_GET["Contenu"] : NULL;

if ($nom && $prenom && $mail && $idResa && $contenu)
    { 
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=mandeline_resa;charset=utf8', 'root', '');
            $locataire = new Locataire($dbh,$nom,$prenom,$mail);
            if($locataire->creation($dbh) == TRUE)
                {
                    echo "Le locataire " . $nom . " a été ajouté avec succès. "; 
                }else
                    {
                        echo "Le locataire était déjà dans la base de données. ";
                    }
            $commentaire = new Commentaire($dbh,$contenu,$locataire->getId(),$idResa, NULL, 0);
            if($commentaire->creation($dbh) == TRUE)
                {
                    echo "Le commentaire de " . $nom . " a été ajouté avec succès."; 
                }else
                    {
                        echo "Un commentaire identique était déjà dans la base de données!";
                    }
            
        }  catch (PDOExcpetion $e){
            //print "ERREUR : " . $e->getMessage() . "<br/>";
            die();            
        }
       
    } else
        { 
        echo "Erreur lors de l'ajout du commentaire."; 
        } 
