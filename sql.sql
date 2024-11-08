CREATE DATABASE career_guidance;

USE career_guidance;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mobile VARCHAR(20),
    dob DATE,
    password VARCHAR(255) NOT NULL
);
