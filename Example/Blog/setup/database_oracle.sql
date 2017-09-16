DROP TABLE blog_comments CASCADE CONSTRAINTS;

drop sequence seq_blog_comments;

CREATE TABLE blog_comments (
comment_id               DECIMAL(10) NOT NULL,
post_id                  DECIMAL(10) DEFAULT 0 NOT NULL,
body                     CLOB NOT NULL,
created                  DECIMAL(10) NOT NULL,
                 PRIMARY KEY (comment_id)
);

CREATE SEQUENCE SEQ_blog_comments;

CREATE OR REPLACE TRIGGER TRIG_SEQ_blog_comments BEFORE insert ON blog_comments FOR EACH ROW WHEN (NEW.comment_id IS NULL OR NEW.comment_id = 0) BEGIN select SEQ_blog_comments.nextval into :new.comment_id from dual; END;;

DROP TABLE blog_posts CASCADE CONSTRAINTS;

drop sequence seq_blog_posts;

CREATE TABLE blog_posts (
post_id                  DECIMAL(10) NOT NULL,
title                    VARCHAR(255) NOT NULL,
body                     CLOB NOT NULL,
created                  DECIMAL(10) NOT NULL,
updated                  DECIMAL(10) NOT NULL,
comments_count           DECIMAL(10) DEFAULT 0 NOT NULL,
tags_count               DECIMAL(10) DEFAULT 0 NOT NULL,
                 PRIMARY KEY (post_id)
);

CREATE SEQUENCE SEQ_blog_posts;

CREATE OR REPLACE TRIGGER TRIG_SEQ_blog_posts BEFORE insert ON blog_posts FOR EACH ROW WHEN (NEW.post_id IS NULL OR NEW.post_id = 0) BEGIN select SEQ_blog_posts.nextval into :new.post_id from dual; END;;

DROP TABLE blog_posts_has_tags CASCADE CONSTRAINTS;

CREATE TABLE blog_posts_has_tags (
post_id                  DECIMAL(10) NOT NULL,
tag_id                   DECIMAL(10) NOT NULL,
                 PRIMARY KEY (post_id, tag_id)
);

DROP TABLE blog_tags CASCADE CONSTRAINTS;

drop sequence seq_blog_tags;

CREATE TABLE blog_tags (
tag_id                   DECIMAL(10) NOT NULL,
label                    VARCHAR(64) NOT NULL,
                 PRIMARY KEY (tag_id)
);

CREATE SEQUENCE SEQ_blog_tags;

CREATE OR REPLACE TRIGGER TRIG_SEQ_blog_tags BEFORE insert ON blog_tags FOR EACH ROW WHEN (NEW.tag_id IS NULL OR NEW.tag_id = 0) BEGIN select SEQ_blog_tags.nextval into :new.tag_id from dual; END;;

