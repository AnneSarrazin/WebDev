<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
$urlSite = 'http://localhost/Mandeline';
$urlReponse = $urlSite.'../ReponseCommentaire/ReponseCommentaire.php?Contenu=';
$urlValidation = $urlSite.'/ValidationCommentaire/ValidationCommentaire.php?Contenu=';
$urlSuppression = $urlSite.'/SuppressionCommentaire/SuppressionCommentaire.php?Contenu=';
include("../commentaire.php");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../Style/Tableaux.css" rel="stylesheet" type="text/css"/>
        <link href="../Style/Indicateurs.css" rel="stylesheet" type="text/css"/>
        <link href="../Style/General.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include("../Header/HeaderAdmin.php") ;
        try
        {
            echo '<table>';
            echo '<tr><th>Nom</th><th>Commentaire</th><th>Est validé</th></tr>';
            $dbh = new PDO('mysql:host=localhost;dbname=mandeline', 'root', '');
            foreach ($dbh->query('SELECT * FROM commentaire') as $row)
            {
                $contenu = $row["contenu"];
                $validation = "non";
                if($row["valide"] == 1)
                {
                    $validation = "oui";
                }
                $com = $row["idCom"];
                $cmd = $dbh->query('SELECT nom, prenom FROM locataire INNER JOIN commentaire USING(idLocataire) WHERE idLocataire = '.$row["idLocataire"].'');
                if($cmd != NULL)
                {
                    foreach ($cmd as $row2)
                    {
                        $nom = $row2["nom"];
                        $prenom = $row2["prenom"];
                    }
                }else
                {
                    $nom = "Inconnu";
                    $prenom = " ";
                }
                echo '<tr><td>'.$nom.' '.$prenom.'</td><td>'.$contenu.'</td><td>'.$validation.'</td>';
                echo'<td id="hors" ><a href="'.$urlValidation.$contenu.'&Nom='.$nom.'&Prenom='.$prenom.'&Com='.$com.'"><img id ="indicateur" src="../Indicateurs/Valider.png" title="Valider" ></a></td>';
                echo'<td id="hors" ><a href="'.$urlReponse.$contenu.'&Nom='.$nom.'&Prenom='.$prenom.'&Com='.$com.'"><img id ="indicateur" src="../Indicateurs/Modifier.png" title="Repondre" ></a></td>';
                echo'<td id="hors" ><a href="'.$urlSuppression.$contenu.'&Nom='.$nom.'&Prenom='.$prenom.'&Com='.$com.'"><img id ="indicateur" src="../Indicateurs/Supprimer.png" title="Supprimer" ></a></td></tr>';
            }
            echo '</table>';
        }  catch (PDOException $e)
        {
            print $e;
        }
        include("../Footer/Footer.php") ;
        ?>
    </body>
</html>
