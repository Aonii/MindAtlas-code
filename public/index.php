<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Repository/EnrolmentRepository.php';

// Get database connection
$db = Database::getConnection();
$repository = new EnrolmentRepository($db);

// Read query parameters
$userName = $_GET['user_name'] ?? '';
$courseName = $_GET['course_name'] ?? '';
$status = $_GET['completion_status'] ?? '';
$page = max(1, (int) ($_GET['page'] ?? 1));

$limit = 10;
$offset = ($page - 1) * $limit;

$filters = [
    'user_name' => $userName,
    'course_name' => $courseName,
    'completion_status' => $status
];

// Fetch data
$total = $repository->getTotalCount($filters);
$enrolments = $repository->getEnrolmentReport($filters, $limit, $offset);

$totalPages = (int) ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Enrolment Report</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-4">
    <h1 class="mb-4">Course Enrolment Report</h1>

    <!-- Filter Form -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-3">
            <input
                type="text"
                name="user_name"
                class="form-control"
                placeholder="Search user"
                value="<?= htmlspecialchars($userName) ?>"
            >
        </div>

        <div class="col-md-3">
            <input
                type="text"
                name="course_name"
                class="form-control"
                placeholder="Search course"
                value="<?= htmlspecialchars($courseName) ?>"
            >
        </div>

        <div class="col-md-3">
            <select name="completion_status" class="form-select">
                <option value="">All statuses</option>
                <?php foreach (['not started', 'in progress', 'completed'] as $option): ?>
                    <option
                        value="<?= $option ?>"
                        <?= $status === $option ? 'selected' : '' ?>
                    >
                        <?= ucfirst($option) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- Results Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>User</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Enrolled At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($enrolments)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No results found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($enrolments as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['user_name']) ?></td>
                            <td><?= htmlspecialchars($row['course_name']) ?></td>
                            <td>
                                <span class="badge bg-secondary">
                                    <?= ucfirst($row['completion_status']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($row['enrolled_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a
                            class="page-link"
                            href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                        >
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

</body>
</html>
