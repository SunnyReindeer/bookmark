<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Suppose the user id is stored in the session
    session_start();
    if (!isset($_SESSION['id'])) {
        echo "User is not logged in.";
        exit();
    }

    $id = $_SESSION['id'];

    // Handle form submission
    if (isset($_POST['new_password'], $_POST['confirm_new_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];
        
        if ($new_password === $confirm_new_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Use a prepared statement to avoid SQL injection
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $hashed_password, $id);
            $stmt->execute();

            if ($stmt->affected_rows === 1) {
                echo "Password changed successfully.";
            } else {
                echo "Failed to change password.";
            }
        } else {
            echo "Passwords do not match.";
        }
    } elseif (isset($_POST['new_email'], $_POST['new_username'])) {
        $new_email = mysqli_real_escape_string($conn, $_POST['new_email']);
        $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);

        // Use a prepared statement to avoid SQL injection
        $stmt = $conn->prepare("UPDATE users SET email = ?, name = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_email, $new_username, $id);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            echo "User information updated successfully.";
        } else {
            echo "Failed to update user information.";
        }
    }
}

?>