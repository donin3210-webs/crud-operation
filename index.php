<?php
require 'db.php';

// Get every row from the students table
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student List</title>
    <!-- External stylesheet for the student pages -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <div class="top-bar">
            <h1>Student List</h1>
            <a href="create.php" class="btn-add">+ Add student</a>
        </div>

        <?php if ($result->num_rows === 0): ?>
            <!-- Shown when the table has no rows -->
            <p class="empty">No students yet. Click "Add student" to create one.</p>
        <?php else: ?>
        <div class="table-wrap">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Action</th>
                </tr>

                <!-- Loop through each row and print it as a table row -->
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['course']); ?></td>
                    <td class="actions">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-delete"
                           onclick="return confirm('Delete this student?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php endif; ?>

    </div>
</body>
</html>