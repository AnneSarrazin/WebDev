<?php
$DateDeb=$_GET['dateDeb'];
$DateFin=$_GET['dateFin'];
$Tarif=$_GET['Tarif'];


require './Prix.php';

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$MonTarif=new Prix($dbh, $DateDeb, $DateFin, $Tarif);
$MonTarif->destruction($dbh);