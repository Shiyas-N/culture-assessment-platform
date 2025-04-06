-- SQL file containing all CREATE TABLE statements (users, surveys, questions, etc.)


CREATE TABLE rules (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rule_name VARCHAR(255) NOT NULL,
    rule_type ENUM('SINGLE', 'COMBINATION') NOT NULL
);

CREATE TABLE questions ( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    text VARCHAR(255) NOT NULL 
);

CREATE TABLE answer_options ( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    answer_text VARCHAR(50) NOT NULL UNIQUE 
);

CREATE TABLE cultural_values ( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    value_name VARCHAR(100) NOT NULL UNIQUE 
);

CREATE TABLE rule_conditions ( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    rule_id INT UNSIGNED NOT NULL, 
    question_id INT UNSIGNED NOT NULL, 
    answer_option_id INT UNSIGNED NOT NULL, 
    logic_operator ENUM('AND', 'OR') DEFAULT NULL, 
    FOREIGN KEY (rule_id) REFERENCES rules(id) ON DELETE CASCADE, 
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE, 
    FOREIGN KEY (answer_option_id) REFERENCES answer_options(id) ON DELETE CASCADE 
);

CREATE TABLE rule_cultural_values ( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    rule_id INT UNSIGNED NOT NULL, 
    cultural_value_id INT UNSIGNED NOT NULL, 
    points INT NOT NULL DEFAULT 0, 
    FOREIGN KEY (rule_id) REFERENCES rules(id) ON DELETE CASCADE, 
    FOREIGN KEY (cultural_value_id) REFERENCES cultural_values(id) ON DELETE CASCADE 
);

