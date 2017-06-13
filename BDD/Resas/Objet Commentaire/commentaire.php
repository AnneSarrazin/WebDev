<?php

/* 
 * @autor: aBerenguer
 * Classe d'accès à la table de commentaires

 */

class commentaire{
    
    protected $bdd;
    protected $idCom;
    protected $contenu;
    protected $valide;
    protected $idResa;
    protected $idCom1;

    function getBdd() {
        return $this->bdd;
    }

    function getIdCom() {
        return $this->idCom;
    }

    function getContenu() {
        return $this->contenu;
    }

    function getValide() {
        return $this->valide;
    }

    function getIdResa() {
        return $this->idResa;
    }

    function getIdCom1() {
        return $this->idCom1;
    }

    public function __construct($dbh,$contenu,$idResa,$idCom1,$valide) {
        $this->idCom;
        $this->contenu=$contenu;
        $this->idResa=$idResa;
        $this->idCom1=$idCom1;
        $this->valide=$valide;
        
        foreach($dbh->query('SELECT idCom FROM commentaire WHERE contenu=\''.$contenu.'\' AND valide=\''.$valide.'\' AND idResa=\''.$idResa.'\' AND (idCom1=\''.$idCom1.'\' OR idCom1 IS NULL)') as $row){
            $this->idCom = $row["idCom"];
        }
        if($this->idCom == NULL)
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
        $stmt = $dbh->prepare('INSERT INTO Commentaire (idCom,contenu,valide,idResa,idCom1) VALUES(NULL,?,?,?,?)');
        $stmt->bindParam(1,$this->contenu);
        $stmt->bindParam(2,$this->valide);
        $stmt->bindParam(3,$this->idResa);
        $stmt->bindParam(4,$this->idCom1);
        $stmt->execute();
        foreach($dbh->query('SELECT idCom FROM commentaire WHERE contenu=\''.$this->contenu.'\' AND valide=\''.$this->valide.'\' AND idResa=\''.$this->idResa.'\' AND (idCom1=\''.$this->idCom1.'\' OR idCom1 IS NULL)') as $row){
            $this->idCom = $row["idCom"];
        }
        $this->bdd = TRUE;
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$contenu,$idResa,$idCom1,$valide) {
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE commentaire SET contenu = ?, valide = ?, idResa = ?, idCom1 = ? WHERE idCom = ?');
        $stmt->bindParam(1,$contenu);
        $this->contenu = $contenu;
        $stmt->bindParam(2,$valide);
        $this->valide = $valide;
        $stmt->bindParam(3,$idResa);
        $this->idResa = $idResa;
        $stmt->bindParam(4,$idCom1);
        $this->valide=$idCom1;
        $stmt->bindParam(5,$this->idCom);
        $stmt->execute();
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }        
    }
    public function validation($dbh){
        self::modification($dbh,$this->contenu,1,$this->idResa,$this->idCom1);
    }
    
    public function GetListing($dbh) {
        $Tab = array();
        $compteur=0;
         foreach($dbh->query('SELECT * FROM commentaire') as $row){
            $Tab[$compteur]=$row;
            $compteur++;
        }
        return $Tab;
    }

    public function destruction($dbh) {
        if($this->bdd == TRUE)
        {
             $dbh->query('DELETE FROM commentaire WHERE idCom='.$this->idCom);  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }
}