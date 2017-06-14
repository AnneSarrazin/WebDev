<?php
$Locataire=$_POST['locataire'];
$DateDeb=$_POST['saveDateDeb'];
$DateFin=$_POST['saveDateFin'];
$Valide=$_POST['Valide'];

require 'resa.php';

echo $Locataire;

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$DateDeb,$DateFin,NULL,$Valide);
$Resa->modification($dbh, $DateDeb, $DateFin,$Locataire,$Resa->getValidation());

echo '<p>Locataire changé avec succès.<br>';
echo 'Si vous n\'êtes pas automatiquement redirigé cliquez <a href=\"affichageResa.php">ici</a></p>';

header("refresh:3;url=affichageResa.php");
