CREATE DATABASE produse;

USE produse;

CREATE TABLE produse (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    marca VARCHAR(50),
    culoare VARCHAR(10),
    an_fabricatie INT,
    pret FLOAT NOT NULL

);

INSERT INTO produse (marca, culoare, an_fabricatie, pret)
VALUES
('Dacia Logan', 'alb', 2016, 10000),
('Dacia Duster', 'rosu', 2017, 15000),
('Ford Fiesta', 'albastru', 2015, 13000),
('Ford Focus', 'rosu', 2017, 14000),
('Seat Ibiza', 'alb', 2018, 12000);

SELECT * FROM produse;

CREATE TABLE form_tokens (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	token INT NOT NULL,
    creation INT NOT NULL

);

SELECT * FROM form_tokens;


