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

INSERT INTO users VALUES ("test1", "test1", "user", "info om mig"); 
INSERT INTO users VALUES ("test2", "test2", "user", "info om mig"); 
INSERT INTO users VALUES ("test3", "test3", "user", "info om mig"); 
INSERT INTO users VALUES ("test4", "test4", "user", "info om mig"); 
INSERT INTO users VALUES ("test5", "test5", "user", "info om mig"); 
INSERT INTO users VALUES ("test6", "test6", "user", "info om mig"); 
INSERT INTO users VALUES ("test7", "test7", "user", "info om mig"); 
INSERT INTO users VALUES ("test8", "test8", "user", "info om mig"); 
INSERT INTO users VALUES ("test9", "test9", "user", "info om mig"); 

