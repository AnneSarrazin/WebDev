<!DOCTYPE html>
<html>
    <head>
        <title>Suppression de fichiers et images</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table>
            <tr>
                <th>Image</th>
                <th>Supprimer</th>
            </tr>
            <?php

            $nb_fichier = 0;
            if($dossier = opendir('../Base Site/images'))
            {
                while(false !== ($fichier = readdir($dossier)))
                {
                    echo '<tr>';
                    if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
                    {
                        $nb_fichier++; // On incrémente le compteur de 1
                        echo '<td><a href="../Base Site/images/'.$fichier.'">'.$fichier.'</a></td>';
                        echo '<td><form action="remove.php" method="post"><button type="submit" name="Address" value="../Base Site/images/'.$fichier.'" class="btn-link">Supprimer</button></form></td>';
                    }
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <p>Fichiers: TODO (il faut le dossier où ils se trouvent pour ça)</p>
    </body>
</html>