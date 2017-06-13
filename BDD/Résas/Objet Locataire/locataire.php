<?php

/**
 * @title Objet Locataire
 * @author Luca Mayer Dalverny
 * @date 06/06/2017
 * @make
 * @sec Introduction
 * La classe locataire permet d'interagir avec la table 'Locataire' presente dans la base de donnees. Elle contient donc les memes variables que la table de la base de donnees.
 */
class Locataire {
    
    //Instances de la classe
    private $id;
    private $nom;
    private $prenom;
    private $adresseMail;
    protected $bdd;
    
/**
 * @sec Constructeur de la classe
 */

/**
 * @fn construct
 * Cette fonction va implementer les instances de l'objet et verifier si ces donnees sont presentes dans la base de donnees. Si elle le sont, l'id de la ligne sera mit dans l'instance id de l'objet cree.
 * @param dbh : objet 'PDO' permettant l'acces a la base de donnees
 * @param nom : le nom du locataire
 * @param prenom : le prenom du locataire
 * @param adresseMail : l'adresse mail du locataire
 * @return booleen : False (erreur) ou True (pas d'erreur)
 */
    public function __construct(PDO $dbh,$nom,$prenom,$adresseMail) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresseMail = $adresseMail;
        foreach($dbh->query('SELECT idLocataire FROM locataire WHERE nom = "'.$nom.'" AND prenom = "'.$prenom.'" AND adresseMail = "'.$adresseMail.'"') as $row){
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

/**
 * @sec Accesseurs
 */
    
/**
 * @subsec Getter
 * Les getters ont un nom suivant la meme structure, getNomDeLaVariable(). Par exemple pour id : getId(). Les Getters disponibles :
 * @bitem
 * @item GetId()
 * @item GetNom()
 * @item GetPrenom()
 * @item GetAdresseMail()
 * @eitem
 */
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
    
/**
 * @subsec Setter
 * Pour les setters, il n'y en a pas. Vous pouvez tout de meme modifier les instances de l'objet a l'aide de la methode modification
 */
 
/**
 * @sec Interaction avec la base de donnees
 */    

/**
 * @fn creation
 * Fonction pour ajouter votre objet dans la base de donnees
 * @param dbh : objet 'PDO' permettant l'acces a la base de donnees 
 * @return booleen : False (erreur ou objet deja dans la bdd) ou True (pas d'erreur)
 */   
    public function creation($dbh) {
        $retour = FALSE;
        if($this->bdd == FALSE)
        {
        $stmt = $dbh->prepare('INSERT INTO locataire (idLocataire,nom,prenom,adresseMail) VALUES(NULL,?,?,?)');
        $stmt->bindParam(1,$this->nom);
        $stmt->bindParam(2,$this->prenom);
        $stmt->bindParam(3,$this->adresseMail);
        $stmt->execute();
        $this->bdd = TRUE;
        $retour = TRUE;
        }
        return $retour;
    }
    
/**
 * @fn modification
 * Fonction pour modifier les valeurs de votre objet dans la base de donnees. Si, parmi les parametres, il y en a un dont la valeur ne doit pas etre change, faites un appel a la fonction get de la valeur. Exemple avec la modification du mail mais pas de nom et prenom : 
 * modification(dbh,getNom(),getPrenom(),maNouvelleAdresseMail)
 * @param dbh : objet 'PDO' permettant l'acces a la base de donnees
 * @param nom : le nom du locataire
 * @param prenom : le prenom du locataire
 * @param adresseMail : l'adresse mail du locataire
 * @return booleen : False (erreur ou objet pas dans la bdd) ou True (pas d'erreur)
 */
    public function modification($dbh,$nom,$prenom,$adresseMail) {
        $retour = FALSE;
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE locataire SET nom = ? , prenom = ? , adresseMail = ? WHERE idLocataire = ?');
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

/**
 * @fn destruction
 * Fonction pour detruire l'objet de la base de donnees
 * @param dbh : objet 'PDO' permettant l'acces a la base de donnees
 * @return boolean : False (erreur ou objet pas dans la bdd) ou True (pas d'erreur)
 */
    public function destruction($dbh) {
        $retour = FALSE;
        if($this->bdd == TRUE)
        {
            $stmt = $dbh->prepare('UPDATE reservation SET idLocataire = NULL WHERE idLocataire = ?');
            $stmt->bindParam(1,$this->id);
            $stmt->execute();
            $stmt1 = $dbh->prepare('DELETE FROM locataire WHERE idLocataire = ?');
            $stmt1->bindParam(1,$this->id);
            $stmt1->execute();
            $retour = TRUE;
        }
        return $retour;
    }
}
