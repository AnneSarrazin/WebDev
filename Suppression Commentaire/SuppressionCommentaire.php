<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include $_SERVER['DOCUMENT_ROOT']."Mandeline/Locataire.php";

$urlSite = 'http://localhost/Mandeline';

$contenu = (isset($_GET["Contenu"])) ? $_GET["Contenu"] : NULL; 
$nom = (isset($_GET["Nom"])) ? $_GET["Nom"] : NULL;
$prenom = (isset($_GET["Prenom"])) ? $_GET["Prenom"] : NULL;
$com = (isset($_GET["Com"])) ? $_GET["Com"] : NULL;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script language="javascript" src="SuppressionCommentaire.js"></script>
        <link href="../Style/Formulaire.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <?php
        include("../Header/HeaderAdmin.php");

        echo '<div id="formulaire">';
        echo '<p id="titre" >Suppression du Commentaire</p>';
        echo '<form>';        
        echo '<p>';
        echo 'Auteur : '.$nom.' '.$prenom.'<br>';
        echo 'Contenu : '.$contenu;
        echo '<input type="hidden" id="com" style="display : none;" value="'.$com.'"/>';
        echo '<input type="button" onclick="request(readData)" id="validation" value="Supprimer" />';
        echo '</p>';
        echo '</form>';
        echo'</div>';
        include("../Footer/Footer.php");
        ?>
    </body>
</html>
