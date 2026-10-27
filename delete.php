<?php
require 'db.php';

// Get the id from the URL (delete.php?id=3)
$id = $_GET['id'];

// Delete that one row
$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Back to the list
header("Location: index.php");
exit;