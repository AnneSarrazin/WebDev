<!DOCTYPE html>
<html>
    <head>
        <title>Insertion Commentaire</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script language="javascript" src="InsertionCommentaire.js"></script>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Resa.php";

        $dbh = new PDO('mysql:host=localhost;dbname=mandeline_resa;charset=utf8', 'root', '');

        $compteur=0;
        foreach($dbh->query('SELECT * FROM Reservation') as $row){
            $Tab[$compteur]=$row;
            $compteur++;
        }
        ?>
        <form id="formulaire">
            <p>
                Nom du locataire : <input type="text" id="nomLocataire" /> <br />
                Prénom du locataire : <input type="text" id="prenomLocataire" /> <br />
                Mail du locataire : <input type="email" id="mailLocataire" /> <br />
                Vos date de réservation :
                <select id="idReservation" required>
                <option value=''>Choisissez vos dates</option>
                <?php
                for($i=0; $i<Count($Tab); $i++)
                {
                    if($Tab[$i][4] == 1) //On ne choisit d'afficher que les réservations validées
                    {
                        echo "<option value='".$Tab[$i][0]."'>Du ".$Tab[$i][1]." au ".$Tab[$i][2]."</option>";
                    }
                }
                ?>
                </select> <br />
                Votre commentaire : <textarea rows="4" cols="50" placeholder="Votre commentaire..." id="contenuCommentaire" /></textarea <br />
                <input type="button" onclick="request(readData)" id="validation" value="valider" />
            </p>
        </form>
        
    </body>
</html>
