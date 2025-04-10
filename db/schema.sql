
CREATE TABLE surveys (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  issue DATE NOT NULL,
  deadline DATE NOT NULL,
  description TEXT DEFAULT NULL,
  members_polled INT(11) NOT NULL DEFAULT 0,
  status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
  experience VARCHAR(11) DEFAULT NULL,
  is_live TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);


CREATE TABLE survey_questions (
    survey_id INT(11) NOT NULL,
    question_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (survey_id, question_id),
    FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);



CREATE TABLE rules (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    survey_id INT(11) NOT NULL,
    rule_name VARCHAR(255) NOT NULL,
    rule_type ENUM('SINGLE', 'COMBINATION') NOT NULL,
    FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE
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

