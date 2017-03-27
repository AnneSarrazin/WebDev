--------------------------------------------------------------
--        Script MySQL.
--------------------------------------------------------------


--------------------------------------------------------------
-- Table: Reservation
--------------------------------------------------------------

CREATE TABLE Reservation(
        id_resa      int (11) Auto_increment  NOT NULL ,
        date_deb     Date NOT NULL ,
        date_fin     Date NOT NULL ,
        id_locataire Int NOT NULL ,
        PRIMARY KEY (id_resa )
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: Locataire
--------------------------------------------------------------

CREATE TABLE Locataire(
        id_locataire int (11) Auto_increment  NOT NULL ,
        nom          Varchar (250) NOT NULL ,
        prenom       Varchar (250) ,
        adresse_mail Varchar (100) NOT NULL ,
        PRIMARY KEY (id_locataire )
)ENGINE=InnoDB;


--------------------------------------------------------------
-- Table: Commentaire
--------------------------------------------------------------

CREATE TABLE Commentaire(
        id_com     int (11) Auto_increment  NOT NULL ,
        contenu    Varchar (500) NOT NULL ,
        validation Bool NOT NULL ,
        id_resa    Int NOT NULL ,
        id_com_1   Int NOT NULL ,
        PRIMARY KEY (id_com )
)ENGINE=InnoDB;

ALTER TABLE Reservation ADD CONSTRAINT FK_Reservation_id_locataire FOREIGN KEY (id_locataire) REFERENCES Locataire(id_locataire);
ALTER TABLE Commentaire ADD CONSTRAINT FK_Commentaire_id_resa FOREIGN KEY (id_resa) REFERENCES Reservation(id_resa);
ALTER TABLE Commentaire ADD CONSTRAINT FK_Commentaire_id_com_1 FOREIGN KEY (id_com_1) REFERENCES Commentaire(id_com);
