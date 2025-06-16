<?php
session_start();
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if (empty($email)) {
        header("Location: login_page.php?error=Email Address is required");
        exit();
    } else if (empty($password)) {
        header("Location: login_page.php?error=Password is required");
        exit();
    } else {
        // First, let's try to login as a user
        $sql = "SELECT * FROM users WHERE email='$email'";

        $result = mysqli_query($conn, $sql);
        if ($user_is_disabled) {
            // Show an error message, don't allow them to log in
            echo "This user is disabled.";
        }
        
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && password_verify($password, $row['password'])) {
                if($row['is_disabled'] == 1) {
                    header("Location: login_page.php?error=This user is disabled");
                    exit();
                } else {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: home.php");
                    exit();
                }
            } else {
                header("Location: login_page.php?error=Incorrect Email Address or password");
                exit();
            }
        } else {
            // No user found, let's try to login as an admin
            $sql = "SELECT * FROM admin WHERE email='$email'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['email'] === $email && password_verify($password, $row['password'])) {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['admin_id'] = $row['id'];
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    header("Location: login_page.php?error=Incorrect Email Address or password");
                    exit();
                }
            } else {
                header("Location: login_page.php?error=Incorrect Email Address or password");
                exit();
            }
        }
    }

} else {
    header("Location: index.php");
    exit();
}
