DROP TABLE IF EXISTS album_albums;

CREATE TABLE album_albums (
album_id                 INTEGER NOT NULL AUTO_INCREMENT,
title                    VARCHAR(255) NOT NULL,
created                  INTEGER NOT NULL,
photos_count             INTEGER DEFAULT 0,
                 PRIMARY KEY (album_id)
);

DROP TABLE IF EXISTS album_photos;

CREATE TABLE album_photos (
photo_id                 INTEGER NOT NULL AUTO_INCREMENT,
album_id                 INTEGER NOT NULL,
title                    VARCHAR(255) NOT NULL,
created                  INTEGER NOT NULL,
thumb_filename           VARCHAR(255) NOT NULL,
photo_filename           VARCHAR(255) NOT NULL,
filesize                 INTEGER NOT NULL,
                 PRIMARY KEY (photo_id)
);

