DROP TABLE album_albums CASCADE CONSTRAINTS;

drop sequence seq_album_albums;

CREATE TABLE album_albums (
album_id                 DECIMAL(10) NOT NULL,
title                    VARCHAR(255) NOT NULL,
created                  DECIMAL(10) NOT NULL,
photos_count             DECIMAL(10) DEFAULT 0,
                 PRIMARY KEY (album_id)
);

CREATE SEQUENCE SEQ_album_albums;

CREATE OR REPLACE TRIGGER TRIG_SEQ_album_albums BEFORE insert ON album_albums FOR EACH ROW WHEN (NEW.album_id IS NULL OR NEW.album_id = 0) BEGIN select SEQ_album_albums.nextval into :new.album_id from dual; END;;

DROP TABLE album_photos CASCADE CONSTRAINTS;

drop sequence seq_album_photos;

CREATE TABLE album_photos (
photo_id                 DECIMAL(10) NOT NULL,
album_id                 DECIMAL(10) NOT NULL,
title                    VARCHAR(255) NOT NULL,
created                  DECIMAL(10) NOT NULL,
thumb_filename           VARCHAR(255) NOT NULL,
photo_filename           VARCHAR(255) NOT NULL,
filesize                 DECIMAL(10) NOT NULL,
                 PRIMARY KEY (photo_id)
);

CREATE SEQUENCE SEQ_album_photos;

CREATE OR REPLACE TRIGGER TRIG_SEQ_album_photos BEFORE insert ON album_photos FOR EACH ROW WHEN (NEW.photo_id IS NULL OR NEW.photo_id = 0) BEGIN select SEQ_album_photos.nextval into :new.photo_id from dual; END;;

