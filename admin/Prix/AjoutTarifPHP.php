<?php

require './Prix.php';

$DateDeb=$_POST['dateDeb'];
$DateFin=$_POST['dateFin'];
$Tarif=$_POST['tarif'];

$dbh = new PDO('mysql:host=localhost;dbname=Mandeline_Resa', 'root','');
$MonTarif = new Prix($dbh, $DateDeb, $DateFin, $Tarif);
$MonTarif->creation($dbh);

