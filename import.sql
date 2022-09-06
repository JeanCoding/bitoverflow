CREATE DATABASE bitoverflow;

USE bitoverflow;

CREATE TABLE users (
    id int(11) AUTO_INCREMENT,
    username varchar(255),
    email varchar(255),
    password varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE categories (
    id int(11) AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE posts (
    id int(11) AUTO_INCREMENT,
    `subject` varchar(255),
    content text,
    category_id int(11),
    user_id int(11),
    `date` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
    id int(11) AUTO_INCREMENT,
    content text,
    post_id int(11),
    user_id int(11),
    `date` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (username, email, password) VALUES ('admin', 'admin@bitoverflow.nl', 'admin');
INSERT INTO categories (name) VALUES ('PHP'), ('MySQL'), ('HTML'), ('CSS'), ('JavaScript');