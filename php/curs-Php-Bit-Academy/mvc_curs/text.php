http://localhost/curs/mvc_curs/?marca=Dacia Logan&culoare=alb

CREATE DATABASE produse
USE produse

CREATE TABLE produse (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    marca VARCHAR(50) NOT NULL,
    culoare VARCHAR(30) NOT NULL,
    an_fabricatie SMALLINT NOT NULL,
    pret FLOAT NOT NULL
    
);

INSERT INTO produse VALUES
(1,'Dacia Logan','alb', 2016,1000),
(2,'Dacia Duster','rosu', 2017,1500),
(3,'Ford Fiesta','albastru', 2015,1300),
(4,'Ford Focus','rosu', 2017,1400),
(5,'Seat Ibiza','alb', 2018,1200)