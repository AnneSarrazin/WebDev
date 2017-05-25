<?php

/**
 * Classe agissant sur la table locataire dans la bdd
 * Avant d'utiliser le code qui suit, lisez le fichier
 * Documentation_classe_locataire.txt 
 * @author LMD
 */
class locataire extends accesBdd{
    
    //Instances de la classe
    private $id;
    private $nom;
    private $prenom;
    private $adresseMail;
    protected $bdd;

    //Setter et getter
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getAdresseMail() {
        return $this->adresseMail;
    }
    
    //Methodes de la classe
    public function __construct($dbh,$nom,$prenom,$adresseMail) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresseMail = $adresseMail;
        foreach($dbh->query('SELECT idLocataire FROM Locataire WHERE nom='.$nom.' AND prenom='.$prenom.' AND adresseMail='.$adresseMail) as $row){
            $this->id = $row["idLocataire"];
        }
        if($this->id == NULL)
        {
            $this->bdd = FALSE;
        }
        else
        {
            $this->bdd = TRUE;
        }
        return $this->bdd;
    }
    
    public function creation($dbh) {
        $retour = FALSE;
        if($this->bdd == FALSE)
        {
        $stmt = $dbh->prepare('INSERT INTO Locataire (idLocataire,nom,prenom,adresseMail) VALUES(NULL,?,?,?)');
        $stmt->bindParam(1,$this->nom);
        $stmt->bindParam(2,$this->prenom);
        $stmt->bindParam(3,$this->adresseMail);
        $stmt->execute();
        $this->bdd = TRUE;
        $retour = TRUE;
        }
        return $retour;
    }
    
    public function modification($dbh,$nom,$prenom,$adresseMail) {
        $retour = FALSE;
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE locataire (nom,prenom,adresseMail) VALUES(?,?,?,?) WHERE idLocataire = ?');
        $stmt->bindParam(1,$nom);
        $this->nom = $nom;
        $stmt->bindParam(2,$prenom);
        $this->prenom = $prenom;
        $stmt->bindParam(3,$adresseMail);
        $this->adresseMail = $adresseMail;
        $stmt->bindParam(4,$this->id);
        $stmt->execute();
        $retour = TRUE;
        }
        return $retour;     
    }
    
    public function destruction($dbh,$reservation) {
        $retour = FALSE;
        if($this->bdd == TRUE)
        {
            $reservation->modification($dbh,$reservation->getDateDeb(),$reservation->getDateFin(),$this->id,$reservation->getValidation());
            $retour = TRUE;
        }
        return $retour;
    }
}
