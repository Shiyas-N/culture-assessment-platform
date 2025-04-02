-- SQL file containing all CREATE TABLE statements (users, surveys, questions, etc.)
CREATE TABLE surveys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    issue TEXT NOT NULL,
    deadline DATE NOT NULL,
    description TEXT,
    members_polled INT DEFAULT 0,
    status ENUM('draft', 'published') DEFAULT 'draft'
);

CREATE TABLE job_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    survey_id INT NOT NULL,
    job_role VARCHAR(255) NOT NULL,
    FOREIGN KEY (survey_id) REFERENCES surveys(id) ON DELETE CASCADE
);
