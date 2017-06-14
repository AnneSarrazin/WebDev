<?php
$urlSite = 'http://localhost/Mandeline';
?>

<link href="../Style/Header.css" rel="stylesheet" type="text/css"/>

<header>
    <img id="Banniere" src="../Header/PANO_20160816_165610.jpg" alt="Banniere du site"/>
        <h1>La Mandeline Locations</h1>
        <div>
            <a href="#Navigation"><img src="../Header/mandeline.png" alt=""/></a>
            <nav id="Navigation" >
                <ul>
                    <?php
                    echo '<li><a href="'.$urlSite.'/Accueil.php" >Accueil</a></li>';
                    echo '<li><a href="">Réservations</a></li>';
                    echo '<li><a href="">Locataires</a></li>';
                    echo '<li><a href="">Commentaires</a></li>';
                    echo '<li><a href="">Photos</a></li>';
                    echo '<li><a href="">Texte d\'accueil</a></li>';
                    echo '<li><a href="">Documents</a></li>';
                    echo '<li id="Fermer" ><a href="#">Fermer</a></li>';
                    ?>    
                </ul>
            </nav>
        </div>
</header>