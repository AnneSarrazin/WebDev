<?php

include $_SERVER['DOCUMENT_ROOT']."Mandeline/Commentaire.php";

$com = (isset($_GET["Com"])) ? $_GET["Com"] : NULL;

try{
    $dbh = new PDO('mysql:host=localhost;dbname=mandeline', 'root', '');
    $stmt = $dbh->prepare('DELETE FROM commentaire WHERE idCom = ?');
    $stmt->bindParam(1,$com);
    $stmt->execute();
    echo "Le commentaire a été supprimé avec succès "; 
}  catch (PDOExcpetion $e){
    //print "ERREUR : " . $e->getMessage() . "<br/>";
    die();            
}
