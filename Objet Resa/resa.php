<?php

/* 
 * @autor: aSarrazin
 * Classe d'accès à la table de réservation

 */

class resa extends acces_bdd{
    protected $id_resa;
    protected $date_deb;
    protected $date_fin;
    protected $id_locataire;
    protected $bdd;
    protected $validation;
            
    function getId_resa() {
        return $this->id_resa;
    }
    function get_validation() {
        return $this->validation;
    }

    function getDate_deb() {
        return $this->date_deb;
    }

    function getDate_fin() {
        return $this->date_fin;
    }

    function getId_locataire() {
        return $this->id_locataire;
    }

    function getBdd() {
        return $this->bdd;
    }

    public function __construct($dbh,$Date_deb,$Date_fin,$id_loc,$Valide) {
        $this->date_deb=$Date_deb;
        $this->date_fin=$Date_fin;
        $this->id_locataire=$id_loc;
        $this->validation=$Valide;
        
        foreach($dbh->query('SELECT id_resa FROM Reservation WHERE date_deb='.$Date_deb.' AND date_fin='.$Date_fin.' AND id_locataire='.$id_loc) as $row){
            $this->id = $row["id_resa"];
        }
        if($this->id == NULL)
        {
            $this->bdd = FALSE;
        }
        else
        {
            $this->bdd = TRUE;
        }
        
    }
    
     public function creation($dbh) {
        if($this->bdd == FALSE)
        {
        $stmt = $dbh->prepare('INSERT INTO Reservation (id_resa,date_deb,date_fin,id_locataire,validation) VALUES(NULL,?,?,?,?)');
        $stmt->bindParam(1,$this->date_deb);
        $stmt->bindParam(2,$this->date_fin);
        $stmt->bindParam(3,$this->id_locataire);
        $stmt->bindParam(4,$this->validation);
        $stmt->execute();
        $this->bdd = TRUE;
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$Date_deb,$Date_fin,$id_loc,$valide) {
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE Reservation (date_deb,date_fin,id_locataire,validation) VALUES(?,?,?,?,?) WHERE id_locataire = ?');
        $stmt->bindParam(1,$Date_deb);
        $this->date_deb = $Date_deb;
        $stmt->bindParam(2,$Date_fin);
        $this->date_fin = $Date_fin;
        $stmt->bindParam(3,$id_loc);
        $this->id_locataire = $id_loc;
        $stmt->bindParam(4,$valide);
        $this->validation=$valide;
        $stmt->bindParam(5,$this->id_resa);
        $stmt->execute();
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }        
    }
    
    public function validation($dbh){
        self::modification($dbh,$this->date_deb,$this->date_fin,$this->id_locataire,1);
    }

    public function destruction($dbh) {
        if($this->bdd == TRUE)
        {
             $dbh->query('DELETE FROM Reservation WHERE date_deb='.$this->date_deb.' AND date_fin='.$this->date_fin.' AND id_locataire='.$this->id_locataire);  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }


}