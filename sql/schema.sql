-- Drop table first for reset
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS courses;
DROP TABLE IF EXISTS enrolments;

-- Users Table
CREATE TABLE users (
  user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  surname VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Courses Table
CREATE TABLE courses (
  course_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Enrolments Table
CREATE TABLE enrolments (
  enrolment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  course_id INT UNSIGNED NOT NULL,
  completion_status ENUM('not started', 'in progress', 'completed') NOT NULL DEFAULT 'not started',
  enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  -- Ensure a user can only enrol in the same course once
  UNIQUE KEY uq_user_course (user_id, course_id),

  -- Indexes for performance
  KEY idx_user_id (user_id),
  KEY idx_course_id (course_id),
  KEY idx_completion_status (completion_status),  

  -- Foreign keys
  CONSTRAINT fk_enrolments_user
      FOREIGN KEY (user_id) REFERENCES users(user_id)
      ON DELETE CASCADE,

  CONSTRAINT fk_enrolments_course
      FOREIGN KEY (course_id) REFERENCES courses(course_id)
      ON DELETE CASCADE
) ENGINE=InnoDB;