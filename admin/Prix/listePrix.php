<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr><th>Date de début</th><th>Date de fin</th><th>Prix</th><th>Supprimer</th></tr>
        <?php
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
        foreach($dbh->query('SELECT * FROM prix') as $row){
            echo "<tr><td>".$row['dateDeb']."</td><td>".$row['dateFin']."</td><td>".$row['Tarif']."€</td><td><a href=\"SupprimePrix.php?dateDeb=".$row['dateDeb']."&dateFin=".$row['dateFin']."&Tarif=".$row['Tarif']."\">Supprimer</a></td></tr>";
        }
        ?>
        </table>
    </body>
</html>
