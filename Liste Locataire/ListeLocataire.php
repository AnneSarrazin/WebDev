<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
$urlSite = 'http://localhost/Mandeline';
$urlAjout = $urlSite.'/InsertionLocataire/InsertionLocataire.php';
$urlModification = $urlSite.'/ModificationLocataire/ModificationLocataire.php?Nom=';
$urlSuppression = $urlSite.'/SuppressionLocataire/SuppressionLocataire.php?Nom=';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../Style/Tableaux.css" rel="stylesheet" type="text/css"/>
        <link href="../Style/Indicateurs.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include("../Header/HeaderAdmin.php");
        try
        {
            echo '<table>';
            echo '<tr><th>Nom</th><th>Prenom</th><th>Adresse Mail</th><th><a href="'.$urlAjout.'"><img id ="indicateur" src="../Indicateurs/Ajouter.png" title="Ajouter" ></a></th></tr>';
            $dbh = new PDO('mysql:host=localhost;dbname=mandeline', 'root', '');
            foreach ($dbh->query('SELECT * FROM locataire') as $row)
                {
                    echo '<tr>';
                    echo '<td>'.$row["nom"].'</td>';
                    echo '<td>'.$row["prenom"].'</td>';
                    echo '<td>'.$row["adresseMail"].'</td>';
                    echo '<td><a href="'.$urlModification.$row["nom"].'&Prenom='.$row["prenom"].'&Mail='.$row["adresseMail"].'"><img id ="indicateur" src="../Indicateurs/Modifier.png" title="Modifier" ></a></td>';
                    echo '<td><a href="'.$urlSuppression.$row["nom"].'&Prenom='.$row["prenom"].'&Mail='.$row["adresseMail"].'"><img id ="indicateur" src="../Indicateurs/Supprimer.png" title="Supprimer" ></a></td>';
                    echo '</tr>';
                }
            echo '</table>';
        }  catch (PDOException $e)
        {
            
        }
        ?>
    </body>
</html>
