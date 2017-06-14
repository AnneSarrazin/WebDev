--------------------------------------------------------------
--        Script MySQL.
--------------------------------------------------------------


--------------------------------------------------------------
-- Table: Reservation
--------------------------------------------------------------

CREATE TABLE Reservation(
        idResa      int (11) Auto_increment  NOT NULL ,
        dateDeb     Date NOT NULL ,
        dateFin     Date NOT NULL ,
        idLocataire Int ,
        valide Int NOT NULL,
        PRIMARY KEY (idResa )
)ENGINE=InnoDB;

--------------------------------------------------------------
-- Table: Prix
--------------------------------------------------------------

CREATE TABLE Prix(
        idPrix     int (11) Auto_increment  NOT NULL ,
        dateDeb     Date NOT NULL ,
        dateFin     Date NOT NULL ,
        Tarif        Float ,
        PRIMARY KEY (idResa )
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: Locataire
--------------------------------------------------------------

CREATE TABLE Locataire(
        idLocataire int (11) Auto_increment  NOT NULL ,
        nom          Varchar (250) NOT NULL ,
        prenom       Varchar (250) ,
        adresseMail Varchar (100) NOT NULL ,
        PRIMARY KEY (idLocataire )
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: Commentaire
--------------------------------------------------------------

CREATE TABLE Commentaire(
        idCom     int (11) Auto_increment  NOT NULL ,
        contenu    Varchar (500) NOT NULL ,
        valide Int NOT NULL ,
        idResa    Int ,
		idLocataire	Int ,
        idCom1   Int ,
        PRIMARY KEY (idCom)
)ENGINE=InnoDB;

ALTER TABLE Reservation ADD CONSTRAINT FK_Reservation_id_locataire FOREIGN KEY (idLocataire) REFERENCES Locataire(idLocataire);
ALTER TABLE Commentaire ADD CONSTRAINT FK_Commentaire_id_resa FOREIGN KEY (idResa) REFERENCES Reservation(idResa);
ALTER TABLE Commentaire ADD CONSTRAINT FK_Commentaire_id_com_1 FOREIGN KEY (idCom1) REFERENCES Commentaire(idCom);
ALTER TABLE Commentaire ADD CONSTRAINT FK_Commentaire_id_loc FOREIGN KEY (idLocataire) REFERENCES Locataire(idLocataire);