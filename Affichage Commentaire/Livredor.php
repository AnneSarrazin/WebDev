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
                {
                    echo '<div class=\'commentaire\'>';
                    afficheCommentaire($dbh, $Tab, $i);
                    {   
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

