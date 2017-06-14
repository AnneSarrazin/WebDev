<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        require './commentaire.php';
        
        $ContenuBDD = "Ceci est un commentaire de test!";
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
        $Commentaire = new commentaire($dbh,$ContenuBDD,1,1,NULL,0);
        $Commentaire->creation($dbh);
        $Commentaire->modification($dbh, "Ceci est un commentaire modifié!", $Commentaire->getIdResa(), $Commentaire->getIdLocataire(), $Commentaire->getIdCom1(),$Commentaire->getValide());
        $Commentaire->validation($dbh);
        $MyTab=$Commentaire->GetListing($dbh);
        $lonTab=count($MyTab);
        $lonRow=count($MyTab[0]);
        echo 'Longueur Tab = '.$lonTab.'';
        echo 'longueru row= '.$lonRow.'';
        ?>
        <pre>
        <?php
        print_r($MyTab) ;
        //$Commentaire->destruction($dbh);
        ?>
</pre>
    </body>
</html>