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
        include $_SERVER['DOCUMENT_ROOT']."/Mandeline/LivredorFonctions.php";

        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa;charset=utf8', 'root','');


        $Tab = array();
        $compteur=0;
        foreach($dbh->query('SELECT * FROM commentaire') as $row){
            $Tab[$compteur]=$row;
            $compteur++;
        }
        if (isset($Tab))
        {
            for($i = 0; $i<count($Tab); $i++)
            {
                if($Tab[$i][2]==1 && !isset($Tab[$i][5])) //On n'affiche pas les commentaires non validés, ni les réponses. Celles-ci sont traitées séparément.
                {
                    echo '<div class=\'commentaire\'>';
                    afficheCommentaire($dbh, $Tab, $i);
                    for($j = 0; $j<count($Tab); $j++) //On cherche une (ou plusieurs!) réponse(s) a ce commentaire. Si il y en a une, on l'affiche.
                    {   
                        if($Tab[$j][5] == $Tab[$i][0] && $Tab[$j][2]==1) //Si l'ID du commentaire correspond avec l'ID de réponse de la cible et que le commentaire est valide, c'est bien une réponse à afficher.
                        {
                            echo '<div class=\'Reponse\'>';
                            afficheCommentaire($dbh, $Tab, $j);
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
            }
        }
        ?>
    </body>
</html>

