
<?php
require 'resa.php';

$DateDeb=$_GET['DateDeb'];
$DateFin=$_GET['DateFin'];

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$DateDeb,$DateFin,NULL,0);

$Resa->validation($dbh);

echo '<p>Réservation validée avec succès.<br>';
echo 'Si vous n\'êtes pas automatiquement redirigé cliquez <a href=\"affichageResa.php">ici</a></p>';

header("refresh:3;url=affichageResa.php");