-- SQL file containing all CREATE TABLE statements (users, surveys, questions, etc.)
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