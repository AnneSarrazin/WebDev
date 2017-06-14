<html>
    <head>
        <title>Liste des réservations</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        
        $ContenuBDD = "Ceci est un commentaire de test!";
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
        $compteur=0;
        foreach($dbh->query('SELECT * FROM Reservation') as $row){
            $Tab[$compteur]=$row;
            $compteur++;
        }
        ?>
    
        <table>
            <tr>
                <th>Date de début de réservation</th>
                <th>Date de fin de réservation</th>
                <th>Nom du locataire</th>
                <th>Validé?</th>
                <th>Valider</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
            for($i = 0; $i<count($Tab);$i++)
            {
                echo '<tr>';
                for($j = 1; $j<5;$j++)
                {
                    echo '<td>';
                    if($j == 3 && !is_null($Tab[$i][$j])) //La quatrième colonne de ce tableau est celle correspondant à l'ID du locataire
                    {
                        $stmt = $dbh->prepare('SELECT nom, prenom FROM locataire WHERE idLocataire = '.$Tab[$i][$j]); //On récupère le nom et le prénom correspondant au locataire de la réservation
                        $stmt->execute(); 
                        $nomPrenom = $stmt->fetch();
                        echo $nomPrenom[0].' '.$nomPrenom[1];
                    }
                    else
                    {
                        echo $Tab[$i][$j];
                    }
                    echo '</td>';
                }
                echo '<td>';
                echo '<a href = \'ValidationResa.php?IdResa='.$Tab[$i][0].'\'>Valider</a>';
                echo '</td>';
                
                echo '<td>';
                echo '<a href = \'ModificationResa.php?IdResa='.$Tab[$i][0].'\'>Modifier</a>';
                echo '</td>';
                
                echo '<td>';
                echo '<a href = \'SuppressionResa.php?IdResa='.$Tab[$i][0].'\'>Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        
    </body>
</html>