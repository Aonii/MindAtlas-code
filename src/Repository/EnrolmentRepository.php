<?php
declare(strict_types=1);

/**
 * Repository responsible for fetching enrolment report data
 *
 * Handles all database queries related to users, courses and enrolments.
 */

require_once __DIR__ . '/../../config/database.php';

class EnrolmentRepository
{
    private PDO $db;

    /**
     * EnrolmentRepository constructor.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetch enrolment report data with optional filters and pagination
     *
     * @param array $filters
     *  - user_name (string)
     *  - course_name (string)
     *  - completion_status (string)
     * @param int $limit
     * @param int $offset
     *
     * @return array
     * @throws Exception
     */
    public function getEnrolmentReport(
        array $filters = [],
        int $limit = 20,
        int $offset = 0
    ): array {
        $sql = "
            SELECT
                e.enrolment_id,
                u.user_id,
                CONCAT(u.first_name, ' ', u.surname) AS user_name,
                c.course_id,
                c.description AS course_name,
                e.completion_status,
                e.enrolled_at
            FROM enrolments e
            INNER JOIN users u ON e.user_id = u.user_id
            INNER JOIN courses c ON e.course_id = c.course_id
            WHERE 1=1
        ";

        $params = [];

        // Filter by user name
        // if (!empty($filters['user_name'])) {
        //     $sql .= " AND (u.first_name LIKE :user_name OR u.surname LIKE :user_name)";
        //     $params['user_name'] = '%' . $filters['user_name'] . '%';
        // }

        if (!empty($filters['user_name'])) {
            // Split the input name
            $names = explode(' ', $filters['user_name'], 2);
            $first_name = $names[0];
            $surname = $names[1] ?? ''; // If only one word is entered, "surname" can be left blank

            $sql .= " AND u.first_name LIKE :first_name";
            $params['first_name'] = '%' . $first_name . '%';

            if (!empty($surname)) {
                $sql .= " AND u.surname LIKE :surname";
                $params['surname'] = '%' . $surname . '%';
            }
        }

        // Filter by course name
        if (!empty($filters['course_name'])) {
            $sql .= " AND c.description LIKE :course_name";
            $params['course_name'] = '%' . $filters['course_name'] . '%';
        }

        // Filter by completion status
        if (!empty($filters['completion_status'])) {
            $sql .= " AND e.completion_status = :completion_status";
            $params['completion_status'] = $filters['completion_status'];
        }

        // Order & pagination
        $sql .= " ORDER BY u.surname, c.description LIMIT :limit OFFSET :offset";

        try {
            $stmt = $this->db->prepare($sql);

            // Bind search parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
            }

            // Bind pagination parameters
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception('Failed to fetch enrolment report.');
        }
    }

    /**
     * Get total count of enrolments (for pagination)
     *
     * @param array $filters
     * @return int
     * @throws Exception
     */
    public function getTotalCount(array $filters = []): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM enrolments e
            INNER JOIN users u ON e.user_id = u.user_id
            INNER JOIN courses c ON e.course_id = c.course_id
            WHERE 1=1
        ";

        $params = [];

        // if (!empty($filters['user_name'])) {
        //     $sql .= " AND (u.first_name LIKE :first_name OR u.surname LIKE :surname)";
        //     $params['first_name'] = '%' . $filters['user_name'] . '%';
        //     $params['surname']    = '%' . $filters['user_name'] . '%';
        // }

        if (!empty($filters['user_name'])) {
            // Split the input name
            $names = explode(' ', $filters['user_name'], 2);
            $first_name = $names[0];
            $surname = $names[1] ?? ''; // If only one word is entered, "surname" can be left blank

            $sql .= " AND u.first_name LIKE :first_name";
            $params['first_name'] = '%' . $first_name . '%';

            if (!empty($surname)) {
                $sql .= " AND u.surname LIKE :surname";
                $params['surname'] = '%' . $surname . '%';
            }
        }

        if (!empty($filters['course_name'])) {
            $sql .= " AND c.description LIKE :course_name";
            $params['course_name'] = '%' . $filters['course_name'] . '%';
        }

        if (!empty($filters['completion_status'])) {
            $sql .= " AND e.completion_status = :completion_status";
            $params['completion_status'] = $filters['completion_status'];
        }

        try {
            $stmt = $this->db->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

            $stmt->execute();

            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception('Failed to fetch enrolment count.');
        }
    }
  }