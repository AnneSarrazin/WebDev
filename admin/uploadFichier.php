
<?php
$dossier_cible = $_SERVER['DOCUMENT_ROOT']."/Mandeline/Base Site/docs"; //Pour changer le dossie cible c'est ici.
$fichier_cible = $dossier_cible . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

//Vérification que le fichier n'existe pas déjà
if (file_exists($fichier_cible)) {
    echo "Le fichier existe déjà!";
    $uploadOk = 0;
}
//Vérification de la taille du fichier (ici 5Mo max)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Ce fichier est trop gros!";
    $uploadOk = 0;
}
//Vérifier si l'une des erreurs au dessus a mis uploadOk à 0
if ($uploadOk == 0) {
    echo "Désolé, votre fichier n'a pas pu être envoyé";
//Tout semble bon, on tente l'upload
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fichier_cible)) {
        echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a été envoyé.";
    } else {
        echo "Désolé, il y a eu un problème.";
    }
}
?>