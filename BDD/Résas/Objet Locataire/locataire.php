<?php

/**
 * Classe agissant sur la table locataire dans la bdd
 * Avant d'utiliser le code qui suit, lisez le fichier
 * Documentation_classe_locataire.txt 
 * @author LMD
 */
class locataire extends acces_bdd{
    
    //Instances de la classe
    private $id;
    private $nom;
    private $prenom;
    private $adresse_mail;
    protected $bdd;

    //Setter et getter
    function get_id() {
        return $this->id;
    }

    function get_nom() {
        return $this->nom;
    }

    function get_prenom() {
        return $this->prenom;
    }

    function get_adresse_mail() {
        return $this->adresse_mail;
    }
    
    //Methodes de la classe
    public function __construct($dbh,$nom,$prenom,$adresse_mail) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse_mail = $adresse_mail;
        foreach($dbh->query('SELECT id_locataire FROM Locataire WHERE nom='.$nom.' AND prenom='.$prenom.' AND adresse_mail='.$adresse_mail) as $row){
            $this->id = $row["id_locataire"];
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
        $stmt = $dbh->prepare('INSERT INTO Locataire (id_locataire,nom,prenom,adresse_mail) VALUES(NULL,?,?,?)');
        $stmt->bindParam(1,$this->nom);
        $stmt->bindParam(2,$this->prenom);
        $stmt->bindParam(3,$this->adresse_mail);
        $stmt->execute();
        $this->bdd = TRUE;
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$nom,$prenom,$adresse_mail) {
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE locataire (nom,prenom,adresse_mail) VALUES(?,?,?,?) WHERE id_locataire = ?');
        $stmt->bindParam(1,$nom);
        $this->nom = $nom;
        $stmt->bindParam(2,$prenom);
        $this->prenom = $prenom;
        $stmt->bindParam(3,$adresse_mail);
        $this->adresse_mail = $adresse_mail;
        $stmt->bindParam(4,$this->id);
        $stmt->execute();
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }        
    }
    
    public function destruction($dbh,$reservation) {
        if($this->bdd == TRUE)
        {
            $reservation->modification($dbh,$reservation->getDate_deb(),$reservation->getDate_fin(),$this->id,$reservation->get_validation());
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }
}
