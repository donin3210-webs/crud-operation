<?php
require 'db.php';

// Runs only when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $stmt = $conn->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $course);
    $stmt->execute();

    // Back to the list
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <!-- Same external stylesheet as the student list -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container form-box">
        <h1>Add Student</h1>

        <form action="" method="POST">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Full Name" required>
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>

            <div class="field">
                <label for="course">Course</label>
                <input type="text" id="course" name="course" placeholder="Course" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-save">Save</button>
                <a href="index.php" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>