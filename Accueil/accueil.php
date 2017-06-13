<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>S.C.I La Mandeline</title>
    </head>
    <body>
        <h2 id="Titre_Accueil">Bienvenue !</h2>
        <p>
        <?php
        $Text_Accueil=file_get_contents('text_accueil.txt');
        echo nl2br($Text_Accueil);
        
        $mois=date('n');
        if(($mois<5)||($mois>10)){
            $ete=true;
        }
        else{
            $ete=false;
        }
        ?>
        </p>
        <?php
        if ($ete==true){
        ?>
        <img src="IMG_20150210_154551.jpg" alt="Image d'accueil hiver" width="30%">
        <?php
        }
        else{
         ?>
        <img src="P1030544.JPG" alt="Image d'accueil été" width="30%"/>
        <?php
        }
        ?>
    </body>
</html>
