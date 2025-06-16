<?php
session_start();
include "db_conn.php";

if (
	isset($_POST['email']) && isset($_POST['password'])
	&& isset($_POST['name']) && isset($_POST['re_password'])
) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);
	$re_pass = validate($_POST['re_password']);
	$name = validate($_POST['name']);

	// Now escape them
	$email = mysqli_real_escape_string($conn, $email);
	$pass = mysqli_real_escape_string($conn, $pass);
	$re_pass = mysqli_real_escape_string($conn, $re_pass);
	$name = mysqli_real_escape_string($conn, $name);

	$user_data = 'email=' . $email . '&name=' . $name;

	if (strlen($pass) < 8) {
		header("Location: login_page.php?error=Password must be at least 8 characters long");
		exit();
	}

	if (empty($email)) {
		header("Location: login_page.php?error=Email Address is required");
		exit();
	} else if (empty($pass)) {
		header("Location: login_page.php?error=Password is required");
		exit();
	} else if (empty($re_pass)) {
		header("Location: login_page.php?error=Re Password is required");
		exit();
	} else if (empty($name)) {
		header("Location: login_page.php?error=Name is required");
		exit();
	} else if ($pass !== $re_pass) {
		header("Location: login_page.php?error=The confirmation password does not match");
		exit();
	} else {

		// hashing the password
		$pass = password_hash($pass, PASSWORD_DEFAULT);

		$sql = "SELECT * FROM users WHERE email='$email' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: login_page.php?error=The email is taken, try another");
			exit();
		} else {
			$sql2 = "INSERT INTO users(email, password, name) VALUES('$email', '$pass', '$name')";
			$result2 = mysqli_query($conn, $sql2);
			if ($result2) {
				header("Location: login_page.php?success=Your account has been created successfully");
				exit();
			} else {
				header("Location: login_page.php?error=Unknown error occurred");
				exit();
			}
		}
	}

} else {
	header("Location: login_page.php");
	exit();
}
