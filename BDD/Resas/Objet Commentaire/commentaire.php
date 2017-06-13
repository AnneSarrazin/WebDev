<?php

/* 
 * @autor: aBerenguer
 * Classe d'accès à la table de commentaires

 */

class commentaire extends acces_bdd{
    
    protected $bdd;
    protected $id_com;
    protected $contenu;
    protected $valide;
    protected $idResa;
    protected $idCom1;

    function getBdd() {
        return $this->bdd;
    }

    function getId_com() {
        return $this->id_com;
    }

    function getContenu() {
        return $this->contenu;
    }

    function getValidation() {
        return $this->validation;
    }

    function getId_resa() {
        return $this->id_resa;
    }

    function getId_com_1() {
        return $this->id_com_1;
    }

    public function __construct($dbh,$contenu,$id_resa,$id_com_1,$valide) {
        $this->contenu=$contenu;
        $this->id_resa=$id_resa;
        $this->id_com_1=$id_com_1;
        $this->validation=$valide;

        foreach($dbh->query('SELECT id_com FROM Commentaire WHERE contenu='.$contenu.'AND validation='.$valide.' AND id_resa='.$id_resa.' AND id_com_1='.$id_com_1) as $row){
            $this->id_com = $row["id_com"];
        }
        if($this->id_com == NULL)
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
        $stmt = $dbh->prepare('INSERT INTO Commentaire (id_com,contenu,validation,id_resa,id_com_1) VALUES(NULL,?,?,?,?,?)');
        $stmt->bindParam(1,$this->id_com);
        $stmt->bindParam(2,$this->contenu);
        $stmt->bindParam(3,$this->validation);
        $stmt->bindParam(4,$this->id_resa);
        $stmt->bindParam(5,$this->id_com_1);
        $stmt->execute();
        $this->bdd = TRUE;
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$contenu,$valide,$id_resa,$id_com_1) {
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE Commentaire (contenu,validation,id_resa,id_com_1) VALUES(?,?,?,?,?) WHERE id_com = ?');
        $stmt->bindParam(1,$contenu);
        $this->contenu = $contenu;
        $stmt->bindParam(2,$valide);
        $this->validation = $valide;
        $stmt->bindParam(3,$id_resa);
        $this->id_resa = $id_resa;
        $stmt->bindParam(4,$id_com_1);
        $this->validation=$id_com_1;
        $stmt->bindParam(5,$this->id_com);
        $stmt->execute();
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }        
    }
    public function validation($dbh){
        self::modification($dbh,$this->contenu,1,$this->id_resa,$this->id_com_1);
    }

    public function destruction($dbh) {
        if($this->bdd == TRUE)
        {
             $dbh->query('DELETE FROM Commentaire WHERE contenu='.$this->contenu.'AND validation='.$this->validation.' AND id_resa='.$this->id_resa.' AND id_com_1='.$this->id_com_1);  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }
}