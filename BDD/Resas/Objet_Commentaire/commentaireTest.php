<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        require './commentaire.php';
        
        $ContenuBDD = "test avéc un accent";
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa;charset=utf8', 'root','');
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $Commentaire = new commentaire($dbh,$ContenuBDD,1,4,NULL,0);
        $Commentaire->creation($dbh);
        $Commentaire->modification($dbh, "Ceci est un commentaire modifié!", $Commentaire->getIdLocataire(), $Commentaire->getIdCom1(),$Commentaire->getValide());
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