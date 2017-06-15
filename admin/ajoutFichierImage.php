<!DOCTYPE html>
<html>
    <head>
        <title>Ajout de fichiers et images</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

<h1>Envoi de fichiers sur le serveur</h1>

<form action="uploadImage.php" method="post" enctype="multipart/form-data">
    Pour envoyer une image sur le serveur:
    <input type="file" name="imageToUpload" id="imageToUpload">
    <input type="submit" value="Envoyer" name="submit">
</form>

<form action="uploadFichier.php" method="post" enctype="multipart/form-data">
    Pour envoyer un fichier d'un autre type:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Envoyer" name="submit">
</form>

</body>
</html>
