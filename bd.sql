CREATE DATABASE image_crud;

USE image_crud;

CREATE TABLE user (
    id              INT(11)         NOT NULL    PRIMARY KEY     AUTO_INCREMENT,
    name            VARCHAR(255)    NOT NULL,
    email           VARCHAR(255)    NOT NULL    UNIQUE, 
    password        VARCHAR(255)    NOT NULL,
    photo           VARCHAR(255)
);

