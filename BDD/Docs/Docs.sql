#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Documents
#------------------------------------------------------------

CREATE TABLE Documents(
        iDoc          int (11) Auto_increment  NOT NULL ,
        nomDoc         Varchar (250) NOT NULL ,
        descriptionDoc Varchar (400) ,
        PRIMARY KEY (idDoc )
)ENGINE=InnoDB;

