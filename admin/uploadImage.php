
<?php
$dossier_cible = $_SERVER['DOCUMENT_ROOT']."/Mandeline/Base Site/images"; //Pour changer le dossie cible c'est ici.
$fichier_cible = $dossier_cible . basename($_FILES["imageToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($fichier_cible,PATHINFO_EXTENSION);
//Vérification que le fichier est bien une image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "C'est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Ce n'est pas une image.";
        $uploadOk = 0;
    }
}
//Vérification que le fichier n'existe pas déjà
if (file_exists($fichier_cible)) {
    echo "Le fichier existe déjà!";
    $uploadOk = 0;
}
//Vérification de la taille du fichier (ici 5Mo max)
if ($_FILES["imageToUpload"]["size"] > 5000000) {
    echo "Ce fichier est trop gros!";
    $uploadOk = 0;
}
//N'autoriser que certains formats image
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
    $uploadOk = 0;
}
//Vérifier si l'une des erreurs au dessus a mis uploadOk à 0
if ($uploadOk == 0) {
    echo "Désolé, votre fichier n'a pas pu être envoyé";
//Tout semble bon, on tente l'upload
} else {
    if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $fichier_cible)) {
        echo "Le fichier ". basename( $_FILES["imageToUpload"]["name"]). " a été envoyé.";
    } else {
        echo "Désolé, il y a eu un problème.";
    }
}
?>
