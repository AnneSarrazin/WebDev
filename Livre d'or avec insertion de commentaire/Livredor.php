<html>
    <head>
        <title>Livre d'or</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script language="javascript" src="InsertionCommentaire.js"></script>
        <style>
        .commentaire, .Reponse {
            border-style: solid;
            padding: 1em;
        }
        .commentaire {
            margin-bottom: 5em;
        }
        </style>
    </head>
    <body>
        <h1>Liste des commentaires</h1>
        <?php

        include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Locataire.php";
        include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Commentaire.php";
        include $_SERVER['DOCUMENT_ROOT']."/Mandeline/Resa.php";
        include "LivredorFonctions.php";

        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa;charset=utf8', 'root','');
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


        $TabCommentaires = array();
        $compteur=0;
        foreach($dbh->query('SELECT * FROM commentaire') as $row){
            $TabCommentaires[$compteur]=$row;
            $compteur++;
        }
        
        $TabReservation = array();
        $compteur=0;
        foreach($dbh->query('SELECT * FROM Reservation') as $row){
            $Tab[$compteur]=$row;
            $compteur++;
        }
        //echo "<pre>";
        //print_r($Tab);
        //echo "</pre>";
        if (isset($TabCommentaires))
        {
            for($i = 0; $i<count($TabCommentaires); $i++)
            {
                if($TabCommentaires[$i][2]==1 && !isset($TabCommentaires[$i][5])) //On n'affiche pas les commentaires non validés, ni les réponses. Celles-ci sont traitées séparément.
                {
                    echo '<div class=\'commentaire\'>';
                    afficheCommentaire($dbh, $TabCommentaires, $i);
                    for($j = 0; $j<count($TabCommentaires); $j++) //On cherche une (ou plusieurs!) réponse(s) a ce commentaire. Si il y en a une, on l'affiche.
                    {   
                        if($TabCommentaires[$j][5] == $TabCommentaires[$i][0] && $TabCommentaires[$j][2]==1) //Si l'ID du commentaire correspond avec l'ID de réponse de la cible et que le commentaire est valide, c'est bien une réponse à afficher.
                        {
                            echo '<div class=\'Reponse\'>';
                            afficheCommentaire($dbh, $TabCommentaires, $j);
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
            }
        }
        ?>
        <form id="formulaire" action="InsertionCommentaireTraitement.php" method="post">
            <p>
                Nom du locataire : <input type="text" name="Nom" /> <br />
                Prénom du locataire : <input type="text" name="Prenom" /> <br />
                Mail du locataire : <input type="email" name="Mail" /> <br />
                Vos date de réservation :
                <select name="IdResa">
                <option value=''>Choisissez vos dates</option>
                <?php
                for($i=0; $i<Count($TabReservation); $i++)
                {
                    if($TabReservation[$i][4] == 1) //On ne choisit d'afficher que les réservations validées
                    {
                        echo "<option value='".$TabReservation[$i][0]."'>Du ".$TabReservation[$i][1]." au ".$TabReservation[$i][2]."</option>";
                    }
                }
                ?>
                </select> <br />
                Votre commentaire : <textarea rows="4" cols="50" placeholder="Votre commentaire..." name="Contenu" /></textarea <br />
                <button type="submit">Envoyer</button>
            </p>
        </form>
    </body>
</html>

