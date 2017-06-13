<?php

/**
 * Classe agissant sur la table locataire dans la bdd
 * Avant d'utiliser le code qui suit, lisez le fichier
 * Documentation_classe_locataire.txt 
 * @author LMD
 */
class doc extends accesBdd{
    
    //Instances de la classe
    private $idDoc;
    private $url;
    private $nomDoc;
    private $descriptionDoc;
    protected $bdd;

    //Setter et getter
    function getIdDoc() {
        return $this->idDoc;
    }

    function getNomDoc() {
        return $this->nomDoc;
    }

    function getDescriptionDoc() {
        return $this->descriptionDoc;
    }

        
    //Methodes de la classe
    public function __construct($dbh,$url,$nomDoc,$descriptionDoc) {
        $this->url = $url;
        $this->descriptionDoc = $descriptionDoc;
        $this->nomDoc = $nomDoc;
        foreach($dbh->query('SELECT idDoc FROM Documents WHERE url='.$url.' AND descriptionDoc='.$descriptionDoc.' AND nomDoc='.$nomDoc.'') as $row){
            $this->idDoc = $row["idDoc"];
        }
        if($this->idDoc == NULL)
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
        $stmt = $dbh->prepare('INSERT INTO Documents (idDoc,url,nomDoc,descriptionDoc) VALUES(NULL,?,?,?)');
        $stmt->bindParam(1,$this->url);
        $stmt->bindParam(2,$this->nomDoc);
        $stmt->bindParam(3,$this->descriptionDoc);
        $stmt->execute();
        $this->bdd = TRUE;
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$url,$nomDoc,$descriptionDoc) {
        if($this->bdd == TRUE)
        {
        $stmt = $dbh->prepare('UPDATE Documents SET url = ? , nomDoc = ? , descriptionDoc = ? WHERE idDoc = ?');
        $stmt->bindParam(1,$url);
        $this->url = $url;
        $stmt->bindParam(2,$nomDoc);
        $this->nomDoc = $nomDoc;
        $stmt->bindParam(3,$descriptionDoc);
        $this->descriptionDoc = $descriptionDoc;
        $stmt->bindParam(4,$this->idDoc);
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
            $dbh->query('DELETE FROM Documents WHERE idDoc='.$this->idDoc.'');  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }
}