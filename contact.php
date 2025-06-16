<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
    <link
        href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic|Droid+Serif:400,700,400italic,700italic'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="index.css">
    <title>HoloX</title>

    <meta name="viewport" content="width=device-width">
    <style>
        .container {
            max-width: 480px;
            margin: 40px auto 0 auto;
            background: #fff;
            padding: 32px 36px 28px 36px;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container h2 {
            color: #222;
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem;
            margin-bottom: 18px;
            letter-spacing: 1px;
        }
        .contact-form label {
            display: block;
            margin-top: 18px;
            color: #444;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px 10px;
            margin-top: 7px;
            border: 1.5px solid #bdbdbd;
            border-radius: 6px;
            font-size: 1rem;
            font-family: inherit;
            background: #fafbfc;
            transition: border 0.2s;
        }
        .contact-form input:focus,
        .contact-form textarea:focus {
            border: 1.5px solid #4CAF50;
            outline: none;
            background: #fff;
        }
        .contact-form button {
            margin-top: 28px;
            width: 100%;
            padding: 13px 0;
            background: linear-gradient(90deg, #4CAF50 60%, #388e3c 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(76,175,80,0.08);
            transition: background 0.2s;
        }
        .contact-form button:hover {
            background: linear-gradient(90deg, #388e3c 60%, #4CAF50 100%);
        }
        .msg-success {
            color: #219150;
            background: #e8f5e9;
            border: 1px solid #b2dfdb;
            padding: 10px 18px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
        }
        .msg-error {
            color: #c62828;
            background: #ffebee;
            border: 1px solid #ffcdd2;
            padding: 10px 18px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>

<body onload="startTime()">
    <div class="head">
        <div class="headerobjectswrapper">

            <header><a href="index.php">HoloX</a></header>
            <div class="nav-links">
                <a class="fancy" href="index.php">
                    <span class="top-key"></span>
                    <span class="text">Home</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
                <a class="fancy" href="introduction.php">
                    <span class="top-key"></span>
                    <span class="text">Introduction</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
                <a class="fancy" href="contact.php">
                    <span class="top-key"></span>
                    <span class="text">Contact Us</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
                <a class="fancy" href="login_page.php">
                    <span class="top-key"></span>
                    <span class="text">Login</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </a>
            </div>
        </div>
        <div class="subhead">
            <div id="time"></div>
        </div>
        <div class="content">
     <div class="container">
            <h2>Contact Us</h2>
            <?php
            include 'db_conn.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $message = mysqli_real_escape_string($conn, $_POST['message']);
                $created_at = date('Y-m-d H:i:s');

                $sql = "INSERT INTO contact_messages (name, email, message, created_at) VALUES ('$name', '$email', '$message', '$created_at')";
                if (mysqli_query($conn, $sql)) {
                    $success = 'Message sent successfully!';
                } else {
                    $error = 'Error, Try Again:';}
            }
            ?>
            <?php if (!empty($success)) { echo '<div class="msg-success">'.$success.'</div>'; } ?>
            <?php if (!empty($error)) { echo '<div class="msg-error">'.$error.'</div>'; } ?>
            <form class="contact-form" method="post" action="">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
        </div>
    </div>
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
</body>
</html>
