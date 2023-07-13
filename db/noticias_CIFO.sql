-- Base de datos para el proyecto noticias


DROP DATABASE IF EXISTS noticias;

CREATE DATABASE noticias DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE noticias;

-- tabla users
-- podéis crear los campos adicionales que necesitéis.
CREATE TABLE users(
	id INT PRIMARY KEY auto_increment,
	displayname VARCHAR(32) NOT NULL,
	email VARCHAR(128) NOT NULL UNIQUE KEY,
	phone VARCHAR(32) NOT NULL UNIQUE KEY,
	password VARCHAR(32) NOT NULL,
	roles JSON NOT NULL,
	picture VARCHAR(256) DEFAULT NULL,
	blocked_at TIMESTAMP NULL DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);


-- usuarios para las pruebas, podéis crear tantos como necesitéis
INSERT INTO users(displayname, email, phone, password, roles) VALUES 
	('admin', 'admin@fastlight.com', '666666666', md5('1234'), '["ROLE_USER", "ROLE_ADMIN"]'),
	('editor', 'editor@fastlight.com', '666666665', md5('1234'), '["ROLE_USER", "ROLE_EDITOR"]'),
	('redactor', 'redactor@fastlight.com', '666666664', md5('1234'), '["ROLE_USER", "ROLE_WRITER"]'),
	('lector', 'lector@fastlight.com', '666666663', md5('1234'), '["ROLE_USER", "ROLE_READER"]')
;


-- tabla errors
-- por si queremos registrar los errores en base de datos.
CREATE TABLE errors(
	id INT PRIMARY KEY auto_increment,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    level VARCHAR(32) NOT NULL DEFAULT 'ERROR',
    url VARCHAR(256) NOT NULL,
	message VARCHAR(256) NOT NULL,
	user VARCHAR(128) DEFAULT NULL,
	ip CHAR(15) NOT NULL
);

CREATE TABLE noticias(
	id INT PRIMARY KEY auto_increment,
	titulo VARCHAR(128) NOT NULL,
	texto TEXT,
	imagen VARCHAR(256) DEFAULT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	iduser INT NOT NULL,

	FOREIGN KEY(iduser) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE comentarios(
	id INT PRIMARY KEY auto_increment,
	texto TEXT,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	iduser INT NOT NULL,
	idnoticia INT NOT NULL,

	FOREIGN KEY(iduser) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(idnoticia) REFERENCES noticias(id) ON UPDATE CASCADE ON DELETE CASCADE
);



