<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // Not logged in, redirect to login page
    header('Location: admin_login.php');
    exit();
}

include 'db_conn.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'update' && isset($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password'])) {
        // Handle user update
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        // Prepare an update statement
        $sql = "UPDATE users SET name=?, email=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssi", $name, $email, $password, $id);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $message = "Records updated successfully.";
        } else{
            $message = "ERROR: Could not execute query: $sql. " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else if ($_POST['action'] == 'disable' && isset($_POST['user_id'])) {

        // Handle user disable
        $userId = $_POST['user_id'];
        $is_disabled = 1;  // To disable a user

        // Prepare an update statement
        $sql = "UPDATE users SET is_disabled=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ii", $is_disabled, $userId);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $message = "User disabled successfully.";
        } else{
            $message = "ERROR: Could not execute query: $sql. " . $conn->error;
        }

        // Close statement
        $stmt->close();
    }
}
?>

 
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body onload="startTime()">
<div class="blog">
 <div class="blog-part is-menu">

  <a href="home.php" class="blog-menu"></a>
  <a href="profile.php" class="blog-menu"></a>
  <a href="#" class="blog-menu mention">admin</a>
  <a href="logout.php" class="blog-menu subscribe">Log out</a>
 </div>
 <div class="blog-header blog-is-sticky">
  <div class="blog-article header-article">
   <div class="blog-big__title">HoloX</div>
   <div class="blog-menu rounded small-title"><div id="time"></div></div>
  </div>
 </div>
 <div class="blog-header-container">
  <div class="blog-header">
   <div class="blog-article header-article">
    <div class="blog-big__title">Home</div>
    <div class="blog-menu small-title date">
     <?php
$t=time();
echo(date("Y-m-d",$t));
?>
</div>
   </div>
   <div class="blog-article">
   <form method="POST">
    <input type="hidden" name="action" value="update">
    <input type="text" name="id" placeholder="User ID">
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Update User">
</form>

<form method="POST">
    <input type="hidden" name="action" value="disable">
    <input type="text" name="user_id" placeholder="User ID to disable">
    <input type="submit" value="Disable User">
</form>


   </div>
  </div>
 </div>
 <div class="blog-part right-blog">
  <marquee width="100%" direction="left">
  <?php
   // Fetch the number of users from the database
$sql = "SELECT COUNT(*) as user_count FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_count = $row['user_count'];

        // Fetch the number of urls from the database
        $sql = "SELECT COUNT(*) as url_count FROM bookmarks"; // replace 'urls' with your actual table name
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $url_count = $row['url_count'];

// Show the data
echo "Number of users: " . $user_count . "<br>";
echo "Number of urls: " . $url_count . "<br>";

// Display IP
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
echo "IP Address: " . $ip . "<br>";
?>
  </marquee>
  <div style="margin-top:32px; background:#fff; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.07); padding:18px;">
    <h3 style="margin-top:0; font-size:1.2rem; color:#222;">Contact Us Messages</h3>
    <div style="overflow-x:auto;">
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-radius:8px; border-collapse:collapse;">
     <tr style="background:#f0f0f0;font-weight:bold;">
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Date</th>
     </tr>
     <?php
     $sql = "SELECT name, email, message, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 10";
     $result = mysqli_query($conn, $sql);
     if ($result && mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
             echo '<tr>';
             echo '<td>' . htmlspecialchars($row['name']) . '</td>';
             echo '<td>' . htmlspecialchars($row['email']) . '</td>';
             echo '<td style="max-width:200px;word-break:break-all;">' . nl2br(htmlspecialchars($row['message'])) . '</td>';
             echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
             echo '</tr>';
         }
     } else {
         echo '<tr><td colspan="4" style="text-align:center;">No messages found.</td></tr>';
     }
     ?>
    </table>
    </div>
  </div>
 </div>
</div>
</body>
</html>
<script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) { i = "0" + i };  // add zero in front of numbers < 10
            return i;
        }
    </script>
