<?php

/* 
 * @autor: aSarrazin
 * Classe d'accès à la table de réservation

 */

class resa{
    protected $IdResa;
    protected $DateDeb;
    protected $DateFin;
    protected $IdLocataire;
    protected $Bdd;
    protected $Validation;
            
    function getIdResa() {
        return $this->IdResa;
    }
    function getValidation() {
        return $this->Validation;
    }

    function getDateDeb() {
        return $this->DateDeb;
    }

    function getDateFin() {
        return $this->DateFin;
    }

    function getIdLocataire() {
        return $this->IdLocataire;
    }

    function getBdd() {
        return $this->Bdd;
    }

    public function __construct($Dbh,$DateDeb,$DateFin,$idLoc,$Valide) {
        $this->IdResa;
        if(self::verifDate($DateDeb)){
            $this->DateDeb=$DateDeb;
            $entreeOk=TRUE;
        }
        else{
            echo 'Date de début invalide';
            $entreeOk=FALSE;
        }
        if(self::verifDate($DateFin)){
             $this->DateFin=$DateFin;
             $entreeOk=TRUE;
        }
        else{
            echo 'Date de fin invalide';
            $entreeOk=FALSE;
        }
        $this->IdLocataire=$idLoc;
        $this->Validation=$Valide;
        $this->Bdd=$Dbh;
        if($entreeOk==TRUE){
            foreach($Dbh->query('SELECT idResa FROM reservation WHERE dateDeb=\''.$DateDeb.'\' AND dateFin=\''.$DateFin.'\'') as $row){
                $this->IdResa = $row["idResa"];
            }
            if($this->IdResa == NULL)
            {
                $this->Bdd = FALSE;
            }
            else
            {
                $this->Bdd = TRUE;
            }
        }
        
        else{
            echo 'Erreur';
        }
        
    }
    
    function VerifDate($Date){
        $date=  explode("-",$Date);
       if( checkdate($date[1], $date[2],$date[0])){
           return true;
       }
       else{
           return false;
       }
    }


    public function creation($dbh) {
        if($this->Bdd == FALSE)
        {
        $stmt = $dbh->prepare('INSERT INTO Reservation (idResa,dateDeb,dateFin,idLocataire,valide) VALUES(NULL,?,?,?,?)');
        $stmt->bindParam(1,$this->DateDeb);
        $stmt->bindParam(2,$this->DateFin);
        $stmt->bindParam(3,$this->IdLocataire);
        $stmt->bindParam(4,$this->Validation);
        $stmt->execute();
        $this->Bdd = TRUE;
        echo 'Création OK';
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$DateDeb,$DateFin,$idLoc,$valide) {
        if(self::verifDate($DateDeb)){
            $this->DateDeb=$DateDeb;
            $entreeOk=TRUE;
        }
        else{
            echo 'Date de début invalide';
            $entreeOk=FALSE;
        }
        if(self::verifDate($DateFin)){
             $this->DateFin=$DateFin;
             $entreeOk=TRUE;
        }
        else{
            echo 'Date de fin invalide';
            $entreeOk=FALSE;
        }
        
        if(($this->Bdd == TRUE)&&($entreeOk==TRUE))
        {
        $stmt = $dbh->prepare('UPDATE Reservation SET dateDeb=? , dateFin = ? , idLocataire = ?, valide = ? WHERE idResa = ?');
        $stmt->bindParam(1,$DateDeb);
        $this->DateDeb = $DateDeb;
        $stmt->bindParam(2,$DateFin);
        $this->DateFin = $DateFin;
        $stmt->bindParam(3,$idLoc);
        $this->IdLocataire = $idLoc;
        $stmt->bindParam(4,$valide);
        $this->Validation=$valide;
        $stmt->bindParam(5,$this->IdResa);
        $stmt->execute();
        }
        else if ($this->Bdd == FALSE)
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }  
        
        else if ($entreeOk==FALSE)
        {
            echo 'Entrée(s) invalide(s)';
        }
    }
    
    public function validation($dbh){
        self::modification($dbh,$this->DateDeb,$this->DateFin,$this->IdLocataire,1);
    }

    public function destruction($dbh) {
        if($this->Bdd == TRUE)
        {
             $dbh->query('DELETE FROM Reservation WHERE dateDeb=\''.$this->DateDeb.'\' AND dateFin=\''.$this->DateFin.'\'');  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }
    
    public function GetListing($dbh) {
        $compteur=0;
         foreach($dbh->query('SELECT * FROM Reservation') as $row){
            $Tab[$compteur]=$row;
            $compteur++;
        }
        return $Tab;
        
    }


}