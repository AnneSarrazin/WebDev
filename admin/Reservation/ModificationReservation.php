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
        <script src="AJAX_Modification_Locataire.js" type="text/javascript"></script>
    </head>
    <body>
        <h2>Modification d'une réservation</h2>
        <?php
        $DateDeb=$_GET['DateDeb'];
        $DateFin=$_GET['DateFin'];
        $Locataire=$_GET['Locataire'];
        ?>
        <form method="post" action="ModificationResaPHP.php">
            <fieldset>
                <legend>Modification des dates:</legend>
                <label for="dateDeb">Date de début de la réservation : </label><br/>
                <input name="dateDeb" type="date" value="<?php echo $DateDeb ?>" required/><br>
                <input type="hidden" name="saveDateDeb" value="<?php echo $DateDeb?>"/>
                <label for="dateFin">Date de fin de la réservation : </label><br>
                <input name="dateFin" type="date" value="<?php echo $DateFin?>" required/><br/><br/>
                <input type="hidden" name="saveDateFin" value="<?php echo $DateFin?>"/>
                <input type="submit" id="btn_envoyer" value="Modifier les dates"/>
            </fieldset>
        </form>
        <form method="post" action="ModificationReservationLoc.php">
            <fieldset>
                <legend>Modification du locataire :</legend>
                <label for="nom">Entrez le nom de famille du locataire :</label>
                <input type="text" name="nom" value="<?php echo $Locataire?>" onchange="request(this);"/>
                <input type="hidden" name="saveDateDeb" value="<?php echo $DateDeb?>"/>
                <input type="hidden" name="saveDateFin" value="<?php echo $DateFin?>"/>
                <select name="locataire" id="locataire" required></select> <br/><br/>
                <input type="submit" id="btn_envoyer_loc" value="Modifier le locataire"/>
            </fieldset>
            
        </form>
        
    </body>
</html>
