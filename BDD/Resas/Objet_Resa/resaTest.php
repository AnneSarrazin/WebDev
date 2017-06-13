<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
      //  include $_SERVER['DOCUMENT_ROOT']."Mandeline/Mandeline/BDD/Resas/Objet_Resa/resa.php";
      require './resa.php';
        
        $DateDebBDD = "2017-01-01";
        $DateFinBDD = "2017-01-02";
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
        $Resa= new resa($dbh,$DateDebBDD,$DateFinBDD,NULL,0);
        $Resa->creation($dbh);
       // $Resa->modification($dbh, $Resa->getDateDeb(), "2017-02-03", $Resa->getIdLocataire(),$Resa->getValidation());
        //$Resa->validation($dbh);
      /*  $MyTab=$Resa->GetListing($dbh);
        $lonTab=  count($MyTab);
        $lonRow= count($MyTab[0]);
        echo 'Longueur Tab = '.$lonTab.'';
        echo 'longueru row= '.$lonRow.'';
        ?>
        <pre>
        <?php
        print_r($MyTab) ;*/
        $Resa->destruction($dbh);
        ?>
</pre>
    </body>
</html>