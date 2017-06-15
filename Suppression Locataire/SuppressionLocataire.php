<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include $_SERVER['DOCUMENT_ROOT']."Mandeline/Locataire.php";

$urlSite = 'http://localhost/Mandeline';

$nom = (isset($_GET["Nom"])) ? $_GET["Nom"] : NULL; 
$prenom = (isset($_GET["Prenom"])) ? $_GET["Prenom"] : NULL;
$mail = (isset($_GET["Mail"])) ? $_GET["Mail"] : NULL;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script language="javascript" src="SuppressionLocataire.js"></script>
        <title></title>
    </head>
    <body>
        <?php
        if($nom && $prenom && $mail)
            {
                echo '<p>Suppression du Locataire '.$prenom.' '.$nom.'</p>';
            
                echo '<form id="formulaire">';
                echo '<p>';
                
                echo '<input type="hidden" id="nom" style="display : none;" value="'.$nom.'" />';
                echo '<input type="hidden" id="prenom" style="display : none;" value="'.$prenom.'"/>';
                echo '<input type="hidden" id="mail" style="display : none;" value="'.$mail.'"/>';
                
                echo '<input type="button" onclick="request(readData)" id="validation" value="Supprimer" />';
                echo '</p>';
                echo '</form>';
            }else
                {
                   echo '<a href="http://localhost/Mandeline/ListeLocataire/ListeLocataire.php">Retour vers la liste de Locataire</a>';
                }
        ?>
    </body>
</html>
