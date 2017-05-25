<?php

/**
 * Classe agissant sur la table locataire dans la bdd
 * Avant d'utiliser le code qui suit, lisez le fichier
 * Documentation_classe_locataire.txt 
 * @author LMD
 */
class photo extends accesBdd{
    
    //Instances de la classe
    private $idPhoto;
    private $url;
    private $description;
    private $idLieu;
    protected $bdd;

    //Setter et getter
    function getIdPhoto() {
        return $this->idPhoto;
    }

    function getUrl() {
        return $this->url;
    }

    function getDescription() {
        return $this->description;
    }

    function getIdLieu() {
        return $this->idLieu;
    }


        
    //Methodes de la classe
    public function __construct($dbh,$url,$description,$idLieu) {
        $this->url = $url;
        $this->description = $description;
        $this->idLieu = $idLieu;
        foreach($dbh->query('SELECT idPhoto FROM Photos WHERE url='.$url.' AND description='.$description.' AND idLieu='.$idLieu) as $row){
            $this->idPhoto = $row["idPhoto"];
        }
        if($this->idPhoto == NULL)
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
        $stmt = $dbh->prepare('INSERT INTO Photos (idPhotos,url,description,idLieu) VALUES(NULL,?,?,?)');
        $stmt->bindParam(1,$this->url);
        $stmt->bindParam(2,$this->description);
        $stmt->bindParam(3,$this->idLieu);
        $stmt->execute();
        $this->bdd = TRUE;
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$url,$description,$idLieu) {
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE Photos (url,description,id_lieu) VALUES(?,?,?,?) WHERE idPhotos = ?');
        $stmt->bindParam(1,$url);
        $this->url = $url;
        $stmt->bindParam(2,$description);
        $this->description = $description;
        $stmt->bindParam(3,$idLieu);
        $this->idLieu = $idLieu;
        $stmt->bindParam(4,$this->idPhoto);
        $stmt->execute();
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }        
    }
    
    public function destruction($dbh) {
        if($this->bdd == TRUE)
        {
            $dbh->query('DELETE FROM Photos WHERE idPhoto='.$this->idPhoto.' AND url='.$this->url.'');  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }
}
