#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Documents
#------------------------------------------------------------

CREATE TABLE Documents(
        idDoc          int (11) Auto_increment  NOT NULL ,
        url            Varchar (250) NOT NULL UNIQUE ,
        nomDoc         Varchar (250) NOT NULL ,
        descriptionDoc Varchar (400) ,
        PRIMARY KEY (idDoc )
)ENGINE=InnoDB;

