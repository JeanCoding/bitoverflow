CREATE DATABASE bitoverflow;

USE bitoverflow;

CREATE TABLE users (
    id int(11) AUTO_INCREMENT,
    username varchar(255),
    email varchar(255),
    password varchar(255),
    PRIMARY KEY (id)
);