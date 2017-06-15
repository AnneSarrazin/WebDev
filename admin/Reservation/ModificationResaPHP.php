<?php
$DateDeb=$_POST['dateDeb'];
$DateFin=$_POST['dateFin'];
$saveDateFin=$_POST['saveDateFin'];
$saveDateDeb=$_POST['saveDateDeb'];
$Valide=$_POST['Valide'];

require 'resa.php';

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$saveDateDeb,$saveDateFin,NULL,$Valide);
$Resa->modification($dbh, $DateDeb, $DateFin,$Resa->getIdLocataire(),$Resa->getValidation());

echo '<p>Si vous n\'êtes pas automatiquement redirigé cliquez <a href=\"affichageResa.php">ici</a></p>';

header("refresh:3;url=affichageResa.php");