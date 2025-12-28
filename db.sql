CREATE DATABASE htuGym;

CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255) UNIQUE,  
    password varchar(255)  
);

CREATE TABLE plans(
    id int PRIMARY KEY AUTO_INCREMENT,
    plan_desc text,
    plan_title varchar(255),
    price float
);

CREATE TABLE courses(
    id int PRIMARY KEY AUTO_INCREMENT,
    course_desc text,
    course_title varchar(255),
    price float
);

CREATE TABLE classes(
    id int PRIMARY KEY AUTO_INCREMENT,
    class_desc text,
    class_title varchar(255)
);

CREATE TABLE coaches(
    id int PRIMARY KEY AUTO_INCREMENT,
    full_name varchar(255),
    coach_title text,
    coach_desc text
);

CREATE TABLE user_plans(
    id int PRIMARY KEY AUTO_INCREMENT,
    user_id int NOT NULL,
    plan_id int NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE
);