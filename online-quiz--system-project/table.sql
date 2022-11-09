CREATE DATABASE quizData;

CREATE TABLE admin (
  admin_id bigint NOT NULL AUTO_INCREMENT,
  username varchar(45) NOT NULL,
  password varchar(45) NOT NULL,
  PRIMARY KEY (admin_id)
);
INSERT INTO admin VALUES (1,'admin','password');


CREATE TABLE students (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  fname varchar(50) NOT NULL,
  lname varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(300) NOT NULL,
  posting_date datetime DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE lecturers (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  fname varchar(50) NOT NULL,
  lname varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(300) NOT NULL,
  posting_date datetime DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE questions (
  question_number int(11) NOT NULL PRIMARY KEY,
  question_text text NOT NULL
);

CREATE TABLE options (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  question_number int(11) NOT NULL,
  is_correct tinyint(1) DEFAULT '0' NOT NULL,
  coption text NOT NULL
);

