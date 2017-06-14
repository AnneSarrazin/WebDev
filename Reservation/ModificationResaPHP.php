<?php
$DateDeb=$_POST['dateDeb'];
$DateFin=$_POST['dateFin'];
$saveDateFin=$_POST['saveDateFin'];
$saveDateDeb=$_POST['saveDateDeb'];

require '../BDD/Resas/Objet_Resa/resa.php';

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$saveDateDeb,$saveDateFin,NULL,0);
$Resa->modification($dbh, $DateDeb, $DateFin,$Resa->getIdLocataire(),$Resa->getValidation());