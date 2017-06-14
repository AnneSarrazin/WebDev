
<?php
require '../BDD/Resas/Objet_Resa/resa.php';

$DateDeb=$_GET['DateDeb'];
$DateFin=$_GET['DateFin'];

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$DateDeb,$DateFin,NULL,0);

$Resa->validation($dbh);

echo 'Réservation validée';