<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test classe Photo</title>
    </head>
    <body>
        <?php
        require 'photo.php';
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Photos', 'root','');
        $Photo = new photo($dbh,'../Photos_test/Cuisine_1.jpg','Photo de la Cuisine',1);
        $Photo->creation($dbh);
        $Photo->modification($dbh,$Photo->getUrl(),'La nouvelle desc',$Photo->getIdLieu());
        $Photo->destruction($dbh);
        //$Photo->creationLieu($dbh,'Coin Montagne');
        $Photo->suppressionLieu($dbh,$Photo->getIdLieuFromBDD($dbh,'Coin Montagne'));
        ?>
    </body>
</html>
