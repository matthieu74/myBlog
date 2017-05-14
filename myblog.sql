DROP DATABASE IF EXISTS rmu25001 ; -- Supprimer la base de données  projet4_Matthieu_Pero
CREATE DATABASE rmu25001 ; -- Créer la base de données : projet4_Matthieu_Pero
USE rmu25001 ; -- Indique la BDD à utiliser et dans laquelle on exécute les requêtes.


CREATE TABLE contact
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	emailAddress VARCHAR(255) NOT NULL,
	message BLOB
) ENGINE = InnoDB;

CREATE TABLE blogpost 
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	dateUpdate datetime not null,
	chapo VARCHAR(255) NOT NULL,
	author VARCHAR(255) NOT NULL,
    textPost blob
	
) ENGINE = InnoDB;

CREATE TABLE blogpost_h
(
	id INT,
	title VARCHAR(255) NOT NULL,
	dateUpdate datetime not null,
	chapo VARCHAR(255) NOT NULL,
	author VARCHAR(255) NOT NULL,
    textPost blob,
	dateop datetime not null,
	typeop char(1) not null
	
) ENGINE = InnoDB;

DELIMITER //

CREATE TRIGGER blogpost_before_update
BEFORE update
   ON blogpost FOR EACH ROW

BEGIN

   insert into blogpost_h (id, title, dateUpdate, chapo, author, textPost, dateop, typeop) 
		select id, title, dateUpdate, chapo, author, textPost, NOW(), 'U' from blogpost where id = OLD.id;

END; //

CREATE TRIGGER blogpost_before_delete
BEFORE delete
   ON blogpost FOR EACH ROW

BEGIN

   insert into blogpost_h (id, title, dateUpdate, chapo, author, textPost,dateop, typeop) 
		select id, title, dateUpdate, chapo, author, textPost, NOW(), 'D' from blogpost where id = OLD.id;

END; //

DELIMITER ;