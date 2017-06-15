<html>
    <head>
        <title>Liste des réservations</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
        $compteur=0;
        foreach($dbh->query('SELECT * FROM Reservation') as $row){
            $Tab[$compteur]=$row;
            $compteur++;
        }
        if(!isset($Tab))
        {
            echo '<p>Il n\'y a aucune réservation actuellement!</p>';
        }
        else
        {
        echo('
        <table>
            <tr>
                <th>Date de début de réservation</th>
                <th>Date de fin de réservation</th>
                <th>Nom du locataire</th>
                <th>Etat</th>
                <th>Changement d\'état</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>');
        
            for($i = 0; $i<count($Tab);$i++)
            {
                if(!is_null($Tab[$i][3]))
                {
                    $stmt = $dbh->prepare('SELECT nom, prenom FROM locataire WHERE idLocataire = '.$Tab[$i][3]); //On récupère le nom et le prénom correspondant au locataire de la réservation
                    $stmt->execute(); 
                    $NomPrenom = $stmt->fetch();
                }
                else
                {
                    $NomPrenom = Array(null,null);
                }
                echo '<tr>';
                for($j = 1; $j<5;$j++)
                {
                    echo '<td>';
                    if($j == 4)
                    {
                        if ($Tab[$i][$j] == 0)
                        {
                            Echo 'En attente';
                        }
                        else if($Tab[$i][$j]==1)
                        {
                            Echo 'Validée';
                        }
                        else if($Tab[$i][$j]==2){
                            echo 'Appartement non diponible';
                        }
                    }
                    else if($j == 3 && !is_null($Tab[$i][$j])) //La quatrième colonne de ce tableau est celle correspondant à l'ID du locataire
                    {
                        echo $NomPrenom[0].' '.$NomPrenom[1];
                    }
                    else
                    {
                        echo $Tab[$i][$j];
                    }
                    echo '</td>';
                }
                echo '<td>';
                echo '<a href = \'ValidationResa.php?IdResa='.$Tab[$i][0].'&DateDeb='.$Tab[$i][1].'&DateFin='.$Tab[$i][2].'\'>Changer l\'état</a>';
                echo '</td>';
                
                echo '<td>';
                echo '<a href = \'ModificationResa.php?IdResa='.$Tab[$i][0].'&DateDeb='.$Tab[$i][1].'&DateFin='.$Tab[$i][2].'&Valide='.$Tab[$i][4].'&Locataire='.$NomPrenom[0].'\'>Modifier</a>';
                echo '</td>';
                
                echo '<td>';
                echo '<a href = \'SuppressionResa.php?IdResa='.$Tab[$i][0].'&DateDeb='.$Tab[$i][1].'&DateFin='.$Tab[$i][2].'\'>Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
        </table>
        <p>Pour ajouter une réservation manuellement, <a href='CreationResa.php'>cliquez ici</a>.</p>
    </body>
</html>