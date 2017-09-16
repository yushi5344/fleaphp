DROP TABLE mvcblog_posts CASCADE CONSTRAINTS;

drop sequence seq_mvcblog_posts;

CREATE TABLE mvcblog_posts (
id                       DECIMAL(10) NOT NULL,
title                    VARCHAR(255) NOT NULL,
body                     CLOB NOT NULL,
created                  DATE NOT NULL,
updated                  DATE NOT NULL,
                 PRIMARY KEY (id)
);

CREATE SEQUENCE SEQ_mvcblog_posts;

CREATE OR REPLACE TRIGGER TRIG_SEQ_mvcblog_posts BEFORE insert ON mvcblog_posts FOR EACH ROW WHEN (NEW.id IS NULL OR NEW.id = 0) BEGIN select SEQ_mvcblog_posts.nextval into :new.id from dual; END;;

