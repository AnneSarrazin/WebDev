<?php
//fichier XML
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
echo "<list>";
//récupération des données envoyées
$Locataire = (isset($_POST["Nom"])) ? htmlentities($_POST["Nom"]) : NULL;
$Locataire=  addslashes($Locataire);
//on remplit le select
echo"<item id=\"none\" name=\"Selectionnez le locataire\"/> "; 
if ($Locataire) {
   try {
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_resa', 'root', '');
       foreach ($dbh->query("SELECT * FROM locataire WHERE nom LIKE '%$Locataire%' ") as $row) {
            echo "<item id=\"" . $row["idLocataire"] . "\" name=\"". $row["nom"] . " " . $row["prenom"] . "\" />";
        }
    } catch (PDOExcpetion $e) {
        print "ERREUR : " . $e->getMessage() . "<br/>";
        die();
    }
}

echo "</list>";
//fin XML
?>