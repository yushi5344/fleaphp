DROP TABLE IF EXISTS blog_comments;

CREATE TABLE blog_comments (
comment_id               INTEGER NOT NULL AUTO_INCREMENT,
post_id                  INTEGER NOT NULL DEFAULT 0,
body                     LONGTEXT NOT NULL,
created                  INTEGER NOT NULL,
                 PRIMARY KEY (comment_id)
);

DROP TABLE IF EXISTS blog_posts;

CREATE TABLE blog_posts (
post_id                  INTEGER NOT NULL AUTO_INCREMENT,
title                    VARCHAR(255) NOT NULL,
body                     LONGTEXT NOT NULL,
created                  INTEGER NOT NULL,
updated                  INTEGER NOT NULL,
comments_count           INTEGER NOT NULL DEFAULT 0,
tags_count               INTEGER NOT NULL DEFAULT 0,
                 PRIMARY KEY (post_id)
);

DROP TABLE IF EXISTS blog_posts_has_tags;

CREATE TABLE blog_posts_has_tags (
post_id                  INTEGER NOT NULL,
tag_id                   INTEGER NOT NULL,
                 PRIMARY KEY (post_id, tag_id)
);

DROP TABLE IF EXISTS blog_tags;

CREATE TABLE blog_tags (
tag_id                   INTEGER NOT NULL AUTO_INCREMENT,
label                    VARCHAR(64) NOT NULL,
                 PRIMARY KEY (tag_id)
);

