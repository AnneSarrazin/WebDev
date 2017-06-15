<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>La Mandeline</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Locations de la Mandeline">
        <link href="../CSS/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../images/mandeline.png">
        <meta name="author" content="Anne Sarrazin"/>
</head>
<body>
    <header>
        <img id="en_tete" src="../images/PANO_20160816_165610.jpg" alt="Photo appart en-tête"/>
        <h1>La Mandeline Locations</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="Reservations.php">Disponibilités</a></li>
                <li><a href="GaleriePhoto.php">Galerie Photo</a></li>
                <li><a href="Contact.php">Contact</a></li>
                    
            </ul>
        </nav>
    </header>
    <article>
        <form>
            <label for=Nom>Votre Nom</label>
            <input type="text" id="Nom" name="Nom" required/>
            <br>
            <label for=Prenom>Votre Prénom</label>
            <input type="text" id="Prenom" name="Prenom" required/>
            <br> 
            <label for="mail">Votre e-mail</label>
            <input type="email" id="mail" name="name" required>
            <br> 
            <label for="message">Votre message</label><br>
            <textarea name="message" id="message" rows="10" cols="30">Rentrez ici votre message</textarea>
        </form>
      
    </article>
</body>
</html>