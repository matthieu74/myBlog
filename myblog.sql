DROP DATABASE IF EXISTS myblog ;

CREATE DATABASE myblog ; -- Créer la base de données : myblog
USE myblog ; 


CREATE TABLE contact
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	emailAddress VARCHAR(255) NOT NULL,
	message BLOB
) ENGINE = InnoDB;

CREATE TABLE BlogPost
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	dateMaj datetime NOT NULL,
	chapo VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE PostDetail
(
	id INT NOT NULL AUTO_INCREMENT,
	author VARCHAR(255) NOT NULL,
	textPost BLOB,
	BlogPost_idBlogPost INT NOT NULL ,
	PRIMARY KEY (`id`, `BlogPost_idBlogPost`) ,
  CONSTRAINT `fk_post`
    FOREIGN KEY (`BlogPost_idBlogPost` )
    REFERENCES `BlogPost` (`id` )
) ENGINE = InnoDB;
