<?php

include $_SERVER['DOCUMENT_ROOT']."Mandeline/Commentaire.php";

$com = (isset($_GET["Com"])) ? $_GET["Com"] : NULL;

try{
    $dbh = new PDO('mysql:host=localhost;dbname=mandeline', 'root', '');
    $stmt = $dbh->prepare('UPDATE commentaire SET valide = 1 WHERE idCom = ?');
    $stmt->bindParam(1,$com);
    $stmt->execute();
    echo "Le commentaire a été validé avec succès "; 
}  catch (PDOExcpetion $e){
    //print "ERREUR : " . $e->getMessage() . "<br/>";
    die();            
}