-- Users Seed
INSERT INTO users (first_name, surname) VALUES
('Aoni', 'Fu'),
('Bob', 'Johnson'),
('Charlie', 'Brown'),
('Diana', 'Williams'),
('Ethan', 'Jones'),
('Fiona', 'Garcia'),
('George', 'Miller'),
('Hannah', 'Davis'),
('Ian', 'Wilson'),
('Julia', 'Taylor'),
('Andrew', 'Poor'),
('Charles', 'Liu'),
('Tina', 'Fu');

-- Courses Seed
INSERT INTO courses (description) VALUES
('Introduction to PHP'),
('Advanced PHP Programming'),
('MySQL Fundamentals'),
('Web Security Basics'),
('JavaScript Essentials'),
('HTML & CSS'),
('Backend Development'),
('REST API Design'),
('Database Optimization'),
('Software Testing');

-- Enrolments Seed (100+)
-- Each user enrols in multiple courses
INSERT INTO enrolments (user_id, course_id, completion_status) VALUES
-- User 1
(1,1,'completed'), (1,2,'in progress'), (1,3,'completed'), (1,4,'not started'), (1,5,'completed'),
(1,6,'completed'), (1,7,'in progress'), (1,8,'not started'),

-- User 2
(2,1,'completed'), (2,2,'completed'), (2,3,'in progress'), (2,4,'not started'), (2,5,'completed'),
(2,6,'in progress'), (2,7,'completed'), (2,8,'completed'), (2,9,'not started'), (2,10,'completed'),

-- User 3
(3,1,'not started'), (3,2,'in progress'), (3,3,'completed'), (3,4,'completed'), (3,5,'in progress'),

-- User 4
(4,1,'completed'), (4,4,'in progress'), (4,5,'completed'), (4,6,'completed'), (4,7,'completed'),

-- User 5
(5,1,'in progress'), (5,2,'completed'), (5,3,'completed'), (5,4,'completed'), (5,5,'not started'),
(5,6,'completed'), (5,7,'in progress'), (5,8,'completed'), (5,9,'completed'), (5,10,'completed'),

-- User 6
(6,1,'completed'), (6,3,'completed'), (6,4,'in progress'), (6,5,'completed'),
(6,6,'completed'), (6,7,'completed'), (6,9,'in progress'), (6,10,'completed'),

-- User 7
(7,1,'completed'), (7,2,'completed'), (7,5,'completed'),
(7,6,'in progress'), (7,9,'completed'), (7,10,'not started'),

-- User 8
(8,1,'completed'), (8,2,'in progress'), (8,3,'completed'), (8,4,'completed'), (8,5,'completed'),
(8,8,'completed'), (8,9,'in progress'), (8,10,'completed'),

-- User 9
(9,1,'not started'), (9,2,'completed'), (9,3,'completed'), (9,4,'in progress'), (9,5,'completed'),
(9,6,'completed'), (9,9,'completed'), (9,10,'in progress'),

-- User 10
(10,6,'in progress'), (10,7,'completed'), (10,8,'not started'), (10,9,'completed'), (10,10,'completed'),

-- User 11
(11,1,'in progress'), (11,2,'completed'), (11,3,'completed'), (11,4,'completed'), (11,5,'not started'),
(11,6,'completed'), (11,7,'in progress'), (11,8,'completed'), (11,9,'completed'), (11,10,'completed'),

-- User 12
(12,1,'in progress'), (12,2,'completed'), (12,3,'completed'), (12,4,'completed'), (12,5,'not started'),
(12,6,'completed'), (12,7,'in progress'), (12,8,'completed'), (12,9,'completed'), (12,10,'completed'),

-- User 13
(13,1,'in progress'), (13,2,'completed'), (13,3,'completed'), (13,4,'completed'), (13,5,'not started'),
(13,6,'completed'), (13,7,'in progress'), (13,8,'completed'), (13,9,'completed'), (13,10,'completed');