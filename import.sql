CREATE DATABASE bitoverflow;

USE bitoverflow;

CREATE TABLE users (
    id int(11) AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE categories (
    id int(11) AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE posts (
    id int(11) AUTO_INCREMENT,
    `subject` varchar(255) NOT NULL,
    content text NOT NULL,
    category_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    `date` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
    id int(11) AUTO_INCREMENT,
    content text NOT NULL,
    post_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    `date` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE votes (
    id int(11) AUTO_INCREMENT,
    vote boolean NOT NULL,
    comment_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (comment_id) REFERENCES comments(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (username, email, password) VALUES ('admin', 'admin@bitoverflow.nl', 'admin');
INSERT INTO categories (name) VALUES ('PHP'), ('MySQL'), ('HTML'), ('CSS'), ('JavaScript');