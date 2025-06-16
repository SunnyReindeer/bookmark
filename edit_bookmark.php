<?php 
    session_start();
    include "db_conn.php";
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM bookmarks WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $url_name = $row['url_name'];
            $url = $row['url'];
        }
    }

    if(isset($_POST['update'])){
        $id = $_GET['id'];
        $url_name = $_POST['url_name'];
        $url = $_POST['url'];
        
        $query = "UPDATE bookmarks set url_name = '$url_name', url = '$url' WHERE id = '$id'";
        mysqli_query($conn, $query);
        
        header('Location: profile.php');
    }
?>

<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="url_name" value="<?php echo $url_name; ?>">
        <label>URL</label>
        <input type="text" name="url" value="<?php echo $url; ?>">
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
