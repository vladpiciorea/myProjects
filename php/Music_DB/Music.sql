CREATE DATABASE Music;
CREATE TABLE Artist (
    artist_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE Album (
    album_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    INDEX USING BTREE (title),
    artist_id INT UNSIGNED ,
    INDEX USING BTREE (title),
    CONSTRAINT FOREIGN KEY (artist_id)
        REFERENCES Artist(artist_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Genre (
    gener_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE Track(
    track_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    len INT(5),
    rating INT(1),
    count INT(10),
    album_id INT UNSIGNED,
    gener_id INT UNSIGNED,
    CONSTRAINT FOREIGN KEY (album_id)
        REFERENCES Album(album_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (gener_id)
        REFERENCES Genre(gener_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Artist (name) VALUES ('Michael Jackson'), ('Eminem'),('Ed Sheeran');
INSERT INTO Album(title,artist_id) VALUES ('Thriller',1),('Bad',1),('Revival', 2),('Relapse',2),('You need me', 3);
INSERT INTO Genre (name) VALUES ('Pop music'),('Hip hop'),('Folk music');

INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Baby be mine',4,5,0,1,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('The girl is mine',3,5,0,1,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Thriller',5,5,0,1,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Beat It',4,5,0,1,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Billie Jean',5,5,0,1,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('I Just Cant Stop Loving You',4,5,0,2,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Bad',4,5,0,2,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Leave Me Alone',3,5,0,2,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Dirty Diana',5,5,0,1,1);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Believe',4,5,0,3,2);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('River',2,5,0,3,2);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Like Home',3,5,0,3,2);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Castle',4,5,0,3,2);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Hello',5,5,0,4,2);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('We Made You',6,5,0,4,2);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Deja Vu',4,5,0,4,2);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('You Need Me, I Don’t Need You',4,5,0,5,3);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('So',5,5,0,5,7);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('Be Like You',5,5,0,5,7);
INSERT INTO Track (title,len,rating,count,album_id,gener_id) VALUES('The City',5,5,0,5,7);

SELECT  Track.title, Artist.name, Album.title, Genre.name FROM Track JOIN Genre
JOIN Album JOIN Artist ON Track.gener_id = Genre.gener_id AND Track.album_id = Album.album_id
AND Album.artist_id = Artist.artist_id;

SELECT DISTINCT Artist.name, Genre.name FROM Track JOIN Genre
JOIN Album JOIN Artist ON Track.gener_id = Genre.gener_id AND Track.album_id = Album.album_id
AND Album.artist_id = Artist.artist_id WHERE Artist.name = 'Michael Jackson';