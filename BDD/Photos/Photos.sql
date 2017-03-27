#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Photos
#------------------------------------------------------------

CREATE TABLE Photos(
        id_photo    int (11) Auto_increment  NOT NULL ,
        url         Varchar (250) NOT NULL ,
        Description Varchar (400) NOT NULL ,
        id_lieu     Int NOT NULL ,
        PRIMARY KEY (id_photo ) ,
        UNIQUE (url )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Lieu
#------------------------------------------------------------

CREATE TABLE Lieu(
        id_lieu  int (11) Auto_increment  NOT NULL ,
        Nom_lieu Varchar (250) NOT NULL ,
        PRIMARY KEY (id_lieu )
)ENGINE=InnoDB;

ALTER TABLE Photos ADD CONSTRAINT FK_Photos_id_lieu FOREIGN KEY (id_lieu) REFERENCES Lieu(id_lieu);
