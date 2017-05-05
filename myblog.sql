DROP DATABASE IF EXISTS myblog ; -- Supprimer la base de données  projet4_Matthieu_Pero
CREATE DATABASE myblog ; -- Créer la base de données : projet4_Matthieu_Pero
USE myblog ; -- Indique la BDD à utiliser et dans laquelle on exécute les requêtes.


CREATE TABLE contact
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	emailAddress VARCHAR(255) NOT NULL,
	message BLOB
) ENGINE = InnoDB;

CREATE TABLE blogpost -- creation de la table type de statut de la personne
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	dateUpdate datetime not null,
	chapo VARCHAR(255) NOT NULL,
	author VARCHAR(255) NOT NULL,
    textPost blob
	
) ENGINE = InnoDB;