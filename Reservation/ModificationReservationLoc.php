<?php
$Locataire=$_POST['locataire'];
$DateDeb=$_POST['saveDateDeb'];
$DateFin=$_POST['saveDateFin'];

require '../BDD/Resas/Objet_Resa/resa.php';

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$DateDeb,$DateFin,NULL,0);
$Resa->modification($dbh, $DateDeb, $DateFin,$Locataire,$Resa->getValidation());
