<?php

/**
 * Classe agissant sur la table photo dans la bdd
 * Avant d'utiliser le code qui suit, lisez le fichier
 * Documentation_classe_photo.txt 
 * @author A.Sarrazin
 */
class photo{
    
    //Instances de la classe
    private $id_photo;
    private $url;
    private $description;
    private $idLieu;
    protected $bdd;

    //Setter et getter
    function getIdPhoto() {
        return $this->id_photo;
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
        foreach($dbh->query('SELECT id_photo FROM photos WHERE url=\''.$url.'\' AND description=\''.$description.'\' AND id_lieu=\''.$idLieu.'\'') as $row){
            $this->id_photo = $row["id_photo"];
        }
        if($this->id_photo == NULL)
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
        $stmt = $dbh->prepare('INSERT INTO photos (id_photo,url,description,id_lieu) VALUES(NULL,?,?,?)');
        $stmt->bindParam(1,$this->url);
        $stmt->bindParam(2,$this->description);
        $stmt->bindParam(3,$this->idLieu);
        $stmt->execute();
        $this->bdd = TRUE;
        echo "OK pour la création";
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$url,$description,$idLieu) {
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE photos SET url = ? , description = ? , id_lieu = ? WHERE id_photo = ?');
        $stmt->bindParam(1,$url);
        $this->url = $url;
        $stmt->bindParam(2,$description);
        $this->description = $description;
        $stmt->bindParam(3,$idLieu);
        $this->idLieu = $idLieu;
        $stmt->bindParam(4,$this->id_photo);
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
            $dbh->query('DELETE FROM Photos WHERE id_photo='.$this->id_photo.'');  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }

    public function getIdLieuFromBDD($dbh,$nomLieu){
        foreach($dbh->query('SELECT id_lieu FROM lieu WHERE Nom_lieu=\''.$nomLieu.'\'') as $row){
            return $row["id_lieu"];
        }
    }
    
    public function creationLieu($dbh,$nom) {
        $deja=self::getIdLieuFromBDD($dbh,$nom);
        if($deja==NULL){
            $stmt = $dbh->prepare('INSERT INTO lieu (id_lieu,Nom_lieu) VALUES(NULL,?)');
            $stmt->bindParam(1,$nom);
            $stmt->execute();
        }
        else{
            echo 'Lieu déjà existant';
        }
    }
   
    
    public function suppressionLieu($dbh,$idLieu){
        $dbh->query('DELETE FROM lieu WHERE id_lieu='.$idLieu.'');
    }
}