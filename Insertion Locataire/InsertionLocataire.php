<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="InsertionLocataire.js" type="text/javascript"></script>
        <link href="../Style/Formulaire.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include('../Header/HeaderAdmin.php');
        echo '<p id="retour" style="display : none;" >';
        echo '<a href="http://localhost/Mandeline/ListeLocataire/ListeLocataire.php">Retour vers la liste de Locataire</a>';
        echo '</p>';
        
        echo '<div id="formulaire">';
        echo '<p id="titre">Nouveau Locataire</p>';
        echo '<form>';
        echo '<p>';
        echo 'Nom du locataire : <input type="text" id="nomLocataire" required/>';
        echo 'Prénom du locataire : <input type="text" id="prenomLocataire" required/>';
        echo 'Mail du locataire : <input type="email" id="mailLocataire" required/>';
        echo '<input type="button" onclick="request(readData)" id="validation" value="valider" />';
        echo '</p>';
        echo '</form>';
        echo '</div>';
        ?>
    </body>
</html>
