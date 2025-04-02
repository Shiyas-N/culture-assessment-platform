-- SQL file containing all CREATE TABLE statements (users, surveys, questions, etc.)
CREATE TABLE survey (
    survey_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    issue TEXT NOT NULL,
    deadline DATE NOT NULL,
    description TEXT,
    is_published BOOLEAN DEFAULT FALSE
);

CREATE TABLE job_role (
    survey_id INT,
    jobrole VARCHAR(255),
    FOREIGN KEY (survey_id) REFERENCES survey(survey_id) ON DELETE CASCADE
);
