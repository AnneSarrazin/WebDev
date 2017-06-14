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
    </head>
    <body>
        <form action="AjoutTarifPHP.php" method="post">
            <fieldset>
                <label for="dateDeb">Entrez le début de la période : </label><br/>
                <input type="date" name="dateDeb" value="<?php echo date('Y-m-d')?>"/><br/>
                <label for="dateFin">Entrez la fin de la période : </label><br>
                <input type="date" name="dateFin" value="<?php echo date('Y-m-d')?>"/><br/>
                <label for="tarif">Entrez le tarif pour la période :</label><br/>
                <input type="number" name="tarif" step="0.01"/><br/>
                <input type="submit" value="Créer"/>
            </fieldset>
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
