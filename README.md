# Course Enrolment Report (PHP Code Test)

## Overview

This project is a **sample course enrolment reporting system** developed as part of a PHP skills-based competency test. The application demonstrates how to use **PHP (no backend frameworks)**, **MySQL**, and basic **frontend libraries** to display enrolment and completion information for users enrolled in courses.

The system is designed with **scalability and maintainability** in mind, taking into account that enrolment data may grow to **100,000+ records**.

---

## Features

- Displays users enrolled in courses with their completion status
- Supports filtering by:
  - User name
  - Course name
  - Completion status (not started / in progress / completed)

- Pagination to handle large datasets efficiently
- Secure database access using PDO and prepared statements
- Clean code structure with separation of concerns

---

## Technology Stack

- **PHP**: 7.4 / 8.1 (no backend frameworks)
- **MySQL**: Relational database
- **Frontend**: HTML, CSS, Bootstrap 5
- **Database Access**: PDO

---

## Project Structure

```
course-report/
│
├── config/
│   └── database.php        # PDO database connection
│
├── public/
│   └── index.php           # Main report page
│
├── src/
│   └── Repository/
│       └── EnrolmentRepository.php
│
├── sql/
│   ├── schema.sql          # Database schema
│   └── seed.sql            # Sample data (100+ enrolments)
│
└── README.md
```

---

## Running the Application

From the project root directory:

```bash
php -S localhost:8000 -t public
```

Then open your browser and navigate to:

```
http://localhost:8000
```

---

## Performance Considerations

- Pagination is implemented using `LIMIT` and `OFFSET`
- Indexed columns on enrolments (user_id, course_id, completion_status)
- Filtering is performed at the SQL level, not in PHP memory

This ensures acceptable performance even with large datasets.

---

## Security Considerations

- All database queries use prepared statements
- Output is escaped using `htmlspecialchars()` to prevent XSS
- Database errors are logged internally and not exposed to users

---

## Notes

- No backend frameworks were used, as per the task requirements
- Frontend libraries were used only to improve usability and readability
- Code is organised to reflect real-world PHP project practices

---

## Author

Developed as part of a technical assessment to demonstrate PHP, MySQL, and backend development fundamentals.
