<?php
    $lieuChoisi = (isset($_POST["LieuChoisi"])) ? $_POST["LieuChoisi"] : NULL;
    echo $lieuChoisi;
    include('twig.php');
    $dbh = new PDO('mysql:host=localhost;dbname=mandeline_photos', 'root', '');
    
    $compteur=0;
    foreach($dbh->query('SELECT * FROM Photos') as $row){
        $Tab1[$compteur]=$row;
        $compteur++;
    }
    foreach($dbh->query('SELECT * FROM Lieu') as $row){
        $Tab2[$compteur]=$row;
        $compteur++;
    }
    $template = $twig->loadTemplate('GalleriePhoto.twig');
    echo $template->render(array(
    'TableauPhotos' => $Tab1,
    'TableauLieu' => $Tab2,
    'LieuChoisi' => $lieuChoisi

    )); 

?>