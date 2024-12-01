<?php
require_once('../database/dbhelper.php');

// Check if there is an 'id' parameter and ensure it's a valid number
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // SQL to delete category
    $sql = "DELETE FROM category WHERE id = ?";

    // Execute the SQL with the provided id using prepared statements
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id); // Bind the parameter
        mysqli_stmt_execute($stmt); // Execute the statement
        mysqli_stmt_close($stmt);
    }

    // Close the connection
    mysqli_close($conn);

    // Redirect back to the index page after deletion
    header('Location: index.php');
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
    