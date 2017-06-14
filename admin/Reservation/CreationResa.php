<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="AJAX_Modification_Locataire.js" type="text/javascript"></script>
    </head>
    <body>
        <form action="CreationResaPHP.php" method="post">
            <fieldset>
                <legend>Dates de réservation : </legend>
                <label for="DateDeb">Date de début de location :</label><br/>
                <input type="date" name="DateDeb" id="DateDeb" value="<?php echo date('Y-m-d')?>"required=""/><br/>
                <label for="DateFin">Date de fin de location</label><br/>
                <input type="date" name="DateFin" id="DateFin" value="<?php echo date('Y-m-d')?>" required=""/><br/>
            </fieldset>
            <fieldset>
                <legend>Locataire : </legend>
                <label for="nom">Entrez le nom de famille du locataire :</label>
                <input type="text" name="nom" onchange="request(this);"/>
                <select name="locataire" id="locataire" value="NULL"></select> <br/><br/>
            </fieldset>
            
            <input type="submit" value="Créer une nouvelle réservation"/>
        </form>
              
    </body>
</html>
