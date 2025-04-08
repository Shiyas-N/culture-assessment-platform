CREATE DATABASE IF NOT EXISTS question_app;
USE question_app;

CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL
);
