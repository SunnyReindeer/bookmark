<?php 
session_start();

include 'db_conn.php';

if (!isset($_SESSION['id'])) {
    header('Location: login_page.php');
    exit();
}

$id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo 'User not found';
    exit();
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
  <a href="bookmarks.php" class="blog-menu">
   Bookmarks
   <svg fill="none" stroke="currentColor" stroke-width=".7" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right" viewBox="0 0 24 24">
    <path d="M7 17L17 7M7 7h10v10" />
   </svg>
  </a>
  <a href="home.php" class="blog-menu">Home</a>
  <a href="profile.php" class="blog-menu">Profile</a>
  <a href="#" class="blog-menu mention">Welcome, <?php echo $user['name']; ?></a>
  <a href="logout.php" class="blog-menu subscribe">Log out</a>
 </div>
 <div class="blog-header blog-is-sticky">
  <div class="blog-article header-article">
   <div class="blog-big__title">HoloX</div>
   <div class="blog-menu rounded small-title"><div id="time"></div></div>
  </div>
      <p>Name: <?php echo $user['name']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
 </div>
 <div class="blog-header-container">
  <div class="blog-header">
   <div class="blog-article header-article">
    <div class="blog-big__title">Profile</div>
    <div class="blog-menu small-title date">
     <?php
$t=time();
echo(date("Y-m-d",$t));
?>
</div>
   </div>
   <div class="blog-article">
   <form action="edituser.php" method="POST">
    <input type="password" name="new_password" placeholder="New Password" required>
    <input type="password" name="confirm_new_password" placeholder="Confirm New Password" required>
    <button type="submit">Change Password</button>
</form>

<form action="edituser.php" method="POST">
    <input type="email" name="new_email" placeholder="New Email" required>
    <input type="text" name="new_username" placeholder="New Username" required>
    <button type="submit">Change User Info</button>
</form>

   </div>
  </div>
 </div>
 <div class="blog-part right-blog">
  <marquee width="100%" direction="left">
   <span>Now And Then You Miss It Sounds Make You Cry</span>
   <span>Now In - MoMa Sharing Exhibition NOW</span>
   <span>NYC Opens After Long Lockdown Check</span>
  </marquee>
 
  </div>
 </div>
</div>
</body>
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
</html>