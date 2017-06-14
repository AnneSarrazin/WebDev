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
$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$Resa= new resa($dbh,$DateDeb,$DateFin,$Locataire,1);

$Resa->creation($dbh);
