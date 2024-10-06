<?php
// Include your database connection details here
include 'db.php';

// Get the search query from the URL
// Connect to your MySQL database (replace with your actual credentials)

// Get the search query from the URL
$q = $_REQUEST['q'];

// Initialize an empty array for suggestions
$suggestions = [];

// Lookup hints from the database if $q is not empty
if (!empty($q)) {
    $q = $conn->real_escape_string($q); // Sanitize input to prevent SQL injection
    $sql = "SELECT name FROM songs WHERE name LIKE '%$q%'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['name'];
    }
}

// Close the database connection
$conn->close();

// Output suggestions as JSON
echo json_encode($suggestions);
?>

