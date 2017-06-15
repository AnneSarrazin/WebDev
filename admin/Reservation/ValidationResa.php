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
        <form action="ValidationResaPHP.php" method="post">
            <fieldset>
                <legend>Choisissez le nouvel état de réservation : </legend>
                <input type="radio" name="newValide" value="0" checked>En attente<br>
                <input type="radio" name="newValide" value="1">Validée<br>
                <input type="radio" name="newValide" value="2"> Appartement non dipsonible <br>
                <input type="hidden" name="DateDeb" value="<?php echo $_GET['DateDeb']?>"/>
                <input type="hidden" name="DateFin" value="<?php echo $_GET['DateFin']?>"/>
                <input type="submit" value="Enregister"/>
            </fieldset>
        </form>
    </body>
</html>
