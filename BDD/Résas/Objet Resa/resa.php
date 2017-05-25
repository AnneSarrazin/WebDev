<?php

/* 
 * @autor: aSarrazin
 * Classe d'accès à la table de réservation

 */

class resa extends accesBdd{
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
        $this->DateDeb=$DateDeb;
        $this->DateFin=$DateFin;
        $this->IdLocataire=$idLoc;
        $this->Validation=$Valide;
        $this->Bdd=$Dbh;
        
        foreach($Dbh->query('SELECT idResa FROM Reservation WHERE dateDeb='.$DateDeb.' AND dateFin='.$DateFin.' AND idLocataire='.$idLoc.'') as $row){
            $this->id = $row["idResa"];
        }
        if($this->id == NULL)
        {
            $this->Bdd = FALSE;
        }
        else
        {
            $this->Bdd = TRUE;
        }
        
    }
    
     public function creation($dbh) {
        if($this->Bdd == FALSE)
        {
        $stmt = $dbh->prepare('INSERT INTO Reservation (idResa,dateDeb,dateFin,idLocataire,validation) VALUES(NULL,?,?,?,?)');
        $stmt->bindParam(1,$this->dateDeb);
        $stmt->bindParam(2,$this->DateFin);
        $stmt->bindParam(3,$this->IdLocataire);
        $stmt->bindParam(4,$this->Validation);
        $stmt->execute();
        $this->Bdd = TRUE;
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$DateDeb,$DateFin,$idLoc,$valide) {
        if($this->Bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE Reservation (dateDeb,dateFin,idLocataire,validation) VALUES(?,?,?,?,?) WHERE idLocataire = ?');
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
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }        
    }
    
    public function validation($dbh){
        self::modification($dbh,$this->DateDeb,$this->DateFin,$this->IdLocataire,1);
    }

    public function destruction($dbh) {
        if($this->Bdd == TRUE)
        {
             $dbh->query('DELETE FROM Reservation WHERE dateDeb='.$this->DateDeb.' AND dateFin='.$this->DateFin.' AND idLocataire='.$this->IdLocataire);  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }


}