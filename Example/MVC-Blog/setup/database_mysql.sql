DROP TABLE IF EXISTS mvcblog_posts;

CREATE TABLE mvcblog_posts (
id                       INTEGER NOT NULL AUTO_INCREMENT,
title                    VARCHAR(255) NOT NULL,
body                     LONGTEXT NOT NULL,
created                  DATE NOT NULL,
updated                  DATE NOT NULL,
                 PRIMARY KEY (id)
);

