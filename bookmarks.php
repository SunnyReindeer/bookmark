<?php 
session_start();

include 'db_conn.php';

if (!isset($_SESSION['id'])) {
    header('Location: login_page.php');
    exit();
}

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    if (isset($_POST['url'], $_POST['url_name'])) {
        // Insert new bookmark
        $url = mysqli_real_escape_string($conn, $_POST['url']);
        $url_name = mysqli_real_escape_string($conn, $_POST['url_name']);
        $sql = "INSERT INTO bookmarks (user_id, url, url_name) VALUES ($user_id, '$url', '$url_name')";
        mysqli_query($conn, $sql);
    } elseif (isset($_POST['delete_id'])) {
        // Delete bookmark
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
        $sql = "DELETE FROM bookmarks WHERE id = $delete_id AND user_id = $user_id";
        mysqli_query($conn, $sql);
    }
}

// Fetch user's bookmarks
$sql = "SELECT * FROM bookmarks WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$bookmarks = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
 </div>
 <div class="blog-header-container">
  <div class="blog-header">
   <div class="blog-article header-article">
    <div class="blog-big__title">Bookmarks</div>
    <div class="blog-menu small-title date">
     <?php
$t=time();
echo(date("Y-m-d",$t));
?>
</div>
   </div>
   <div class="blog-article">
   <form method="POST">
        <input type="text" name="url_name" placeholder="Bookmark Name" required>
        <input type="url" name="url" placeholder="Bookmark URL" required>
        <button type="submit">Add Bookmark</button>
    </form>
    <?php foreach ($bookmarks as $bookmark) { ?>
    <div>
        <a href="<?php echo $bookmark['url']; ?>"><?php echo $bookmark['url_name']; ?></a>
        <a href="edit_bookmark.php?id=<?php echo $bookmark['id']; ?>" class="edit-btn">Edit</a>
        <form method="POST">
            <input type="hidden" name="delete_id" value="<?php echo $bookmark['id']; ?>">
            <button type="submit">Delete</button>
        </form>
    </div>
    <?php } ?>
 
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