CREATE DATABASE nume DEFAULT CHARACTER utf8; -->creaza baza de date
DROP DATABASE name_db --> sterge baza de date


USE name_db -->pentu a apela o baza de date din cmd sau USE DATABASE
CREATE TABLE table_name ( -->creaza tabel
   -->aici se pun coloanele
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB --> tipul de encoder UTF-8 si motorul InnoDB
DESCRIBE numele_tabelului --> arata ce tip de date acepta fiecare coloana
DROP TABLE tableName --> sterge tabelul

SELECT * FROM nume_tabel -->selecteaza tot tabelul
SELECT nume_col1,nume_col2 FROM nume_tabel --> selecteaza col1 si 2 din tabel
SELECT id, LEFT(col1_name, 20) FROM nume_tabel --> selecteaza primele 20 de carcterere din cal1
SELECT col1_name FROM nume_tabel WHERE col1_name LIKE "%element%" --> selecteaza doar unde textul din col1 contine cuvantul element
SELECT COUNT(*) FROM numele_tabel --> numara cate randuri are tabelul
SELECT COUNT(*) FROM nume_tabel WHERE col1_name = 'X' --> numara randurile unde(where) cal1 = X

    INT --> intiger 
    TEXT --> de tip text
    DATE --> acepta date de tipul DATE('2003-12-31 01:02:03')
    NOT NULL --> sa nu fie 0
    AUTO_INCREMENT --> se auto incrementeaza
    PRIMARY KEY -->unic, doar intiger nu string

INSERT INTO nume_tabel (col1, col2) --> inserare date in tabel
VALUES ("col1Value","col2Value"),(alte)
--SAU
INSERT INTO nume_tabel SET --> inserare date in tabel
nume_col1 = "value1", -- excape caracter \" 
nume_col2 = 'value'; --excape caracter \'

UPDATE nume_tabel SET --> modifica datele
nume_col = 'valoare',
WHERE caoniti

DELETE FROM nume_tabel WHERE conditie  --> sterge un rand sau toate datele daca nu se selecteaza ceva in special
 