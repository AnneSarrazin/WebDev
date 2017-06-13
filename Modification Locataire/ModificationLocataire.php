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
        <title></title>
        <script language="javascript" src="ModificationLocataire.js"></script>
    </head>
    <body>
        <?php
        if($nom && $prenom && $mail)
            {
                echo '<form id="formulaire">';
                echo '<p>';
                
                echo '<input type="hidden" id="ancienNom" style="display : none;" value="'.$nom.'" />';
                echo '<input type="hidden" id="ancienPrenom" style="display : none;" value="'.$prenom.'"/>';
                echo '<input type="hidden" id="ancienMail" style="display : none;" value="'.$mail.'"/>';
                
                echo 'Nom du Locataire : <input type="text" id="nomLocataire" value="'.$nom.'" required />';
                echo 'Prenom du Locataire : <input type="text" id="prenomLocataire" value="'.$prenom.'" required />';
                echo 'Mail du Locataire : <input type="email" id="nomLocataire" value="'.$mail.'" required />';
                echo '<input type="button" onclick="request(readData)" id="validation" value="valider" />';
                echo '</p>';
                echo '</form>';
            }else
                {
                   
                }
        ?>
    </body>
</html>
