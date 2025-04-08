INSERT INTO surveys (title, effective_from, deadline, experience) 
VALUES 
('Employee Engagement Survey', '2025-04-01', '2025-04-30', '0-2'),
('Workplace Culture Assessment', '2025-05-01', '2025-05-31', '2-5');

INSERT INTO questions (question_text) 
VALUES 
('Do you feel valued at work?'),
('Are you satisfied with your work-life balance?'),
('Does the company support career growth?');

INSERT INTO survey_questions (survey_id, question_id) 
VALUES 
(1, 1), (1, 2),  -- First survey has Q1 and Q2
(2, 3);          -- Second survey has Q3
        