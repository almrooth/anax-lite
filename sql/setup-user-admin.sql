SHOW DATABASES;
CREATE DATABASE IF NOT EXISTS oophp;

USE oophp;
SHOW TABLES;

GRANT ALL ON oophp.* TO admin@localhost IDENTIFIED BY 'admin';

SET NAMES utf8;

CREATE TABLE users
(
	username VARCHAR(20) PRIMARY KEY NOT NULL,
    password VARCHAR(255) NOT NULL,
    type SET('admin', 'user') NOT NULL,
    info TEXT,
);

SELECT * FROM users;
