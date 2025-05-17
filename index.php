<?php
include __DIR__ . '/config/db_connect.php';

$search = $_GET['search'] ?? '';
$students = [];

try {
    if (!empty($search)) {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE name LIKE ?");
        $stmt->execute(["%$search%"]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM students");
        $stmt->execute();
    }

    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Failed to fetch data: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Student List</h2>
        <a href="regisiter.php" class="btn btn-success mb-3">Add New Student</a>


        <form method="GET" action="" class="d-flex mb-4" role="search">
            <input type="text" name="search" class="form-control me-2" placeholder="Search students..."
                value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-dark">Search</button>
        </form>


        <?php if (!empty($students)): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['age']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="alert alert-warning">No students
            found<?= $search ? ' for "' . htmlspecialchars($search) . '"' : '' ?>.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>