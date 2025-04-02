-- SQL file containing all CREATE TABLE statements (users, surveys, questions, etc.)


CREATE TABLE rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rule_name VARCHAR(255) NOT NULL,
    rule_type ENUM('SINGLE', 'COMBINATION') NOT NULL
);


