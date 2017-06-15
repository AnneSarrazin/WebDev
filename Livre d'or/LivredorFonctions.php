<?php
function afficheCommentaire($dbh, $Tab, $i)
{
    $stmt = $dbh->prepare('SELECT nom, prenom FROM locataire WHERE idLocataire = '.$Tab[$i][4]); //On récupère le nom et le prénom correspondant au locataire de la réservation
    $stmt->execute(); 
    $NomPrenom = $stmt->fetch();
    echo '<p><strong>Auteur :</strong> '.$NomPrenom[0].' '.$NomPrenom[1].'</p>';
    if(isset($Tab[$i][3])) //Si le commentaire a une réservation associée
    {
    $stmt = $dbh->prepare('SELECT dateDeb, dateFin FROM reservation WHERE idResa = '.$Tab[$i][3]); //On récupère les dates de réservations (si possible)
    $stmt->execute(); 
    $DatesDebutFin = $stmt->fetch();
        echo '<p>Période de réservation du '.$DatesDebutFin[0].' au '.$DatesDebutFin[1].'</p>';
    }
    echo '<p><strong>Contenu du commentaire :</strong> '.$Tab[$i][1].'</p>';
    echo '<p>Commentaire numéro '.$Tab[$i][0].'</p>';
}