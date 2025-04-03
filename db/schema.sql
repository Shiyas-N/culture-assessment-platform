CREATE TABLE surveys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    effective_from DATE NOT NULL,
    deadline DATE NOT NULL,
    experience ENUM('0-2', '2-5', '5+') NOT NULL
);
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL
);
CREATE TABLE survey_questions (
    survey_id INT NOT NULL,
    question_id INT NOT NULL,
    PRIMARY KEY (survey_id, question_id),
    FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);
