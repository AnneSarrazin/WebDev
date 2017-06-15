<?php
require 'resa.php';

$DateDeb=$_POST['DateDeb'];
$DateFin=$_POST['DateFin'];
if ((isset($_POST['locataire']) == TRUE)) {
    $Locataire=$_POST['locataire'];
}
else{
    $Locataire=NULL;
}
$newValide=$_POST['newValide'];

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$DateDeb,$DateFin,$Locataire,$newValide);

$Resa->creation($dbh);

echo '<p>Si vous n\'êtes pas automatiquement redirigé cliquez <a href=\"affichageResa.php">ici</a></p>';

header("refresh:3;url=affichageResa.php");
