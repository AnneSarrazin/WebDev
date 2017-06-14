<?php


/**
 * Description of Prix
 *
 * @author asarrazin
 */
class Prix {
    protected $IdPrix;
    protected $DateDeb;
    protected $DateFin;
    protected $Tarif;
    protected $Bdd;
            
   
    function getIdPrix() {
        return $this->IdPrix;
    }

    function getDateDeb() {
        return $this->DateDeb;
    }

    function getDateFin() {
        return $this->DateFin;
    }

    function getTarif() {
        return $this->Tarif;
    }

    function getBdd() {
        return $this->Bdd;
    }

        public function __construct($Dbh,$DateDeb,$DateFin,$Tarif) {
        $this->IdPrix;
        if(self::verifDate($DateDeb)){
            $this->DateDeb=$DateDeb;
            $entreeOk=TRUE;
        }
        else{
            echo 'Date de début invalide';
            $entreeOk=FALSE;
        }
        if(self::verifDate($DateFin)){
             $this->DateFin=$DateFin;
             $entreeOk=TRUE;
        }
        else{
            echo 'Date de fin invalide';
            $entreeOk=FALSE;
        }
        $this->Tarif=$Tarif;
        $this->Bdd=$Dbh;
        if($entreeOk==TRUE){
            foreach($Dbh->query('SELECT idPrix FROM prix WHERE dateDeb=\''.$DateDeb.'\' AND dateFin=\''.$DateFin.'\'') as $row){
                $this->IdResa = $row["idResa"];
            }
            if($this->IdResa == NULL)
            {
                $this->Bdd = FALSE;
            }
            else
            {
                $this->Bdd = TRUE;
            }
        }
        
        else{
            echo 'Erreur';
        }
        
    }
    
    function VerifDate($Date){
        $date=  explode("-",$Date);
       if( checkdate($date[1], $date[2],$date[0])){
           return true;
       }
       else{
           return false;
       }
    }


    public function creation($dbh) {
        if($this->Bdd == FALSE)
        {
        $stmt = $dbh->prepare('INSERT INTO Prix (idPrix,dateDeb,dateFin,Tarif) VALUES(NULL,?,?,?)');
        $stmt->bindParam(1,$this->DateDeb);
        $stmt->bindParam(2,$this->DateFin);
        $stmt->bindParam(3,$this->Tarif);
        $stmt->execute();
        $this->Bdd = TRUE;
        foreach($dbh->query('SELECT idPrix FROM Prix WHERE dateDeb=\''.$this->DateDeb.'\' AND dateFin=\''.$this->DateFin.'\'') as $row){
                $this->IdPrix = $row["idPrix"];
            }
        echo 'Création OK';
        }
        else
        {
            echo "Votre objet est déjà dans la BDD";
        }
    }
    
    public function modification($dbh,$DateDeb,$DateFin,$Tarif) {
        if(self::verifDate($DateDeb)){
            $this->DateDeb=$DateDeb;
            $entreeOk=TRUE;
        }
        else{
            echo 'Date de début invalide';
            $entreeOk=FALSE;
        }
        if(self::verifDate($DateFin)){
             $this->DateFin=$DateFin;
             $entreeOk=TRUE;
        }
        else{
            echo 'Date de fin invalide';
            $entreeOk=FALSE;
        }
        
        if(($this->Bdd == TRUE)&&($entreeOk==TRUE))
        {
        $stmt = $dbh->prepare('UPDATE Reservation SET dateDeb=? , dateFin = ? , tarif = ? WHERE idPrix = ?');
        $stmt->bindParam(1,$DateDeb);
        $this->DateDeb = $DateDeb;
        $stmt->bindParam(2,$DateFin);
        $this->DateFin = $DateFin;
        $stmt->bindParam(3,$Tarif);
        $this->Tarif = $Tarif;
        $stmt->bindParam(5,$this->IdPrix);
        $stmt->execute();
        }
        else if ($this->Bdd == FALSE)
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }  
        
        else if ($entreeOk==FALSE)
        {
            echo 'Entrée(s) invalide(s)';
        }
    }
    

    public function destruction($dbh) {
        if($this->Bdd == TRUE)
        {
             $dbh->query('DELETE FROM Prix WHERE dateDeb=\''.$this->DateDeb.'\' AND dateFin=\''.$this->DateFin.'\'');  
        }
        else
        {
            echo "Votre objet n'est pas présent dans la BDD";
        }
    }
   
}
