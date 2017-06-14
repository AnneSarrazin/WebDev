<?php
require 'resa.php';

$DateDeb=$_GET['DateDeb'];
$DateFin=$_GET['DateFin'];

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$DateDeb,$DateFin,NULL,0);

$Resa->destruction($dbh);

echo 'Réservation supprimée';