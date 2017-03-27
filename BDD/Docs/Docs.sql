#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Documents
#------------------------------------------------------------

CREATE TABLE Documents(
        id_doc          int (11) Auto_increment  NOT NULL ,
        nom_doc         Varchar (250) NOT NULL ,
        description_doc Varchar (400) ,
        PRIMARY KEY (id_doc )
)ENGINE=InnoDB;

