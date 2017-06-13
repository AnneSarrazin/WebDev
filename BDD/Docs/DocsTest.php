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
        require 'doc.php';
        $dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Docs', 'root','');
        $Doc= new doc($dbh,"./monNewDoc","Nouveau Doc","Un new nouveau document");
        $Doc->creation($dbh);
        $Doc->modification($dbh, $Doc->getUrl(),$Doc->getNomDoc(), "Ma desc");
        $Doc->destruction($dbh);
        ?>
    </body>
</html>
