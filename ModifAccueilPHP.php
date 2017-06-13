<?php
$newText=nl2br($_GET['modif']);
file_put_contents("Accueil/text_accueil.txt",$newText);
//file_get_contents('test.txt');
echo file_get_contents("Accueil/text_accueil.txt");

