<?php
require 'db.php';

// Get the id from the URL (edit.php?id=3)
$id = $_GET['id'];

// When the form is submitted, update the row
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $course, $id); // "i" = integer
    $stmt->execute();

    header("Location: index.php");
    exit;
}

// Load the current row so the form is pre-filled
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();

// If the id doesn't exist, go back to the list
if (!$student) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student</title>
    <!-- Same external stylesheet as the student list -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container form-box">
        <h1>Edit Student</h1>

        <form action="" method="POST">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
            </div>

            <div class="field">
                <label for="course">Course</label>
                <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-save">Update</button>
                <a href="index.php" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>