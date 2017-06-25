<?php

include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Locataire.php";
include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Commentaire.php";

$nom = (isset($_POST["Nom"])) ? $_POST["Nom"] : NULL; 
$prenom = (isset($_POST["Prenom"])) ? $_POST["Prenom"] : NULL;
$mail = (isset($_POST["Mail"])) ? $_POST["Mail"] : NULL;
$idResa = (isset($_POST["IdResa"])) ? $_POST["IdResa"] : NULL;
if(empty($idResa))
{
    $idResa = NULL;
}
$contenu = (isset($_POST["Contenu"])) ? $_POST["Contenu"] : NULL;

if ($nom && $prenom && $mail && $contenu)
    { 
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=mandeline_resa;charset=utf8', 'root', '');
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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
            print "ERREUR : " . $e->getMessage() . "<br/>";
            die();            
        }
       
    } else
        { 
        echo "Erreur lors de l'ajout du commentaire."; 
        } 
