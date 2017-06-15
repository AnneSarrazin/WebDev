<?php

include $_SERVER['DOCUMENT_ROOT']."Mandeline/Locataire.php";
include $_SERVER['DOCUMENT_ROOT']."Mandeline/Commentaire.php";

$com = (isset($_GET["Com"])) ? $_GET["Com"] : NULL; 
$reponse = (isset($_GET["Reponse"])) ? $_GET["Reponse"] : NULL;

$com = str_replace("'", " ", $com);

try{
    $dbh = new PDO('mysql:host=localhost;dbname=mandeline', 'root', '');
    $locataire = new Locataire($dbh,ucfirst("Laverdure"),ucfirst("Pascale"),"pascale.laverdure@gmail.com");
    $Commentaire = new commentaire($dbh, $reponse, $locataire->getId(), null, $com,1);
    $Commentaire->creation($dbh);
    echo "Vous avez répondu avec succès "; 

}  catch (PDOExcpetion $e){
    //print "ERREUR : " . $e->getMessage() . "<br/>";
    die();            
}

