CREATE DATABASE bitoverflow;

USE bitoverflow;

CREATE TABLE users (
    id int(11) AUTO_INCREMENT,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    img_url varchar(255) NOT NULL,
    school_year int(11) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    reputation int(11) NOT NULL DEFAULT 0,
    description text,
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
    code text NOT NULL,
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
    solution boolean NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE votes (
    id int(11) AUTO_INCREMENT,
    score int(11) NOT NULL,
    post_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (post_id) REFERENCES posts(id)
);

CREATE TABLE scores (
    id int(11) AUTO_INCREMENT,
    post_id int(11),
    score int(11),
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(id)
);

INSERT INTO users (first_name, last_name, img_url, school_year, email, password) VALUES ('Admin', 'Bitoverflow', '', 2, 'admin@bitoverflow.nl', 'admin');
INSERT INTO categories (name) VALUES ('PHP'), ('MySQL'), ('HTML'), ('CSS'), ('JavaScript');
